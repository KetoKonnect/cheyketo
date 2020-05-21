<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //
    protected $fillable = ['name', 'description', 'price', 'thumbnail', 'qty', 'quantity_sold'];

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
        $new_sold_amount = ($this->quantity_sold + $amount);
        $new_amount = ($this->qty - $amount);
        $this->update(['qty' => $new_amount]);
        $this->update(['quantity_sold' => $new_sold_amount]);
    }
}
