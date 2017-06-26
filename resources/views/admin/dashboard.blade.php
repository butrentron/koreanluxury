@extends('admin.layouts.master')
@section('title')
	Dashboard
@endsection
@section('title.name')
	Dashboard
@endsection
@section('content')
	<div>
		@if(Session::has('messages'))
			<div class="alert alert-{{ Session::get('type') }}">
				{{ Session::get('messages') }}
			</div>
		@endif
		
		<div class="gallery">
            <ul>
                <li>
                	<span>Có {{ \App\Category::count() }} danh mục sản phẩm</span>
                </li>
                <li>
                	<span>Có {{ \App\Product::count() }} sản phẩm</span>
                </li>
                <li>
                	<span>Có {{ \App\Transaction::count() }} đơn hàng được đặt</span>
                </li>
            </ul>
        </div>	    
	</div>
	<div class="trans">
		<h5>Các đơn hàng gần đây</h5>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
					<td>Mã Đơn hàng</td>
					<td>Tên</td>
					<td>Tình trạng</td>
					<td>Số tiền</td>
				</tr>
			</thead>
			
			<tbody>
				@foreach(\App\Transaction::orderBy('id', 'desc')->where('status', '!=', 3)->take(5)->get() as $transaction)
				    <tr 
				    @if ($transaction->status == 3)  
				    	class="remove"
				    @elseif ($transaction->status == 1) 
				    	class="success"
				    @endif
				    >
						<td>
							<p><a href="{{ route('admin.orders.show', $transaction->id) }}">#{!! $transaction->id !!}</a></p>
							<p>{{ $transaction->created_at }}</p>
						</td>
						<td>
							<p>{!! $transaction->name !!}</p>
							<p>{{ $transaction->email }} - {{ $transaction->phone }}</p>
						</td>  
						<td class="option status textC">{!! $transaction->status == 0 ? '<span class=pending>Chờ xử lý</span>' : ($transaction->status == 1 ? '<span class=completed>Đã xử lý</span>' : '<span class=red>Đã bị hủy</span>') !!}</td> 
						<td style="text-align: right;" class="textR red">{{ number_format($transaction->amount) }}</td> 
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="trans-success">
		<h5>Thống kê bán</h5>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			<tbody>
				<tr>
					<td>Tuần trước: {{ number_format($count_money_last_week) }} <sup>vnđ</sup></td>
				</tr>
				<tr>
					<td>Ngày trước: {{ number_format($count_money_yesterday) }} <sup>vnđ</sup></td>
				</tr>
				<tr>
					<td>Trong tháng: {{ number_format($count_money_month) }} <sup>vnđ</sup></td>
				</tr>
				<tr>
					<td>Trong năm: {{ number_format($count_money_year) }} <sup>vnđ</sup></td>
				</tr>
				
				<tr>
					<td>Tất cả: {{ number_format($count_money) }} <sup>vnđ</sup></td>
				</tr>

			</tbody>
		</table>
	</div>
	<div class="clear"></div>
	<div class="product" style="margin-top: 20px">
		<h5>Sản phẩm được xem nhiều nhất</h5>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
					<td colspan="2">Tên</td>
					<td>Mô tả</td>
					<td>Giá</td>
					<td>Thương hiệu</td>
					<td>Danh mục sp</td>
				</tr>
			</thead>
			
			<tbody>
				@foreach(\App\Product::orderBy('view', 'desc')->take(5)->get() as $product)
				    <tr class='row_{{ $product->id }}'>
						<td width="70"><img src="{{ url($product->image) }}" alt="{{ $product->slug }}" title="{{ $product->slug }}" width="70" height="80"></td>
						<td>
							<p>{{ $product->name }}</p>
							<p style="font-size: 11px;"><span style="text-decoration: underline;">View:</span> {{ $product->view }}</p>
						</td>  
						<td>{{ $product->desc }}</td>  
						<td class="option">
							@if($product->sale > 0)
								<span class="sale">{{ $product->sale }}%</span>
								<p class="unlink">{{ number_format($product->price) }} vnđ</p>
								<p>{{ number_format($product->price_at) }} <span style="font-size: 11px">vnđ</span></p>
							@else
								{{ number_format($product->price) }} <sub style="vertical-align: super; font-size: 10px;">vnđ</sub>
							@endif
						</td>  
						<td class="option">{{ $product->brands->name }}</td>  
						<td class="option">{{ $product->categories->name }}</td>  
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('css')
	<style type="text/css" media="screen">
		.gallery ul {
			text-align: center;
		}

		.gallery ul li {
            width: 250px;
            height: 100px;
        }

		.sTable tbody tr:nth-child(even).remove,
		.sTable tbody tr.remove {
			background: #F9C7C7;
		}
		.sTable tbody tr.success {
			background: rgba(144, 245, 186, 0.4);
		}
		
		.trans {
			margin-top: 15px;
			width: 65%;
			float: left;
		}

		.trans-success {
			margin-top: 15px;
			width: 30%;
			float: right;
		}
		.trans h5, .trans-success h5 {
			margin-bottom: 15px;
		}
		.sale {
			border-radius: 100%;
			background: #337ab7;
			color: #FFF;
			padding: 7px;
			font-size: 12px;
		}
		.unlink {
			text-decoration: line-through;
    		color: #E22B2B;
    		font-size: 11px;
		}
	</style>
@stop