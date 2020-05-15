<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $fillable = [
        'street_address',
        'city',
        'island',
        'country',
        'delivery_notes'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
