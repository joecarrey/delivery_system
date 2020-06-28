<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    protected $fillable = [
        'title', 'message', 'file', 'status', 'location', 'address'
    ];
	/**
     * Relations
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
