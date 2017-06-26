@extends('admin.layouts.master')
@section('title')
	Danh mục sản phẩm
@endsection
@section('title.name')
	Quản lý danh mục sản phẩm
@endsection
@section('link')
	<li><a href="{{ route('admin.categories.create') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Thêm mới</span>
	</a></li>
	
	<li><a href="{{ route('admin.categories.index') }}">
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
			<h6>Danh sách danh mục</h6>
			<div class="num f12">Tổng số: <b>{{ $categories->count() }}</b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
				    <td style="width:21px;"><img src="{{ asset('images/icons/tableArrows.png') }}" /></td>
					<td>Tên</td>
					<td>Slug</td>
					<td>Mô tả</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="5">
					    <div class="list_action itemActions">
							<a href="{{ route('admin.categories.delete') }}" id="submit" class="button blueB" url="{{ route('admin.categories.delete') }}">
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
				@if($categories->isEmpty())
					<tr class='row_18' col='5'>
						<td colspan="5" class="option">
				 	    	Hiện chưa có danh mục nào được tạo.
						</td>
					</tr>
				@else
					@foreach($categories as $category)
					    <tr class='row_{{ $category->id }}'>
					        <td><input type="checkbox" name="id[]" value="{{ $category->id }}" /></td>
							<td>{!! $category->paddedName() !!}</td>  
							<td>{{ $category->slug }}</td>  
							<td class="option">{{ $category->desc }}</td>  
							<td class="option">
								<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" accept-charset="utf-8">
									{!! csrf_field() !!}
									{{ method_field('DELETE') }}
									<a href="{{ route('admin.categories.edit', $category->id) }}" title="Chỉnh sửa" class="tipS button blueB">
										<img src="{{ asset('images/icons/color/edit.png') }}" />
									</a>
									<button title="Xóa" class="tipS button redB"  onclick="return confirm('Hãy cân nhắc trước khi xóa, bởi nó có thể làm thay đổi hệ thống của bạn.');"><img src="{{ asset('images/icons/color/delete.png') }}"/></button>
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