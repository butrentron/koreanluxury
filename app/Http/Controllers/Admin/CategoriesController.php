<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Http\Controllers\Controller;
use Baum\MoveNotPossibleException;

use App\Category;

class CategoriesController extends Controller
{
    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $orderCategories = $this->__orderCategories();
        return view('admin.categories.create', compact(['orderCategories']));
    }

    public function store(CategoriesRequest $request)
    {
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        }else {
            $input['slug'] = $request->name; 
        }
        $categories = $this->categories->create($input);

        $this->updateCatgoryOrder($categories, $request);
        return redirect()->route('admin.categories.index')->with(['messages' => 'Đã thêm danh mục mới thành công.', 'type' => 'success']);
    }
   
    private function __orderCategories() 
    {
        return $this->categories->orderBy('lft', 'asc')->get();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = $this->categories->find($id);
        if(!$category) abort(404);
        $orderCategories = $this->__orderCategories();
        return view('admin.categories.edit', compact(['orderCategories', 'category']));
    }

    public function update(UpdateCategoriesRequest $request, $id)
    {
        $category = $this->categories->findOrFail($id);

        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        }else {
            $input['slug'] = $request->name; 
        }

        if ($response = $this->updateCatgoryOrder($category, $request)) {
            return $response;
        }

        $categories = $category->update($input);

        return redirect()->route('admin.categories.index')->with(['messages' => 'Cập nhật danh mục thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $category = $this->categories->findOrFail($id);

        foreach ($category->children as $child) {
            $child->makeRoot();
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with(['messages' => 'Xóa danh mục thành công.', 'type' => 'success']);
    }

    public function delete()
    {
        if(\Request::ajax()) {
            $id = \Request::get('ids');
            $categories = $this->categories->whereIn('id', $id)->get();
            foreach ($categories as $category) {
                foreach($category->children as $child) {
                    $child->makeRoot();
                }
                $category->delete();
            }
            return 'Đã xóa thành công';
        }
    }


    protected function updateCatgoryOrder(Category $category, Request $request)
    {
        if ($request->has('order', 'orderCategory')) {
            try {
                $category->updateOrder($request->input('order'), $request->input('orderCategory'));
            } catch (MoveNotPossibleException $e) {
                return redirect()->route('admin.categories.index')->with([
                    'messages' => 'Không thể làm danh mục con.',
                    'type'  => 'error'
                ]);
            }
        }
    }
}
