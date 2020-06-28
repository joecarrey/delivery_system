<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    const STATUS_REQUESTED          = 1;
    const STATUS_PROCESSING         = 2;
    const STATUS_ONWAY              = 3;
    const STATUS_FINISHED           = 4;
    const STATUS_DENIED             = -1;
    
    protected $fillable = [
        'title', 'message', 'file', 'status', 'location', 'address'
    ];
	/**
     * Relations
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function courier(){
        return $this->belongsTo(Courier::class);
    }
}
