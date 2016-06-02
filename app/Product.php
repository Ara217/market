<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function ProductsComment ()
    {
        return  $this->hasMany('App/ProductsComments');
    }

    protected $table = 'products';

    protected $fillable = [
        'title',
        'description',
        'price'
    ];
}
