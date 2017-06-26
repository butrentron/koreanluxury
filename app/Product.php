<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Carbon\Carbon;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [ 'name', 'slug', 'desc', 
    						'image', 'price', 'slide', 
    						'content', 'brand_id', 'sale', 
    						'category_id', 'size', 'color',
    						'set_title', 'meta_key', 'meta_desc', 'price_at', 'view'
    					];

    public function types() {
        return $this->belongsToMany('\App\Type', 'product_type');
    }

    public function categories() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function brands() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function setImage(UploadedFile $uploadFile) {
    	$currentImage = public_path($this->image);
    	$timeNow = Carbon::now();

    	$fileExt = $uploadFile->getClientOriginalExtension();
    	$fileName = str_slug($this->name).'.'.$fileExt;

    	if(!File::isDirectory(public_path('uploads/products'))) {
    		File::makeDirectory(public_path('uploads/products'));
    	}

    	$uploadFile->move(public_path('uploads/products'), $fileName);

    	if(File::isFile($currentImage)) {
    		File::delete($currentImage);
    	}

    	$this->image = 'uploads/products/'.$fileName;
    	$this->save();
    	return true;
    }

    public function setSlugAttribute($string) {
        $slug = str_slug($string);
        $this->attributes['slug'] = $slug;
    }

    public function setColorAttribute($string) {
        $color = json_encode($string);
        $this->attributes['color'] = $color;
    }

    public function getColorAttribute($value)
    {
        return json_decode($value, true);
    }

    // public function getNameAttribute($value)
    // {
    //     return str_limit($value, 31);
    // }

    public function setSizeAttribute($string) {
    	$size = json_encode($string);
    	$this->attributes['size'] = $size;
    }
    
    public function getSizeAttribute($value)
    {
        return json_decode($value, true);
    }

}
