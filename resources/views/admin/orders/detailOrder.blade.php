@extends('admin.layouts.master')
@section('title')
	Chi tiết giao dịch
@endsection
@section('title.name')
	Giao dịch sản phẩm
@endsection
@section('link')
	<li>
		<form action="{{ route('admin.orders.update', ['action' => 'unpublish', 'trans' => $transaction->id]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<button title="Xác nhận hủy đơn hàng" onclick="return confirm('Bạn muốn hủy đơn hàng này.');">
				<img src="{{ asset('images/icons/color/delete.png') }}"/>
				<span>Hủy đơn hàng</span>
			</button>
		</form>
	</li>
	<li>
		<a href="{{ route('admin.orders.index') }}">
			<img src="{{ asset('images/icons/control/16/list.png') }}" />
			<span>Danh sách</span>
		</a>
	</li>
@endsection
@section('content')
	@if(Session::has('messages'))
		<div class="alert alert-{{ Session::get('type') }}">
			{{ Session::get('messages') }}
		</div>
	@endif
	<div style="margin-top: 15px"><h5>Mã đơn hàng: {{ $transaction->id }}</h5></div>

	<div class="widget" id='main_content'>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<tbody>
			@foreach($orders as $order)
			<?php $order_data = json_decode($order->data); ?>
				<tr>
					<td width="100">
						@if($order->status == 0)
						<form action="{{ route('admin.orders.update',  [ 'order' => $order->id ]) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<button class="tipS button blueB" title="Xác nhận đã giao hàng">Đã giao hàng</button>
						</form>
						@else
						<form action="{{ route('admin.orders.update', ['action' => 'unconfirm', 'order' => $order->id]) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<button class="tipS button redB" title="Xác nhận chưa giao hàng">Chưa giao hàng</button>
						</form>
						@endif
					</td>
					<td width="60"><img src="{{ url($order->products->image) }}" width="60" height="75" /></td>
					<td>{{ $order->products->name }}</td>
					<td>{{ $order->qty }}</td>
					<td>{{ $order_data->colors ? $order_data->colors : '-' }}</td>
					<td>{{ $order_data->sizes ? $order_data->sizes : '-' }}</td>
					<td>{{ number_format($order->amount) }}</td>
				</tr>
			@endforeach
				<tr>
					<td colspan="6">Tổng tiền</td>
					<td>{{ number_format($transaction->amount) }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="margin-top: 15px"><h5>Thông tin liên hệ</h5></div>
	<div class="widget" id='main_content'>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
					<td>Mã đơn hàng</td>
					<td>Tên</td>
					<td>Email</td>
					<td>Số ĐT</td>
					<td>Địa chỉ gửi hàng</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $transaction->id }}</td>
					<td>{{ $transaction->name }}</td>
					<td>{{ $transaction->email }}</td>
					<td>{{ $transaction->phone }}</td>
					<td>{{ $transaction->address }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div style="margin-top: 15px" id="handle"><h5>Xử lý đơn hàng</h5></div>
	<div class="widget" id='main_content'>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<tbody>
				<tr>
					<td> {!! $transaction->status == 1 ? '<span class=read-ok>Đã thanh toán</span>' : '<span class=read-not-ok>Chưa thanh toán</span>' !!} </td>
					<td>Thanh toán </td>
					<td>Xác nhận đã thanh toán số tiền {{ number_format($transaction->amount) }} vnđ từ khách hàng {{ $transaction->name }}</td>
					<td>
						@if($transaction->status != 1)
						<form action="{{ route('admin.orders.update', [ 'trans' => $transaction->id]) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<button class="tipS button blueB" title="Xác nhận đã thanh toán" onclick="return confirm('Xác nhận khách hàng đã thanh toán tiền cho đơn hàng này.');">Đã thanh toán</button>
						</form>
						<!-- <form action="{{ route('admin.orders.update', ['action' => 'unconfirm', 'trans' => $transaction->id]) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<button class="tipS button redB" title="Xác nhận chưa thanh toán" onclick="return confirm('Xác nhận khách hàng chưa thanh toán cho đơn hàng này.');">Chưa thanh toán</button>
						</form> -->
						@endif
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection

@section('css')
	<style type="text/css">
		.taskWidget td {
			text-align: center;
		}
		.taskWidget td.option {
		    text-align: center;
		}
		.tipS {
			padding: 5px 10px;
		}
		table.myTable a.tipS {
			color: #FFF;
		}

		span.read-ok {
			color: #80AB21;
		}

		span.read-not-ok {
			color: #900;
		}
		.alert {
			padding: 10px;
			color: #FFF;
		}
		.alert-success {
			background: #3672a0;
		}
		.alert-error {
			background: #9f352b;
		}
		.horControlB ul li button {
		    display: block;
		    font-weight: bold;
		    white-space: nowrap;
		    color: #626262;
		    border: 0;
		    padding: 5px 0 0px;
		    max-height: 38px;
		    background: transparent;
		}
		.horControlB ul li button img {
		    margin: 7px 12px 10px 12px;
		}
		.horControlB ul li button span {
		    display: block;
		    margin: 0px 0 0 40px;
		    padding: 10px 16px 8px 16px;
		    border-left: 1px solid #d5d5d5;
		}
	</style>
@endsection