<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    
    protected $table = 'types';

    protected $fillable = ['name', 'slug', 'description', 'display', 'sort'];

    public function products() {
    	return $this->belongsToMany('\App\Product', 'product_type');
    }
    
	public function setSlugAttribute($string) {
		$slug = str_slug($string);
		$this->attributes['slug'] = $slug;
	}
}
