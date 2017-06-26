<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Type;

class TypesController extends Controller
{ 
    protected $types;

    public function __construct(Type $types)
    {
        $this->types = $types;
    }
    public function index()
    {
        $types = $this->types->all();
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
       return view('admin.types.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        }else {
            $input['slug'] = $request->name; 
        }
        $types = $this->types->create($input);
        return redirect()->route('admin.types.index')->with(['messages' => 'Đã thêm mục mới mới thành công.', 'type' => 'success']);
   
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $type = $this->types->find($id);
        if(!$type) abort(404);
        return view('admin.types.edit', compact(['type']));
    }

    public function update(Request $request, $id)
    {
        $type = $this->types->find($id);
        $input = $request->all();
        if($request->slug != '') {
            $input['slug'] = $request->slug;
        }else {
            $input['slug'] = $request->name; 
        }
        $type->update($input);
        return redirect()->route('admin.types.index')->with(['messages' => 'Cập nhật mục thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $type = $this->types->find($id);
        if(!$type) abort(404);
        $type->delete();
        return redirect()->route('admin.types.index')->with(['messages' => 'Đã xóa mục thành công.', 'type' => 'success']);
   }

    public function delete()
    {
        if(\Request::ajax()) {
            $id = \Request::get('ids');
            $types = $this->types->whereIn('id', $id)->get();
            foreach ($types as $type) {
                $type->delete();
            }
            return 'Đã xóa thành công';
        }
    }
}
