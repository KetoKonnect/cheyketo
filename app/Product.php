<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //
    protected $fillable = ['name', 'description', 'price', 'thumbnail', 'qty'];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = ($value * 100);
    }

    public function getPriceAttribute($value)
    {
        return ($value / 100);
    }

    public function destock($amount)
    {
        $new_amount = ($this->qty - $amount);
        $this->update(['qty' => $new_amount]);
    }
}
