@extends('admin.layouts.master')
@section('title')
	Setting site
@endsection
@section('title.name')
	Cấu hình website
@endsection
@section('content')
	@if(Session::has('messages'))
		<div class="alert alert-{{ Session::get('type') }}">
			{{ Session::get('messages') }}
		</div>
	@endif
	<form class="form" id="form" action="{{ (count($setting) != 0 && ($setting != null)) ? route('admin.settings.update', $setting->id) : route('admin.settings.create') }}" method="post" enctype="multipart/form-data">
		{{ (count($setting) != 0 && ($setting != null)) ? method_field('PUT') : method_field('POST') }}
		{{ csrf_field() }}
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Cấu hình website</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Hệ thống</a></li>
	                <li><a href="#tab2">Giới thiệu về luxury.com</a></li>
	                <li><a href="#tab3">Liên hệ</a></li>
	                <li><a href="#tab4">Cấu hình SMS</a></li>
				</ul>
				
				<div class="tab_container">
				    <div id='tab1' class="tab_content pd0">
				        <div class="formRow">
							<label class="formLeft" for="param_name">Tên hệ thống:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="name" id="param_name" _autocheck="true" type="text" value="{{ old('name', $setting ? $setting->name : null) }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error">
									@if($errors->has('name'))
										{{ $errors->first('name') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow">
							<label class="formLeft" for="param_name">Title:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="title" id="param_name" _autocheck="true" type="text" value="{{ old('title', $setting ? $setting->title : null) }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
								<div name="name_error" class="clear error">
									@if($errors->has('title'))
										{{ $errors->first('title') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_name">Keywords:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="keyword" id="param_name" _autocheck="true" type="text" value="{{ e(old('keyword', $setting ? $setting->keyword : null)) }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>

								<div name="image_error" class="clear error">
									@if($errors->has('keyword'))
										{{ $errors->first('keyword') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>


						<div class="formRow">
							<label class="formLeft" for="param_sale">Description:</label>
							<div class="formRight">
								<span class="oneTwo">
									<textarea name="description" id="param_sale" rows="4" cols="">{{ e(old('description', $setting ? $setting->description : null)) }}</textarea>
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('description'))
										{{ $errors->first('description') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Logo:<span class="req">*</span></label>
							<div class="formRight">
								<div style="margin: 10px 0;">
									<img src="{{ $setting ? url($setting->logo) : '' }}" width='390' height="109" />
								</div>
								<div class="left">
									<input type="file" id="image" name="logo">
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow hide"></div>
					</div>

					 
					<div id='tab2' class="tab_content pd0">
					    <div class="formRow">
							<textarea name="content" id="content" class="editor">{{ old('content', $setting ? $setting->content : null) }}</textarea>
						</div>
					    <div class="formRow hide"></div>
					</div>
													 
					<div id='tab3' class="tab_content pd0" >
						<div class="formRow">
							<label class="formLeft" for="param_site_title">Email:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="email" id="param_name" _autocheck="true" type="text" value="{{ old('email', $setting ? $setting->email : null) }}" />
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('email'))
										{{ $errors->first('email') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Số ĐT:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="phone" _autocheck="true" type="text" value="{{ old('phone', $setting ? $setting->phone : null) }}" />
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('phone'))
										{{ $errors->first('phone') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Địa chỉ liên hệ:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="address" _autocheck="true" type="text" value="{{ old('address', $setting ? $setting->address : null) }}" />
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('address'))
										{{ $errors->first('address') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Facebook:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="facebook" _autocheck="true" type="text" value="{{ old('facebook', $setting ? $setting->facebook : null) }}" />
								</span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Twitter:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="twitter" _autocheck="true" type="text" value="{{ old('twitter', $setting ? $setting->twitter : null) }}" />
								</span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Flickr:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="flickr" _autocheck="true" type="text" value="{{ old('flickr', $setting ? $setting->flickr : null) }}" />
								</span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Google:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="google" _autocheck="true" type="text" value="{{ old('google', $setting ? $setting->google : null) }}" />
								</span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Dribbble:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="dribbble" _autocheck="true" type="text" value="{{ old('dribbble', $setting ? $setting->dribbble : null) }}" />
								</span>
							</div>
							<div class="clear"></div>
						</div>

					    <div class="formRow hide"></div>
					</div>
					<div id='tab4' class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Số ĐT nhận tin sms:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="phone_at" _autocheck="true" type="text" value="{{ old('phone_at', $setting ? $setting->phone_at : null) }}" />
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('phone_at'))
										{{ $errors->first('phone_at') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">API KEY:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="api" _autocheck="true" type="text" value="{{ old('api', $setting ? $setting->api : null) }}" />
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('api'))
										{{ $errors->first('api') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">SECRET KEY:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="secret" _autocheck="true" type="text" value="{{ old('secret', $setting ? $setting->secret : null) }}" />
								</span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="image_error" class="clear error">
									@if($errors->has('secret'))
										{{ $errors->first('secret') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
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

@section('css')
	<style type="text/css">
		.form input[type=number] {
		    font-size: 11px;
		    padding: 7px 6px;
		    background: white;
		    border: 1px solid #DDD;
		    width: 100%;
		    font-family: Arial, Helvetica, sans-serif;
		    box-shadow: 0 0 0 2px #f4f4f4;
		    -webkit-box-shadow: 0 0 0 2px #f4f4f4;
		    -moz-box-shadow: 0 0 0 2px #f4f4f4;
		    color: #656565;
		}	
		span.one {
		    width: 37%;
		    display: table-cell;
		    vertical-align: middle;
		    line-height: 25px;
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