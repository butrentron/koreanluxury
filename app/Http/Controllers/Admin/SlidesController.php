<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\SlideRequest;
use App\Http\Controllers\Controller;
use App\Slide;
use File;

class SlidesController extends Controller
{
    protected $slides;

    public function __construct(Slide $slides) {
        $this->slides = $slides;
    }

    public function index()
    {
        $slides = $this->slides->all();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(SlideRequest $request)
    {
        $slide = $this->slides->create($request->all());

        if($request->file('image')) {
            $slide->setImage($request->file('image'));
        }
        return redirect()->route('admin.slides.index')->with(['messages' => 'Đã thêm slide mới thành công.', 'type' => 'success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slide = $this->slides->find($id);
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = $this->slides->find($id);
        if(!$slide) abort(404);

        $slide->update($request->all());

        if($request->hasFile('image')) {
            $slide->setImage($request->file('image'));
        }

        return redirect()->route('admin.slides.index')->with(['messages' => 'Đã cập nhật slide thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $slide = $this->slides->find($id);
        if(!$slide) abort(404);
        $slide->delete();
        $currentImage = public_path($slide->image);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        return redirect()->route('admin.slides.index')->with(['messages' => 'Đã xóa slide thành công.', 'type' => 'success']);
    }
}
