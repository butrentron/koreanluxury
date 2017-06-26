<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\ProductsRequest;
use App\Http\Controllers\Controller;

use App\Product;
use File;

class ProductsController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index(Request $request)
    {
        $products = $this->products->orderBy('id','desc')->paginate(30);
        $categories   = $this->__getCategories();
        $brands     = $this->__getBrands();

        if($request->get('name') && $request->get('name') != null) {
            $name = $request->get('name');
            $products = $this->products->where('name', 'like', '%'.$name.'%')->get();
        }

        if($request->get('category_id') && $request->get('category_id') != 0) {
            $category_id = $request->get('category_id');
            $products = $this->products->where('category_id', $category_id)->get();
        }

        if($request->get('brand_id') && $request->get('brand_id') != 0) {
            $brand_id = $request->get('brand_id');
            $products = $this->products->where('brand_id', $brand_id)->get();
        }

        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    public function create()
    {
        $categories   = $this->__getCategories();
        $brands     = $this->__getBrands();
        $types      = $this->__getTypes();
        return view('admin.products.create', compact('categories', 'brands', 'types'));
    }

    private function __getCategories() {
        return \App\Category::all();
    }

    private function __getBrands() {
        return \App\Brand::select('id', 'name')->get();
    }

    private function __getTypes() {
        return \App\Type::select('id', 'name')->get();
    }

    public function store(ProductsRequest $request)
    {
        $input = $request->all();

        if($request->slug != '') {
            $input['slug'] = $request->slug;
        } else {
            $input['slug'] = $request->name; 
        }

        $input['price_at'] = ((100-$request->sale)/100) * $request->price;

        $product = $this->products->create($input);

        $product->types()->attach($request->type_id);

        if($request->file('image')) {
            $product->setImage($request->file('image'));
        }

        return redirect()->route('admin.products.index')->with(['messages' => 'Đã thêm sản phẩm mới thành công.', 'type' => 'success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = $this->products->find($id);
        if(!$product) abort(404);
        $categories   = $this->__getCategories();
        $brands     = $this->__getBrands();
        $types      = $this->__getTypes();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'types'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->products->find($id);
        if(!$product) abort(404);

        $input = $request->all();

        if($request->slug != '') {
            $input['slug'] = $request->slug;
        } else {
            $input['slug'] = $request->name; 
        }
        
        $input['price_at'] = ((100-$request->sale)/100) * $request->price;

        $product->update($input);
        $product->types()->detach();
        $product->types()->sync($request->type_id);

        if($request->file('image')) {
            $product->setImage($request->file('image'));
        }

        return redirect()->route('admin.products.index')->with(['messages' => 'Đã thêm sản phẩm mới thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $product = $this->products->find($id);
        if(!$product) abort(404);
        $product->delete();
        $currentImage = public_path($product->image);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        return redirect()->route('admin.products.index')->with(['messages' => 'Đã xóa sản phẩm thành công.', 'type' => 'success']);
    }

    public function delete()
    {
        if(\Request::ajax()) {
            $id = \Request::get('ids');
            $products = $this->products->whereIn('id', $id)->get();
            foreach ($products as $product) {
                $currentImage = public_path($product->image);
                if(File::isFile($currentImage)) {
                    File::delete($currentImage);
                }
                $product->delete();
            }
            return 'Đã xóa thành công';
        }
    }
}
