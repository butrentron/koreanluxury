@extends('admin.layouts.master')
@section('title')
	Danh sách giao dịch
@endsection
@section('title.name')
	Giao dịch sản phẩm
@endsection
@section('link')
	<li><a href="{{ route('admin.orders.index') }}">
		<img src="{{ asset('images/icons/control/16/list.png') }}" />
		<span>Danh sách</span>
	</a></li>
@endsection
@section('content')
	<div class="widget" id='main_content'>
		@if(Session::has('messages'))
			<div class="alert alert-{{ Session::get('type') }}">
				{{ Session::get('messages') }}
			</div>
		@endif
		<div class="title">
		    <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách giao dịch</h6>
			<div class="num f12">Tổng số: <b>{{ $transactions->count() }}</b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="{{ route('admin.orders.index') }}" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>
						<tr>
							<td class="label" style="width:60px;"><label for="filter_id">Mã số</label></td>
							<td class="item">
								<input name="id" id="filter_id" type="text" value="{{ old('id', Request::get('id') ? Request::get('id') : '') }}" />
							</td>

						    <td class="label" style="width:60px;"><label for="filter_user">Khách hàng</label></td>
							<td class="item">
								<input name="name" id="filter_user" class="tipS" title="Nhập mã thành viên" type="text" value="{{ old('name', Request::get('name') ? Request::get('name') : '') }}" />
							</td>

							<td class="label"><label for="filter_status">Giao dịch</label></td>
							<td class="item">
								<select name="status">
									<option value=""></option>
									<option value='0' {{ old('status', Request::get('status') == 0 ? 'selected=selected' : '') }}>Đợi xử lý</option>
									<option value='1' {{ old('status', Request::get('status') == 1 ? 'selected=selected' : '') }}>Thành công</option>
									<option value='3' {{ old('status', Request::get('status') == 3 ? 'selected=selected' : '') }}>Hủy bỏ</option>
								</select>
							</td>

							<td class="label" style="width:60px;"><label for="filter_created">Từ ngày</label></td>
							<td class="item">
								<input name="created" value="{{ old('created', Request::get('created') ? Request::get('created') : '') }}" id="filter_created" type="text" class="datepicker" />
							</td>

							<td class="label"><label for="filter_created_to">Đến ngày</label></td>
							<td class="item">
								<input name="created_to" value="{{ old('created_to', Request::get('created_to') ? Request::get('created_to') : '') }}" id="filter_created_to" type="text" class="datepicker" />
							</td>
						</tr>
						<tr>
							<td colspan='10' style='width:60px; text-align: center;' >
								<input type="submit" class="button blueB" value="Lọc" />
								<input type="reset" class="basic" value="Reset">
							</td>
							<td class="label"></td>
							<td class="item"></td>
						</tr>
						
						</tbody>
					</table>
				</form>
			</td>
			</tr>
			</thead>
			<thead>
				<tr>
					<td>Mã Đơn hàng</td>
					<td>Tên</td>
					<td>Email</td>
					<td>Số ĐT</td>
					<td>Tình trạng</td>
					<td>Số tiền</td>
					<td>Ngày đặt hàng</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<!-- <tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
					    <div class='pagination'>
				            &nbsp;<strong>1</strong>&nbsp;
				            <a href="admin/cat/index/10">2</a>&nbsp;
				            <a href="admin/cat/index/10">Trang kế tiếp</a>&nbsp;
			            </div>
					</td>
				</tr>
			</tfoot> -->
			
			<tbody>
				@if($transactions->isEmpty())
					<tr class='row_18' col='5'>
						<td colspan="8" class="option">
				 	    	Hiện không có giao dịch nào.
						</td>
					</tr>
				@else
					@foreach($transactions as $transaction)
					    <tr 
					    @if ($transaction->status == 3)  
					    	class="remove"
					    @elseif ($transaction->status == 1) 
					    	class="success"
					    @endif
					    >
							<td>#{!! $transaction->id !!}</td>
							<td>{!! $transaction->name !!}</td>  
							<td>{{ $transaction->email }}</td>  
							<td class="option">{{ $transaction->phone }}</td>  
							<td class="option status textC">{!! $transaction->status == 0 ? '<span class=pending>Chờ xử lý</span>' : ($transaction->status == 1 ? '<span class=completed>Đã xử lý</span>' : '<span class=red>Đã bị hủy</span>') !!}</td> 
							<td style="text-align: right;" class="textR red">{{ number_format($transaction->amount) }}</td> 
							<td class="option">{{ $transaction->created_at }}</td> 
							<td class="option">
								@if($transaction->status != 3)
									<a href="{{ route('admin.orders.show', $transaction->id) }}" title="Xem chi tiết giao dịch" class="tipS button greenB">
										<img src="{{ asset('images/icons/color/view.png') }}" />
									</a>
								@endif
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
@endsection

@section('css')
	<style type="text/css">
		.taskWidget td {
			text-align: left;
		}
		.taskWidget td.option {
		    text-align: center;
		}
		.tipS {
			padding: 5px 10px;
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
		.sTable tbody tr:nth-child(even).remove,
		.sTable tbody tr.remove {
			background: #F9C7C7;
		}
		.sTable tbody tr.success {
			background: rgba(144, 245, 186, 0.4);
		}
	</style>
@endsection