<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Carbon\Carbon;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['name', 'slug', 'description', 'image', 'set_title', 'meta_desc', 'meta_key'];

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function setImage(UploadedFile $uploadFile) {
    	$currentImage = public_path($this->image);
    	$timeNow = Carbon::now();

    	$fileExt = $uploadFile->getClientOriginalExtension();
    	$fileName = str_slug($this->name).'.'.$fileExt;

    	if(!File::isDirectory(public_path('uploads/brands'))) {
    		File::makeDirectory(public_path('uploads/brands'));
    	}

    	$uploadFile->move(public_path('uploads/brands'), $fileName);

    	if(File::isFile($currentImage)) {
    		File::delete($currentImage);
    	}

    	$this->image = 'uploads/brands/'.$fileName;
    	$this->save();
    	return true;
    }

	public function setSlugAttribute($string) {
		$slug = str_slug($string);
		$this->attributes['slug'] = $slug;
	}
}
