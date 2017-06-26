@extends('admin.layouts.master')
@section('title')
	Quản lí mục sản phẩm
@endsection
@section('title.name')
	Sửa mục sản phẩm
@endsection
@section('link')
	<li>
		<a href="{{ route('admin.types.create') }}">
			<img src="{{ asset('images/icons/control/16/add.png') }}" />
			<span>Thêm mới</span>
		</a>
	</li>
	
	<li>
		<a href="{{ route('admin.types.index') }}">
			<img src="{{ asset('images/icons/control/16/list.png') }}" />
			<span>Danh sách</span>
		</a>
	</li>
@endsection
@section('content')
	<form class="form" id="form" action="{{ route('admin.types.update', $type->id) }}" method="post" enctype="multipart/form-data">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Sửa danh mục sản phẩm</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Thông tin chung</a></li>
	                <li><a href="#tab2">SEO Ontype</a></li>
				</ul>
				
				<div class="tab_container">
				     <div id='tab1' class="tab_content pd0">
				         <div class="formRow">
							<label class="formLeft" for="name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="name" id="name" _autocheck="true" type="text" placeholder="Tiêu đề cho danh mục sản phẩm" value="{{ old('name', $type ? $type->name : null ) }}" />
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
							<label class="formLeft" for="slug">Slug:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="slug" id="slug" _autocheck="true" type="text" placeholder="Đường dẫn URL của danh mục sản phẩm. Ex: /contact or /lien-he" value="{{ old('slug', $type ? $type->slug : null) }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
								@if($errors->has('slug'))
								<div name="name_error" class="clear error">
									{{ $errors->first('slug') }}
								</div>
								@endif
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="desc">Mô tả:</label>
							<div class="formRight">
								<span class="oneTwo">
									<textarea name="description" id="desc"> {{ old('description', $type ? $type->description : null) }}</textarea>
								</span>
							</div>
							<div class="clear"></div>
						</div>		
					 	
					 	<div class="formRow">
							<label class="formLeft" for="hidden">Hiển thị:</label>
							<div class="formRight">
								<span class="formLeft">
									<input type="radio" name="display" id="hidden" {{ $type->display == 0 ? 'checked' : null }} value="0"> Ẩn
								</span>
								<span class="formRight">
									<input type="radio" name="display" id="hidden" {{ $type->display == 1 ? 'checked' : null }} value="1"> Hiện
								</span>
								<div class="clear error" style="margin-top: 10px">
					                <span class="req">*</span> Ẩn/Hiện trên trang chủ.
					            </div>
								<div name="name_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="sort">
								Thứ tự hiển thị :
							</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="sort"  style='width:100px' id="sort" _autocheck="true" type="number" value="{{ old('sort', $type ? $type->sort : null) }}" />
								</span>
								<span name="price_autocheck" class="autocheck"></span>
							</div>
							<div class="clear"></div>
						</div>
					</div>

					 <div id='tab2' class="tab_content pd0" >
						<div class="formRow">
						<label class="formLeft" for="param_site_title">Title:</label>
						<div class="formRight">
							<span class="oneTwo"><textarea name="set_title" id="param_site_title" _autocheck="true" rows="4" cols="">{{ old('set_title', $type ? $type->set_title : null) }}</textarea></span>
							<span name="site_title_autocheck" class="autocheck"></span>
							<div name="site_title_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
						</div>

						<div class="formRow">
						<label class="formLeft" for="param_meta_desc">Meta description:</label>
						<div class="formRight">
							<span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols="">{{ old('meta_desc', $type ? $type->meta_desc : null) }}</textarea></span>
							<span name="meta_desc_autocheck" class="autocheck"></span>
							<div name="meta_desc_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
						</div>

						<div class="formRow">
						<label class="formLeft" for="param_meta_key">Meta keywords:</label>
						<div class="formRight">
							<span class="oneTwo">
								<textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols="">{{ old('meta_key', $type ? $type->meta_key : null) }}</textarea>
							</span>
							<span name="meta_key_autocheck" class="autocheck"></span>
							<div name="meta_key_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
						</div>
					     <div class="formRow hide"></div>
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
	<script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>
	<script>
		tinymce.init({
		    selector: '#content',
		    theme: 'modern',
		    height: 300,
		    plugins: [
		      'advlist autolink link image lists charmap print preview hr anchor typebreak spellchecker',
		      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		      'save table contextmenu directionality emoticons template paste textcolor'
		    ],
		    content_css: 'css/content.css',
		    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fulltype | forecolor backcolor emoticons'
		});
	</script>
@endsection