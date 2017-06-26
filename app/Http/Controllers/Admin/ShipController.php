<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ship;
use File;



class ShipController extends Controller
{
    protected $ships;

    public function __construct(Ship $ships)
    {
        $this->ships = $ships;
    }

    public function index()
    {
        $ships = $this->ships->all();
        return view('admin.ships.index', compact('ships'));
    }

    public function create()
    {
        return view('admin.ships.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $ships = $this->ships->create($input);
        if($request->file('logo')) {
            $ships->setImage($request->file('logo'));
        }

        return redirect()->route('admin.ship.index')->with(['messages' => 'Đã thêm dịch vụ chuyển phát thành công.', 'type' => 'success']);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $ship = $this->ships->find($id);
        if(!$ship) abort(404);
        return view('admin.ships.edit', compact(['ship']));
    }

    public function update(Request $request, $id)
    {
        $ship = $this->ships->find($id);
        if(!$ship) abort(404);
        $input = $request->all();

        $ship->update($input);

        if($request->hasFile('logo')) {
            $ship->setImage($request->file('logo'));
        }

        return redirect()->route('admin.ship.index')->with(['messages' => 'Đã cập nhật thành công.', 'type' => 'success']);
    }

    public function destroy($id)
    {
        $ship = $this->ships->find($id);
        if(!$ship) abort(404);
        $ship->delete();
        $currentImage = public_path($ship->image);
        if(File::isFile($currentImage)) {
            File::delete($currentImage);
        }
        return redirect()->route('admin.ship.index')->with(['messages' => 'Đã xóa một dịch vụ chuyển phát thành công.', 'type' => 'success']);
    }

    public function delete()
    {
        if(\Request::ajax()) {
            $id = \Request::get('ids');
            $ships = $this->ships->whereIn('id', $id)->get();
            foreach ($ships as $ship) {
                $currentImage = public_path($ship->image);
                if(File::isFile($currentImage)) {
                    File::delete($currentImage);
                }
                $ship->delete();
            }
            return 'Đã xóa thành công';
        }
    }
}
