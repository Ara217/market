<?php

namespace App;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //use SoftDeletes;
    //protected $dates = ['deleted_at'];

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
