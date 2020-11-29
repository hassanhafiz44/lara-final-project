<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	//
	public function images()
	{
		return $this->hasMany('App\ProductImage');
	}

	public function category()
	{
		return $this->belongsTo('App\ProductCategory');
	}

	protected $fillable = [
		'category_id', 'title', 'model', 'description', 'price', 'quantity', 
		'retail_price', 'image_url'
	];
}
