@extends('admin.layouts.master')
@section('title')
	Danh sách các thành viên quản trị
@endsection
@section('title.name')
	Quản lý thành viên
@endsection
@section('link')
	<li><a href="{{ route('admin.register') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Thêm mới</span>
	</a></li>
	
	<li><a href="{{ route('admin.list') }}">
		<img src="{{ asset('images/icons/control/16/list.png') }}" />
		<span>Danh sách</span>
	</a></li>
@endsection
@section('content')
	<div class="widget">
		@if(Session::has('messages'))
			<div class="alert alert-{{ Session::get('type') }}">
				{{ Session::get('messages') }}
			</div>
		@endif
		<div class="title">
			<img src="{{ asset('images/icons/dark/dialog.png') }}" class="titleIcon" />
			<h6>Danh sách nhà thành viên</h6>
			<div class="num f12">Tổng số: <b>{{ $members->count() }}</b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
				    <td style="width:21px;"><img src="{{ asset('images/icons/tableArrows.png') }}" /></td>
					<td width="120">Tên</td>
					<td>Email</td>
					<td width="120">Vai trò</td>
					<td width="120">Kích hoạt</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tbody>
				@foreach($members as $member)
				    <tr class='row_{{ $member->id }}'>
				        <td class="option">{!! $member->id !!}</td>
						<td class="option">{!! $member->name !!}</td>  
						<td class="option">{!! $member->email !!}</td>  
						<td class="option">{!! $member->role !!}</td>  
						<td class="option">
						@if( $member->active == 1) 
							Đang hoạt động
						@else
							Đang ngừng hoạt động
						@endif
						</td>  
						<td class="option">
							@if(($member->role != 'superadmin') || ($member->id == Auth::guard('admin')->user()->id))
								<a href="{{ route('admin.edit', $member->id) }}" title="Cập nhật" class="tipS button redB">
									<img src="{{ asset('images/icons/color/edit.png') }}"/>
								</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
			    
	</div>
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
		.tranB {
			background: transparent;
			border: 0;
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