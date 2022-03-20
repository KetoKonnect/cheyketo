<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'category',
        'name', 
        'description', 
        'price', 
        'thumbnail', 
        'qty', 
        'quantity_sold', 
        'status'
    ];
    protected $dates = [
        'created_at'
    ];
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = ($value * 100);
    }

    public function getPriceAttribute($value)
    {
        return ($value / 100);
    }

    public function getCreatedAt($value)
    {
        return $value->toFormattedDateString();
    }

    public function destock($amount)
    {
        // get qty available
        $qty_available = $this->qty;

        if (($qty_available > 0) && ($this->qtyAvailable($amount))) {

            $new_sold_amount = ($this->quantity_sold + $amount);
            $new_amount = ($this->qty - $amount);
            $this->update(['qty' => $new_amount]);
            $this->update(['quantity_sold' => $new_sold_amount]);
            if ($new_amount == 0) {
                $this->update(['status' => 'unavailable']);
            }

            return true;
        } else {
            return false;
        }
    }

    public function qtyAvailable($amount)
    {
        if (($this->qty > 0) && ($amount <= $this->qty) && (($this->qty - $amount) >= 0)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the assigned Category
     */
    public function category()
    {
        # return the category that this product belongs too, if assigned
        return $this->belongsTo('App\Category');
    }
}
