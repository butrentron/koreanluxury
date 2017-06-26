@extends('admin.layouts.master')
@section('title')
	Sản phẩm
@endsection
@section('title.name')
	Quản lý sản phẩm
@endsection
@section('link')
	<li><a href="{{ route('admin.products.create') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Thêm mới</span>
	</a></li>
	
	<li><a href="{{ route('admin.products.index') }}">
		<img src="{{ asset('images/icons/control/16/list.png') }}" />
		<span>Danh sách</span>
	</a></li>
@endsection
@section('content')
	<div class="widget" id='main_product'>
		@if(Session::has('messages'))
			<div class="alert alert-{{ Session::get('type') }}">
				{{ Session::get('messages') }}
			</div>
		@endif
		<div class="title">
		    <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách trang</h6>
			<div class="num f12">Tổng số: <b>{{ $products->count() }}</b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="{{ route('admin.products.index') }}" method="get">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td class="label" style="width:40px;"><label for="filter_id">Tên</label></td>
								<td class="item" style="width:155px;" >
									<input name="name" value="{{ Request::get('name') ? Request::get('name') : '' }}" id="filter_iname" type="text" style="width:155px;" autocomplete="off" />
								</td>
								
								<td class="label" style="width:60px;"><label for="filter_status">Danh mục</label></td>
								<td class="item">
									<select name="category_id" _autocheck="true" id='param_cat' class="left">
										<option value="0">Lựa chọn danh mục</option>
										@foreach( $categories as $category )
										    <option value="{{ $category->id }}" {{ Request::get('category_id') == $category->id ? 'selected=selected' : '' }}>{!! $category->paddedName() !!}</option>
										@endforeach
									</select>
								</td>

								<td class="label" style="width:60px;"><label for="filter_status">Thương hiệu</label></td>
								<td class="item">
									<select name="brand_id" style="border-radius: 0">
										<option value="0">Lựa chọn thương hiệu</option>
										@foreach( $brands as $brand )
										    <option value="{{ $brand->id }}" {{ Request::get('brand_id') == $brand->id ? 'selected=selected' : '' }}>-- {!! $brand->name !!}</option>
										@endforeach
									</select>
								</td>
								
								<td style='width:150px'>
									<input type="submit" class="button blueB" value="Lọc" />
									<input type="reset" class="basic" value="Reset">
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</thead>

			<thead>
				<tr>
				    <td style="width:21px;"><img src="{{ asset('images/icons/tableArrows.png') }}" /></td>
					<td colspan="2">Tên</td>
					<td>Mô tả</td>
					<td>Giá</td>
					<td>Thương hiệu</td>
					<td>Danh mục sp</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_products">
				<tr>
					<td colspan="9">
					    <div class="list_action itemActions">
							<a href="{{ route('admin.products.delete') }}" id="submit" class="button blueB" url="{{ route('admin.products.delete') }}">
								<span style='color:white;'>Xóa các checkbox đã chọn</span>
							</a>
						</div>
							
					    <div class='pagination'>
				           {!! $products->appends(Request::query())->render() !!}
			            </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
				@if($products->isEmpty())
					<tr>
						<td colspan="9" class="option">
				 	    	Hiện chưa có trang nào được tạo.
						</td>
					</tr>
				@else
					@foreach($products as $product)
					    <tr class='row_{{ $product->id }}'>
					        <td><input type="checkbox" name="id[]" value="{{ $product->id }}" /></td>
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
							<td class="option">
								<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" accept-charset="utf-8">
									{!! csrf_field() !!}
									{!! method_field('DELETE') !!}
									<a href="{{ route('admin.products.show', $product->id) }}" title="Xem chi tiết sản phẩm" class="tipS button greenB">
										<img src="{{ asset('images/icons/color/view.png') }}" />
									</a>
									<a href="{{ route('admin.products.edit', $product->id) }}" title="Chỉnh sửa" class="tipS button blueB">
										<img src="{{ asset('images/icons/color/edit.png') }}" />
									</a>
									<button title="Xóa" class="tipS button redB" onclick="return confirm('Hãy cân nhắc trước khi xóa, bởi nó có thể làm thay đổi hệ thống của bạn.');">
										<img src="{{ asset('images/icons/color/delete.png') }}"/>
									</button>
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
