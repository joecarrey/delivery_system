<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
	protected $fillable = [
        'name'
    ];
	/**
     * Relations
     */
    public function users(){
        return $this->belongsToMany(User::class, null, 'role_ids', 'user_ids');
    }
}
