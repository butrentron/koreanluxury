<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Order;

class OrderController extends Controller
{
	protected $transactions;
	protected $orders;

	public function __construct(Transaction $transactions, Order $orders) {
		$this->transactions = $transactions;
		$this->orders = $orders;
	}

    public function index (Request $request) {
    	$transactions = $this->transactions->all();

    	if($request->get('id') && $request->get('id') != null) {
    		$id = $request->get('id');
    		$transactions = $this->transactions->where('id', $id)->get();

    	}
    	
		if($request->get('name') && $request->get('name') != null) {
			$name = $request->get('name');
			$transactions = $this->transactions->where('name', 'like', '%'.$name.'%')->get();
		}

		if($request->get('status') || $request->get('status') == 0 && $request->get('status') != '') {
			$status = $request->get('status');
			$transactions = $this->transactions->where('status', $status)->get();
		}
		
		if($request->get('created') && $request->get('created') != '') {
			$created = $request->get('created');
			$transactions = $this->transactions->where(\DB::raw("DATE(created_at)"), $created)->get();

			if($request->get('created_to')) {
				$created_to = $request->get('created_to');
				$transactions = $this->transactions->whereBetween(\DB::raw("DATE(created_at)"), [$created, $created_to])->get();
			}
		}

    	return view('admin.orders.index', compact('transactions'));
    }

    public function show( $id ) {
    	$transaction = $this->transactions->where([['id', $id], ['status', '!=' , 3]])->first();
    	if(!$transaction) {
    		return redirect()->route('admin.orders.index')->with(['messages' => 'Đơn hàng không tồn tại.', 'type' => 'error']);
    	}
    	$orders = $transaction->orders()->get();
    	return view('admin.orders.detailOrder', compact('transaction', 'orders'));
    }


    public function update( Request $request ) {
    	if($request->get('trans')) {
    		$transId = $request->get('trans');

	    	$transaction = $this->transactions->find($transId);

	    	$flag = 1;
	    	
	    	$action = $request->get('action');

	    	if($action == 'unconfirm') {
	    		$transaction->update([
		    		'status' => 0
		    	]);

		    	return redirect()->back()->with(['messages' => 'Đã xác nhận chưa thanh toán tiền.', 'type' => 'success']);

	    	} elseif($action == 'unpublish') {

	    		$flag = 3;

	    		$transaction->update([
		    		'status' => 3
		    	]);

		    	if(\Response::json(['success' => true], 200)) {
		            \Mail::send('auth.emails.noti', ['data' => $transaction, 'flag' => $flag], function ($message) use ($transaction) {
		                $message->to($transaction->email, $transaction->name)->subject('Thông báo từ luxury.com!');
		            });
	    			return redirect()->route('admin.orders.index')->with(['messages' => 'Đã hủy đơn hàng thành công.', 'type' => 'success']);
		        }
	    	}

	    	$transaction->update([
	    		'status' => 1
	    	]);
	    	if(\Response::json(['success' => true], 200)) {
	            \Mail::send('auth.emails.noti', ['data' => $transaction, 'flag' => $flag], function ($message) use ($transaction) {
	                $message->to($transaction->email, $transaction->name)->subject('Thông báo từ luxury.com!');
	            });
	    		return redirect()->back()->with(['messages' => 'Đã xác nhận thanh toán tiền.', 'type' => 'success']);
	        }
    	} elseif($request->get('order')) {
    		$ordersId = $request->get('order');
	    	$order = $this->orders->find($ordersId);
	    	$action = $request->get('action');
	    	if($action == 'unconfirm') {
	    		$order->update([
		    		'status' => 0
		    	]);
		    	return redirect()->back()->with(['messages' => 'Đã xác nhận chưa giao hàng.', 'type' => 'success']);
	    	}
	    	$order->update([
	    		'status' => 1
	    	]);
	    	return redirect()->back()->with(['messages' => 'Đã xác nhận giao hàng.', 'type' => 'success']);
    	}
    }

}
