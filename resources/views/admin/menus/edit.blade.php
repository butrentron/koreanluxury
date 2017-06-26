@extends('admin.layouts.master')
@section('title')
	Quản lí các trang
@endsection
@section('title.name')
	Sửa trang
@endsection
@section('link')
	<li>
		<a href="{{ route('admin.pages.create') }}">
			<img src="{{ asset('images/icons/control/16/add.png') }}" />
			<span>Thêm mới</span>
		</a>
	</li>
	
	<li>
		<a href="{{ route('admin.pages.index') }}">
			<img src="{{ asset('images/icons/control/16/list.png') }}" />
			<span>Danh sách</span>
		</a>
	</li>
@endsection
@section('content')
	<form class="form" id="form" action="{{ route('admin.pages.update', $page->id) }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Sửa trang</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Thông tin chung</a></li>
	                <li><a href="#tab2">SEO Onpage</a></li>
				</ul>
				
				<div class="tab_container">
				     <div id='tab1' class="tab_content pd0">
				         <div class="formRow">
							<label class="formLeft" for="name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="name" id="name" _autocheck="true" type="text" placeholder="Tiêu đề cho trang" value="{{ old('name', $page ? $page->name : null ) }}" />
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
							<label class="formLeft" for="uri">URI:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="uri" id="uri" _autocheck="true" type="text" placeholder="Đường dẫn URL của trang. Ex: /contact or /lien-he" value="{{ old('uri', $page ? $page->uri : null) }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
								@if($errors->has('uri'))
								<div name="name_error" class="clear error">
									{{ $errors->first('uri') }}
								</div>
								@endif
							</div>
							<div class="clear"></div>
						</div>

				        <div class="formRow">
							<label class="formLeft" for="param_name">Trang con:</label>
							<div class="formRight">
								<select name="order">
									<option value="">Làm trang cha</option>
									<option value="childOf">Làm trang con</option>
								</select>
								<select name="orderPage">
									<option value="">Trang cha</option>
									@foreach($orderPages as $orderPage)
									<option value="{{ $orderPage->id }}" >{{ $orderPage->name }}</option>
									@endforeach
								</select>
								<div name="name_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="content">Nội dung:<span class="req">*</span></label>
							<div class="formRight">
								<textarea name="content" id="content"> {{ old('content', $page ? $page->content : null) }}</textarea>
							</div>
							@if($errors->has('content'))
							<div name="name_error" class="clear error">
								{{ $errors->first('content') }}
							</div>
							@endif
							<div class="clear"></div>
						</div>		
					 
				         <div class="formRow">
							<label class="formLeft" for="hidden">Hiển thị:</label>
							<div class="formRight">
								<span class="formLeft">
									<input type="radio" name="hidden" id="hidden" checked="checked" value="0"> Hiện
								</span>
								<span class="formRight">
									<input type="radio" name="hidden" id="hidden" value="1"> Ẩn
								</span>
								<div class="clear error" style="margin-top: 10px">
					                <span class="req">*</span> Ẩn/Hiện trên thanh menu. Kiểm tra này sẽ ẩn các trang từ các hướng. Chỉ có thể được áp dụng cho các trang không có trang con.
					            </div>
								<div name="name_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					 <div id='tab2' class="tab_content pd0" >
						<div class="formRow">
						<label class="formLeft" for="param_site_title">Title:</label>
						<div class="formRight">
							<span class="oneTwo"><textarea name="set_title" id="param_site_title" _autocheck="true" rows="4" cols="">{{ old('set_title', $page ? $page->set_title : null) }}</textarea></span>
							<span name="site_title_autocheck" class="autocheck"></span>
							<div name="site_title_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
						</div>

						<div class="formRow">
						<label class="formLeft" for="param_meta_desc">Meta description:</label>
						<div class="formRight">
							<span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols="">{{ old('meta_desc', $page ? $page->meta_desc : null) }}</textarea></span>
							<span name="meta_desc_autocheck" class="autocheck"></span>
							<div name="meta_desc_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
						</div>

						<div class="formRow">
						<label class="formLeft" for="param_meta_key">Meta keywords:</label>
						<div class="formRight">
							<span class="oneTwo">
								<textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols="">{{ old('meta_key', $page ? $page->meta_key : null) }}</textarea>
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
@endsection