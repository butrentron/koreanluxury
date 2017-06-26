@extends('admin.layouts.master')
@section('title')
	Nhà cung cấp / thương hiệu
@endsection
@section('title.name')
	Quản lý dịch vụ chuyển phát
@endsection
@section('link')
	<li><a href="{{ route('admin.ship.create') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Thêm mới</span>
	</a></li>
	
	<li><a href="{{ route('admin.ship.index') }}">
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
			<h6>Danh sách dịch vụ chuyển phát</h6>
			<div class="num f12">Tổng số: <b>{{ $ships->count() }}</b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
				    <td style="width:21px;"><img src="{{ asset('images/icons/tableArrows.png') }}" /></td>
					<td width="120">Tên</td>
					<td width="120">website</td>
					<td>Mô tả</td>
					<td width="120">Logo</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="6">
					    <div class="list_action itemActions">
							<a href="{{ route('admin.ship.delete') }}" id="submit" class="button blueB" url="{{ route('admin.ship.delete') }}">
								<span style='color:white;'>Xóa các checkbox đã chọn</span>
							</a>
						</div>
							<!-- 
					    <div class='pagination'>
				            &nbsp;<strong>1</strong>&nbsp;
				            <a href="admin/cat/index/10">2</a>&nbsp;
				            <a href="admin/cat/index/10">Trang kế tiếp</a>&nbsp;
			            </div> -->
					</td>
				</tr>
			</tfoot>
			
			<tbody>
				@if($ships->isEmpty())
					<tr class='row_18' col='5'>
						<td colspan="5" class="option">
				 	    	Hiện chưa có dịch vụ nào.
						</td>
					</tr>
				@else
					@foreach($ships as $ship)
					    <tr class='row_{{ $ship->id }}'>
					        <td><input type="checkbox" name="id[]" value="{{ $ship->id }}" /></td>
							<td class="option">{!! $ship->name !!}</td> 
							<td class="option"><a href="{{ $ship->url }}" style="color:#3ab377" target="_bank">{!! $ship->website !!}</a></td> 
							<td class="option">{!! ($ship->desc != '') ? $ship->desc : '<i>Chưa có mô tả nào cho dịch vụ này</i>' !!}</td>  
							<td class="option"><img src="{{ url($ship->logo) }}" alt="" title="" width="80" height="50"></td>  
							<td class="option">
								<form action="{{ route('admin.ship.destroy', $ship->id) }}" method="POST" accept-charset="utf-8">
									{!! csrf_field() !!}
									{{ method_field('DELETE') }}
									<a href="{{ route('admin.ship.edit', $ship->id) }}" title="Chỉnh sửa" class="tipS button blueB">
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