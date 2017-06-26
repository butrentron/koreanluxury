@extends('admin.layouts.master')
@section('title')
	Nhà cung cấp / thương hiệu
@endsection
@section('title.name')
	Quản lý nhà cung cấp / thương hiệu
@endsection
@section('link')
	<li><a href="{{ route('admin.brands.create') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Thêm mới</span>
	</a></li>
	
	<li><a href="{{ route('admin.brands.index') }}">
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
			<h6>Danh sách nhà cung cấp</h6>
			<div class="num f12">Tổng số: <b>{{ $brands->count() }}</b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
				    <td style="width:21px;"><img src="{{ asset('images/icons/tableArrows.png') }}" /></td>
					<td width="120">Tên</td>
					<td>Mô tả</td>
					<td width="120">Logo</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="5">
					    <div class="list_action itemActions">
							<a href="{{ route('admin.brands.delete') }}" id="submit" class="button blueB" url="{{ route('admin.brands.delete') }}">
								<span style='color:white;'>Xóa các checkbox đã chọn</span>
							</a>
						</div>
							
					    <div class='pagination'>
				            &nbsp;<strong>1</strong>&nbsp;
				            <a href="admin/cat/index/10">2</a>&nbsp;
				            <a href="admin/cat/index/10">Trang kế tiếp</a>&nbsp;
			            </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
				@if($brands->isEmpty())
					<tr class='row_18' col='5'>
						<td colspan="5" class="option">
				 	    	Hiện chưa có nhà cung cấp nào.
						</td>
					</tr>
				@else
					@foreach($brands as $brand)
					    <tr class='row_{{ $brand->id }}'>
					        <td><input type="checkbox" name="id[]" value="{{ $brand->id }}" /></td>
							<td class="option">{!! $brand->name !!}</td>  
							<td class="option">{!! ($brand->description != '') ? $brand->description : '<i>Chưa có mô tả nào cho thương hiệu (nhà cung cấp) này</i>' !!}</td>  
							<td class="option"><img src="{{ url($brand->image) }}" alt="" title="" width="100" height="70"></td>  
							<td class="option">
								<form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" accept-charset="utf-8">
									{!! csrf_field() !!}
									{{ method_field('DELETE') }}
									<a href="{{ route('admin.brands.edit', $brand->id) }}" title="Chỉnh sửa" class="tipS button blueB">
										<img src="{{ asset('images/icons/color/edit.png') }}" />
									</a>
									<button title="Xóa" class="tipS button redB" onclick="return confirm('Hãy cân nhắc trước khi xóa, bởi nó có thể làm thay đổi hệ thống của bạn.');"><img src="{{ asset('images/icons/color/delete.png') }}"/></button>
								</form>
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
	</style>
@endsection