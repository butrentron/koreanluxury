@extends('admin.layouts.master')
@section('title')
	Slide index
@endsection
@section('title.name')
	Thêm slide
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
	<form class="form" id="form" action="{{ route('admin.slides.store') }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Thêm mới slide</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Thông tin chung</a></li>
				</ul>
				
				<div class="tab_container">
				    <div id='tab1' class="tab_content pd0">
				     	<div class="item-slide">
					         <div class="formRow">
								<label class="formLeft" for="name">Tiêu đề:<span class="req">*</span></label>
								<div class="formRight">
									<span class="oneTwo">
										<input name="title" id="name" _autocheck="true" type="text" placeholder="Tiêu đề cho slide" value="{{ old('title') }}" />
									</span>
									<span name="name_autocheck" class="autocheck"></span>
									@if($errors->has('title'))
									<div name="name_error" class="clear error">
										{{ $errors->first('title') }}
									</div>
									@endif
								</div>
								<div class="clear"></div>
							</div>

					        <div class="formRow">
								<label class="formLeft" for="slug">Link:</label>
								<div class="formRight">
									<span class="oneTwo">
										<input name="link" id="slug" _autocheck="true" type="text" placeholder="Đường dẫn link đến danh mục hoặc sản phẩm." />
									</span>
									<span name="name_autocheck" class="autocheck"></span>
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

							<div class="formRow">
								<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
								<div class="formRight">
									<div class="left"><input type="file"  id="image" name="image"></div>
									<div name="image_error" class="clear error">
										@if($errors->has('image'))
											{{ $errors->first('image') }}
										@endif
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</div>	

				        <div class="formRow">
							<label class="formLeft" for="hidden">Hiển thị:</label>
							<div class="formRight">
								<span class="formLeft">
									<input type="radio" name="publish" id="hidden" checked="checked" value="0"> Hiện
								</span>
								<span class="formRight">
									<input type="radio" name="publish" id="hidden" value="1"> Ẩn
								</span>
								<div class="clear error" style="margin-top: 10px">
					                <span class="req">*</span> Ẩn/Hiện trên slide.
					            </div>
								<div name="name_error" class="clear error"></div>
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