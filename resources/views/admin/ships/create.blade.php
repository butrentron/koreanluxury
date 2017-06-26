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
	<form class="form" id="form" action="{{ route('admin.ship.store') }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Thêm mới nhà cung cấp</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Thông tin chung</a></li>
	                <li><a href="#tab2">Liên kết</a></li>
				</ul>
				
				<div class="tab_container">
				    <div id='tab1' class="tab_content pd0">
				         <div class="formRow">
							<label class="formLeft" for="name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="name" id="name" _autocheck="true" type="text" placeholder="Tiêu đề cho nhà cung cấp" value="{{ old('name') }}" />
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

						<div class="formRow">
							<label class="formLeft">Logo:<span class="req">*</span></label>
							<div class="formRight">
								<div class="left"><input type="file" id="image" name="logo"></div>
								<div name="image_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="desc">Mô tả:</label>
							<div class="formRight">
								<span class="oneTwo">
									<textarea name="desc" id="desc" row="10" placeholder="Tối đa 160 kí tự ..."> {{ old('desc') }}</textarea>
								</span>
							</div>
							<div class="clear"></div>
						</div>		
					</div>
				    <div id='tab2' class="tab_content pd0">
				         <div class="formRow">
							<label class="formLeft" for="name">Tên website:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="website" id="name" _autocheck="true" type="text" placeholder="Website của dịch vụ" value="{{ old('website') }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
							</div>
							<div class="clear"></div>
						</div>

				         <div class="formRow">
							<label class="formLeft" for="name">Link:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="url" id="name" _autocheck="true" type="url" placeholder="Địa chỉ url để đến website dịch vụ" value="{{ old('url') }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
							</div>
							<div class="clear"></div>
						</div>
					</div>
        		</div><!-- End tab_container-->
        		
        		<div class="formSubmit">
           			<input type="submit" value="Thêm mới" class="redB" />
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