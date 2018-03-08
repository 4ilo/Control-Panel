<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    protected $fillable = ['name', 'pin'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['active' => 'boolean'];

    public function enable()
    {
        $this->active = true;
        $this->save();
    }

    public function disable()
    {
        $this->active = false;
        $this->save();
    }

    public function state()
    {
        return $this->active;
    }
}
