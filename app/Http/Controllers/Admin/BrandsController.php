<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\BrandsRequest;
use App\Http\Requests\UpdateBrandsRequest;
use App\Http\Controllers\Controller;
use App\Brand;
use File;

class BrandsController extends Controller
{
    protected $brands;

    public function __construct(Brand $brands)
    {
        $this->brands = $brands;
    }

    public function index()
    {
        $brands = $this->brands->all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandsRequest $request)
    {
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        }else {
            $input['slug'] = $request->name; 
        }
        $brands = $this->brands->create($input);

        if($request->file('image')) {
            $brands->setImage($request->file('image'));
        }

        return redirect()->route('admin.brands.index')->with(['messages' => 'Đã thêm nhà cung cấp mới thành công.', 'type' => 'success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brand = $this->brands->find($id);
        if(!$brand) abort(404);
        return view('admin.brands.edit', compact(['brand']));
    }

    public function update(UpdateBrandsRequest $request, $id)
    {
        $brand = $this->brands->find($id);
        if(!$brand) abort(404);
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        }else {
            $input['slug'] = $request->name; 
        }

        $brand->update($input);

        if($request->hasFile('image')) {
            $brand->setImage($request->file('image'));
        }

        return redirect()->route('admin.brands.index')->with(['messages' => 'Đã cập nhật nhà cung cấp thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $brand = $this->brands->find($id);
        if(!$brand) abort(404);
        $brand->delete();
        $currentImage = public_path($brand->image);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        return redirect()->route('admin.brands.index')->with(['messages' => 'Đã xóa nhà cung cấp thành công.', 'type' => 'success']);
    }

    public function delete()
    {
        if(\Request::ajax()) {
            $id = \Request::get('ids');
            $brands = $this->brands->whereIn('id', $id)->get();
            foreach ($brands as $brand) {
                $currentImage = public_path($brand->image);
                if(File::isFile($currentImage)) {
                    File::delete($currentImage);
                }
                $brand->delete();
            }
            return 'Đã xóa thành công';
        }
    }
}
