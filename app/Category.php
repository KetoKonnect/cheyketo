<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // This is the data model for the categories to be used to filter products
    protected $fillable = [
        'name',
        'description', // Optional description
        'slug'
    ];

    /**
     * This function returns all the products assigned to this category
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

}
