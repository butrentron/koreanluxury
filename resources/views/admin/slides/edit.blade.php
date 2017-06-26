@extends('admin.layouts.master')
@section('title')
	Slide index
@endsection
@section('title.name')
	Cập nhật slide
@endsection
@section('link')
	<li><a href="{{ route('admin.slides.create') }}">
		<img src="{{ asset('images/icons/control/16/add.png') }}" />
		<span>Cập nhật slide</span>
	</a></li>
	
	<li><a href="{{ route('admin.slides.index') }}">
		<img src="{{ asset('images/icons/control/16/list.png') }}" />
		<span>Danh sách</span>
	</a></li>
@endsection
@section('content')
	<form class="form" id="form" action="{{ route('admin.slides.update', $slide->id) }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Cập nhật slide</h6>
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
										<input name="title" id="name" _autocheck="true" type="text" placeholder="Tiêu đề cho slide" value="{{ old('title', $slide ? $slide->title : null) }}" />
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
										<input name="link" id="slug" _autocheck="true" type="text" placeholder="Đường dẫn link đến danh mục hoặc sản phẩm." value="{{ old('link', $slide ? $slide->link : null) }}" />
									</span>
									<span name="name_autocheck" class="autocheck"></span>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<label class="formLeft" for="desc">Mô tả:</label>
								<div class="formRight">
									<span class="oneTwo">
										<textarea name="desc" id="desc" row="10" placeholder="Tối đa 160 kí tự ..."> {{ old('desc', $slide ? $slide->desc : null) }}</textarea>
									</span>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
								<div class="formRight">
									<div style="margin: 10px 0;">
										<img src="{{ url($slide->image) }}" width='280' height="170" />
									</div>
									<div class="left">
										<input type="file"  id="image" name="image" value="{{ old('image', $slide ? $slide->image : null) }}">
									</div>
									<div name="image_error" class="clear error">
										@if($errors->has('image'))
											{{ $errors->first('image') }}
										@endif
									</div>
								</div>
								<div class="clear"></div>
							</div>

							<div class="formRow">
								<label class="formLeft" for="hidden">Hiển thị:</label>
								<div class="formRight">
									<span class="formLeft">
										<input type="radio" name="publish" id="hidden" {{ $slide->publish == 0 ? 'checked=checked' : '' }}  value="0"> Hiện
									</span>
									<span class="formRight">
										<input type="radio" name="publish" id="hidden" {{ $slide->publish == 1 ? 'checked=checked' : '' }} value="1"> Ẩn
									</span>
									<div class="clear error" style="margin-top: 10px">
						                <span class="req">*</span> Ẩn/Hiện trên slide.
						            </div>
									<div name="name_error" class="clear error"></div>
								</div>
								<div class="clear"></div>
							</div>
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