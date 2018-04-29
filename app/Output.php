<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Output extends Model
{
    protected $fillable = ['name', 'pin'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['active' => 'boolean', 'pin' => 'integer'];
    
    
    /**
     *  Enable the pins output
     */
    public function enable()
    {
        if (\App::environment('production'))
        {
            shell_exec('gpio -g write ' . $this->pin . ' 1');
        }
    
        $this->active = TRUE;
        $this->save();
    }
    
    /**
     *  Disable the pin's output
     */
    public function disable()
    {
        if (\App::environment('production'))
        {
            shell_exec('gpio -g write ' . $this->pin . ' 0');
        }
    
        $this->active = FALSE;
        $this->save();
    }
    
    /**
     *  Set the gpio pin's mode to output
     */
    public function setPinMode()
    {
        if (\App::environment('production'))
        {
            shell_exec('gpio -g mode ' . $this->pin . ' out');
    
            if (DB::table('outputs')->where('pin', $this->pin)->value('active'))
            {
                $this->enable();
            }
        }
    }
    
    /**
     * Get the pins output value
     * @return bool
     */
    public function getActiveAttribute($value)
    {
        if (\App::environment('production'))
        {
            $state = shell_exec('gpio -g read ' . $this->pin);
            return (int)$state;
        }
        
        return boolval((int)$value);
    }
}
