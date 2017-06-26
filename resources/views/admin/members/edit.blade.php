@extends('admin.layouts.master')
@section('title')
	Cập nhật thông tin
@endsection
@section('title.name')
	Cập nhật thông tin
@endsection
@section('link')
	<li><a href="{{ route('admin.register') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Cập nhật slide</span>
	</a></li>
	
	<li><a href="{{ route('admin.list') }}">
		<img src="{{ asset('images/icons/control/16/list.png') }}" />
		<span>Danh sách</span>
	</a></li>
@endsection
@section('content')
	<form class="form" id="form" action="{{ route('admin.update', $member->id) }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Cập nhật thông tin tài khoản</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Thông tin</a></li>
				</ul>
				
				<div class="tab_container">
				    <div id='tab1' class="tab_content pd0">
				     	<div class="item-slide">
					         <div class="formRow">
								<label class="formLeft" for="name">Tên:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo">
										<input name="name" id="name" _autocheck="true" type="text" placeholder="Họ và tên" value="{{ old('name', $member ? $member->name : null) }}" />
									</span>
									<span name="name_autocheck" class="autocheck"></span>
									@if($errors->has('name'))
									<div name="name_error" class="clear error">
										{{ $errors->first('name') }}
									</div>
									@endif
								</div>
								<div class="clear"></div>
							</div>

							@if(\Auth::guard('admin')->user()->id == 1 )
							<div class="formRow">
								<label class="formLeft" for="hidden">Active:</label>
								<div class="formRight">
									<span class="formLeft">
										<input type="radio" name="active" id="hidden" {{ $member->active == 0 ? 'checked=checked' : '' }}  value="0"> Ngừng hoạt động
									</span>
									<span class="formRight">
										<input type="radio" name="active" id="hidden" {{ $member->active == 1 ? 'checked=checked' : '' }} value="1"> Hoạt động
									</span>
									<div name="name_error" class="clear error"></div>
								</div>
								<div class="clear"></div>
							</div>
							@endif
						</div>
					</div>
        		</div><!-- End tab_container-->
        		<div class="formSubmit">
           			<input type="submit" value="Cập nhật" class="redB" />
           			<input type="reset" value="Hủy bỏ" class="basic" />
           		</div>
        		<div class="clear"></div>
			</div>
		</fieldset>
	</form>
@endsection

@section('js')
	<script type="text/javascript">
		(function($)
		{
			$(document).ready(function()
			{
				var main = $('#form');
				
				// Tabs
				main.contentTabs();
			});
		})(jQuery);
	</script>
@endsection