<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Category extends Node
{
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'desc', 'set_title', 'meta_desc', 'meta_key'];

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function updateOrder($order, $orderCategory)
    {
        $orderCategory = $this->findOrFail($orderCategory);
        if ($order == 'childOf') {
            $this->makeChildOf($orderCategory);
        }
    }

    public function setSlugAttribute($string) {
        $slug = str_slug($string);
        $this->attributes['slug'] = $slug;
    }

    public function paddedName()
    {
        return str_repeat('-', $this->depth * 4). ' ' .$this->name;
    }
}
