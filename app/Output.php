<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    protected $fillable = ['name', 'pin'];
    protected $hidden = ['created_at', 'updated_at'];

    public function activate()
    {

    }

    public function disable()
    {

    }

    public function state()
    {
        return true;
    }
}
