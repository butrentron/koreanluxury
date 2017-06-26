<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use Carbon\Carbon;

class Slide extends Model
{
    protected $table = 'slides';
    protected $fillable = ['title', 'image', 'desc', 'link', 'publish'];

    public function setImage(UploadedFile $uploadFile) {
    	$currentImage = public_path($this->image);
    	$timeNow = Carbon::now();

    	$fileExt = $uploadFile->getClientOriginalExtension();
    	$fileName = str_slug($this->title).'.'.$fileExt;

    	if(!File::isDirectory(public_path('uploads/slides'))) {
    		File::makeDirectory(public_path('uploads/slides'));
    	}

    	$uploadFile->move(public_path('uploads/slides'), $fileName);

    	if(File::isFile($currentImage)) {
    		File::delete($currentImage);
    	}

    	$this->image = 'uploads/slides/'.$fileName;
    	$this->save();
    	return true;
    }
}
