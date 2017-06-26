<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Page;

use App\Http\Requests\PagesRequest;
use App\Http\Requests\UpdatePagesRequest;
use App\Http\Controllers\Controller;
use Baum\MoveNotPossibleException;

class PagesController extends Controller
{
    protected $pages;

    public function __construct(Page $pages)
    {
        $this->pages = $pages;
    }
    
    public function index()
    {
        $pages = $this->pages->all();
        return view('admin.menus.index', compact('pages'));
    }

    public function create()
    {
        $orderPages = $this->__orderPages();
        return view('admin.menus.create', compact(['orderPages']));
    }
   
    public function store(PagesRequest $request)
    {
        $page = $this->pages->create($request->only('name', 'uri', 'content', 'hidden', 'set_title', 'meta_desc', 'meta_key'));

        $this->updatePageOrder($page, $request);
        return redirect()->route('admin.pages.index')->with(['messages' => 'Đã thêm trang mới thành công.', 'type' => 'success']);
    }

    public function show($id)
    {
        //
    }

    private function __orderPages() 
    {
        return $this->pages->where('hidden', false)->orderBy('lft', 'asc')->get();
    }

    public function edit($id)
    {
        $page = $this->pages->find($id);
        if(!$page) abort(404);
        $orderPages = $this->__orderPages();
        return view('admin.menus.edit', compact(['orderPages', 'page']));
    }

    public function update(UpdatePagesRequest $request, $id)
    {
        $page = $this->pages->findOrFail($id);
        if ($response = $this->updatePageOrder($page, $request)) {
            return $response;
        }
        $page->fill($request->only('name', 'uri', 'content', 'hidden', 'set_title', 'meta_desc', 'meta_key'))->save();
        return redirect()->route('admin.pages.index')->with(['messages' => 'Cập nhật trang thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $page = $this->pages->findOrFail($id);

        foreach ($page->children as $child) {
            $child->makeRoot();
        }

        $page->delete();

        return redirect()->route('admin.pages.index')->with(['messages' => 'Xóa trang thành công.', 'type' => 'success']);
    }

    public function delete()
    {
        if(\Request::ajax()) {
            $id = \Request::get('ids');
            $pages = $this->pages->whereIn('id', $id)->get();
            foreach ($pages as $page) {
                foreach($page->children as $child) {
                    //dd($child);
                    $child->makeRoot();
                }
                $page->delete();
            }
            return 'Đã xóa thành công';
        }
    }

    protected function updatePageOrder(Page $page, Request $request)
    {
        if ($request->has('order', 'orderPage')) {
            try {
                $page->updateOrder($request->input('order'), $request->input('orderPage'));
            } catch (MoveNotPossibleException $e) {
                return redirect()->route('admin.pages.index')->with([
                    'messages' => 'Không thể làm trang con.',
                    'type'  => 'error'
                ]);
            }
        }
    }
}
