<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';
	
    protected $fillable = [
        'name', 'detail', 'product_category_id', 'product_unit_id'
    ];

    public function product_category()
    {
    	return $this->belongsTo('App\ProductCategory');
    }

    public function product_unit()
    {
    	return $this->belongsTo('App\ProductUnit');
    }
}
