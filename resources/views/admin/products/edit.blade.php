@extends('admin.layouts.master')
@section('title')
	Sản phẩm
@endsection
@section('title.name')
	Cập nhật sản phẩm
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
	<form class="form" id="form" action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<fieldset>
			<div class="widget">
			    <div class="title">
					<img src="{{ asset('images/icons/dark/add.png') }}" class="titleIcon" />
					<h6>Cập nhật Sản phẩm</h6>
				</div>
				
			    <ul class="tabs">
	                <li><a href="#tab1">Thông tin chung</a></li>
	                <li><a href="#tab2">Nội dung sản phẩm</a></li>
	                <li><a href="#tab3">SEO Onpage</a></li>
				</ul>
				
				<div class="tab_container">
				    <div id='tab1' class="tab_content pd0">
				         <div class="formRow">
							<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="name" id="param_name" _autocheck="true" type="text" value="{{ old('name', $product ? $product->name : null) }}" />
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
							<label class="formLeft" for="param_name">Slug:</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="slug" id="param_name" _autocheck="true" type="text" value="{{ old('slug', $product ? $product->slug : null) }}" />
								</span>
								<span name="name_autocheck" class="autocheck"></span>
							</div>
							<div class="clear"></div>
						</div>
				        
				        <div class="formRow">
							<label class="formLeft" for="type_id">Mục hiển thị:</label>
							<div class="formRight">
								@foreach( $types as $type)
								<span class="one">
									<input type="checkbox" name="type_id[]" id="type_id" _autocheck="true" value="{{ $type->id }}" {{ in_array($type->id, $product->types()->lists('id')->toArray()) ? 'checked' :  null }} /> {{ $type->name }}
								</span>
								@endforeach
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow" style="padding: 30px 14px 8px">
							<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
							<div class="formRight">
								<div class="left"><input type="file"  id="image" name="image"></div>
								<div class="left" style="margin-left: 15px; margin-top: -25px">
									<img src="{{ url($product->image) }}" alt="{{ $product->image }}" width="70" height="85">
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
							<label class="formLeft" for="param_price">
								Giá :
								<span class="req">*</span>
							</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="price"  style='width:100px' id="param_price" class="format_number" _autocheck="true" type="number" value="{{ old('price', $product ? $product->price : null) }}" />
									<img class='tipS' title='Hãy nhập giá gốc của sản phẩm.' style='margin-bottom:-8px'  src='{{ asset('crown/images/icons/notifications/information.png') }}'/>
								</span>
								<span name="price_autocheck" class="autocheck"></span>
								<div name="price_error" class="clear error">
									@if($errors->has('price'))
										{{ $errors->first('price') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<!-- Price -->
						<div class="formRow">
							<label class="formLeft" for="param_discount">
								Sale (%) 
								<span></span>:
							</label>
							<div class="formRight">
								<span>
									<input name="sale"  style='width:100px' id="param_discount" class="format_number"  type="number" value="{{ old('sale', $product ? $product->sale : null) }}" />
									<img class='tipS' title='Hãy nhập số % giảm giá. Số tiền giao dịch sẽ được tự động tính dựa vào sô giá gốc tiền và sale %.' style='margin-bottom:-8px'  src='{{ asset('crown/images/icons/notifications/information.png') }}'/>
								</span>
								<span name="discount_autocheck" class="autocheck"></span>
								<div name="discount_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_price">
								Màu sắc :
							</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="color"  style='width:90%' id="param_price" _autocheck="true" type="text" placeholder="Thêm ',' cho việc nhập nhiều màu sắc. Ex: Trắng, đen, ..." value="{{ old('color', $product ? $product->color : null) }}" />
									<img class='tipS' title='Màu sắc cho sản phẩm.' style='margin-bottom:-8px'  src='{{ asset('crown/images/icons/notifications/information.png') }}'/>
								</span>
								<span name="price_autocheck" class="autocheck"></span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_price">
								Kích cỡ :
							</label>
							<div class="formRight">
								<span class="oneTwo">
									<input name="size"  style='width:90%' id="param_price" _autocheck="true" type="text" placeholder="Thêm ',' cho việc nhập nhiều kích cỡ. Ex: Lớn, nhỏ, ..." value="{{ old('size', $product ? $product->size : null) }}" />
									<img class='tipS' title='Kích cỡ sản phẩm.' style='margin-bottom:-8px'  src='{{ asset('crown/images/icons/notifications/information.png') }}'/>
								</span>
								<span name="price_autocheck" class="autocheck"></span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_cat">Thể loại:<span class="req">*</span></label>
							<div class="formRight">
								<select name="category_id" _autocheck="true" id='param_cat' class="left">
									<option value="0">Lựa chọn danh mục</option>
									@foreach( $categories as $category )
									    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected='selected'" : null }}>{!! $category->paddedName() !!}</option>
									@endforeach
								</select>
								<span name="cat_autocheck" class="autocheck"></span>
								<div class="clear error">
									@if($errors->has('category_id'))
										{{ $errors->first('categories_id') }}
									@endif
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_cat">Nhà cung cấp:<span class="req">*</span></label>
							<div class="formRight">
								<select name="brand_id" _autocheck="true" id='param_cat' class="left">
									<option value="0">Lựa chọn nhà cung cấp</option>
									@foreach( $brands as $brand )
									    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? "selected='selected'" : null }} >-- {!! $brand->name !!}</option>
									@endforeach
								</select>
								<span name="cat_autocheck" class="autocheck"></span>
								<div name="cat_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_sale">Mô tả:</label>
							<div class="formRight">
								<span class="oneTwo"><textarea name="desc" id="param_sale" rows="4" cols="">{{ old('desc', $product ? $product->desc : null) }}</textarea></span>
								<span name="sale_autocheck" class="autocheck"></span>
								<div name="sale_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

					 	<div class="formRow">
							<label class="formLeft" for="hidden">Slide:</label>
							<div class="formRight">
								<span class="formLeft">
									<input type="radio" name="slide" id="hidden" {{ $product->slide == 0 ? 'checked="checked"' : 'checked="checked"' }} value="0"> Không chọn
								</span>
								<span class="formRight">
									<input type="radio" name="slide" id="hidden" {{ $product->slide == 1 ? 'checked="checked"' : null }} value="1"> Chọn làm slide
								</span>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow hide"></div>
					</div>

					 
					<div id='tab2' class="tab_content pd0">
					    <div class="formRow">
							<textarea name="content" id="content" class="editor">{{ old('content', $product ? $product->content :null) }}</textarea>
							<div name="content_error" class="clear error">
								@if($errors->has('content'))
									{{ $errors->first('content') }}
								@endif
							</div>
						</div>
					    <div class="formRow hide"></div>
					</div>
													 
					<div id='tab3' class="tab_content pd0" >
						<div class="formRow">
							<label class="formLeft" for="param_site_title">Title:</label>
							<div class="formRight">
								<span class="oneTwo"><textarea name="set_title" id="param_site_title" _autocheck="true" rows="4" cols="">{{ old('set_title', $product ? $product->set_title :null) }}</textarea></span>
								<span name="site_title_autocheck" class="autocheck"></span>
								<div name="site_title_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_desc">Meta description:</label>
							<div class="formRight">
								<span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols="">{{ old('meta_desc', $product ? $product->meta_desc :null) }}</textarea></span>
								<span name="meta_desc_autocheck" class="autocheck"></span>
								<div name="meta_desc_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_meta_key">Meta keywords:</label>
							<div class="formRight">
								<span class="oneTwo"><textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols="">{{ old('meta_key', $product ? $product->meta_key :null) }}</textarea></span>
								<span name="meta_key_autocheck" class="autocheck"></span>
								<div name="meta_key_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
					    <div class="formRow hide"></div>
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
	<script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>
	<script>
		tinymce.init({
		    selector: '#content',
		    theme: 'modern',
		    height: 300,
		    plugins: [
		      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		      'save table contextmenu directionality emoticons template paste textcolor'
		    ],
		    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
		});
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
	</style>
@endsection