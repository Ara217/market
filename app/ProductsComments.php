<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsComments extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'comment'
    ];

    public function ProductsComment ()
    {
        return $this->belongsTo('App/Product');
    }

}
