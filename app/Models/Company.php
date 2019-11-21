<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function account()
    {
    	return $this->belongsTo('App\Models\Account');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\Auth\User');
    }
}
