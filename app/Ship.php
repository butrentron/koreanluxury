<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Carbon\Carbon;

class Ship extends Model
{
    protected $table = 'ships';
    protected $fillable = ['name', 'desc', 'logo', 'website', 'url'];

    public function setImage(UploadedFile $uploadFile) {
    	$currentImage = public_path($this->logo);
    	$timeNow = Carbon::now();

    	$fileExt = $uploadFile->getClientOriginalExtension();
    	$fileName = str_slug($this->name).'.'.$fileExt;

    	if(!File::isDirectory(public_path('uploads/ship'))) {
    		File::makeDirectory(public_path('uploads/ship'));
    	}

    	$uploadFile->move(public_path('uploads/ship'), $fileName);

    	if(File::isFile($currentImage)) {
    		File::delete($currentImage);
    	}

    	$this->logo = 'uploads/ship/'.$fileName;
    	$this->save();
    	return true;
    }

}
