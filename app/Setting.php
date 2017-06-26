<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Carbon\Carbon;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['title', 'description', 'keyword', 
    						'dribbble', 'google', 'flickr', 'twitter', 
    						'facebook', 'email', 'address', 'phone', 'content', 'logo', 'name', 
                            'phone_at', 'api', 'secret'];

    public $timestamps = false;

    public function setImage(UploadedFile $uploadFile) {
    	$currentImage = public_path($this->logo);
    	$timeNow = Carbon::now();

    	$fileExt = $uploadFile->getClientOriginalExtension();
    	$fileName = str_slug($this->title).'.'.$fileExt;

    	if(!File::isDirectory(public_path('uploads/sites'))) {
    		File::makeDirectory(public_path('uploads/sites'));
    	}

    	$uploadFile->move(public_path('uploads/sites'), $fileName);

    	if(File::isFile($currentImage)) {
    		File::delete($currentImage);
    	}

    	$this->logo = 'uploads/sites/'.$fileName;
    	$this->save();
    	return true;
    }
}
