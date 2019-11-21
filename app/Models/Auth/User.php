<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;

/**
 * Class User.
 */
class User extends BaseUser
{

	public function companies()
    {
    	return $this->hasMany('App\Models\Company');
    }
    
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;
}
