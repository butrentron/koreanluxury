@extends('admin.layouts.master')
@section('title')
	Slide index
@endsection
@section('title.name')
	Quản lý slide
@endsection
@section('link')
	<li><a href="{{ route('admin.slides.create') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Thêm mới</span>
	</a></li>
	
	<li><a href="{{ route('admin.slides.index') }}">
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
			<h6>
				Danh sách 
				Slide 
			</h6>
		</div>
		
		<div class="gallery">
            <ul>
            	@foreach($slides as $slide)
                <li id='{{ $slide->id }}'>
                 	<a class="lightbox" title="Slide {{ $slide->id }}" href="{{ url($slide->image) }}" >
				     	<img src="{{ url($slide->image) }}" width='280' height="170" />
					</a>
                 	<div class="actions" style="display: none;">
                 		<form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" accept-charset="utf-8">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
							<a href="{{ route('admin.slides.edit', $slide->id) }}" title="Chỉnh sửa" class="tipS">
								<img src="{{ asset('images/icons/color/edit.png') }}" />
							</a>
							<button title="Xóa" class="tipS button tranB" onclick="return confirm('Hãy cân nhắc trước khi xóa, bởi nó có thể làm thay đổi hệ thống của bạn.');">
								<img src="{{ asset('images/icons/color/delete.png') }}"/>
							</button>
						</form>
                 	</div>
                 	<div class="titles">
						<p style="color: #FFF">{{ $slide->title }} - <span class="button blueB tipS">{!! $slide->publish == 0 ? 'Đang hiển thị' : 'Đang ẩn' !!}</span></p>
                 	</div>
                </li>
                @endforeach
            </ul>
        </div>	    
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

		.gallery ul li {
		    margin: 0 20px 10px 16px;
		}

		ul li:hover .titles {
			display: block;
		}
		.titles {
		    position: absolute;
		    bottom: 4px;
		    left: 4px;
		    padding: 5px;
		    display: none;
		    background: rgba(0, 0, 0, 0.5);
		    border-radius: 0;
		    -webkit-border-radius: 0;
		    -moz-border-radius: 2px;
		}
	</style>
@endsection