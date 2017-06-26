	@extends('site.layouts.master')

	@section('head.title')
	<title>{!! $product->set_title ? $product->set_title : $product->name !!}</title>
	@stop

	@section('meta')
	<meta name="keywords" content="{!! $product && $product->meta_key ? $product->meta_key : $product->name !!}">
	<meta name="description" content="{!! $product && $product->meta_desc? $product->meta_desc : $product->desc !!}">
	@stop

	@section('top-header')
		<div class="container top-header">
			@include('site.partials.categories')
			<div class="col-xs-12 col-md-9 col-sm-12">  
			    <div class="slider_container">
				    <div class="col-md-5 grid">		
						<div class="flexslider">
							  <ul class="slides">
							    <li data-thumb="{{ url($product->image) }}">
							        <div class="thumb-image"> 
							        	<img src="{{ url($product->image) }}" data-imagezoom="true" class="img-responsive" title="{{ $product->name }}" alt="{{ $product->name }}"> 
							        </div>
							    </li>
							  </ul>
						</div>
					</div>	
					<div class="col-md-7 single-top-in">
						<div class="single-para simpleCart_shelfItem">
							<h1>{{ $product->name }}</h1>
							<p class="desc">{{ $product->desc }}</p>
							<h2>Thương hiệu: <a href="{{ route('site.brands', [ $product->brand_id, $product->brands->slug ]) }}"><span class="btn btn-danger">{{ $product->brands->name }}</span></a></h2>
							
							<div class="available">
								<form action="{{ route('site.cart') }}" method="POST">
									<div style="display:none">
										<input type="hidden" name="_method" value="POST">
										<input type="hidden" name="product_id" value="{{ $product->id }}">
										{{ csrf_field() }}
									</div>
									<p class="h2">Tùy chọn có sẵn :</p>
									<?php 
										$sizes = explode(',', $product->size);
										$colors = explode(',', $product->color);
									?>
									<table class="table-attribute">
										<input type="hidden" name="slug" value="{{ $product->slug }}">
										<tbody>
											<tr>
												<td width="70">Số lượng:</td>
												<td><input type="number" value="{{ old('qty') ? old('qty') : 1 }}" name="qty" class="btn btn-default" min="0" max="100"></td>
											</tr>
											<tr>
												<td>Size:</td>
												<td>
													<select class="btn btn-default" name="size" required="required">
														<option value="">-- Chọn kích cỡ --</option>
														@foreach($sizes as $size)
															<option value="{{ trim($size) }}">{{ trim(ucwords($size)) }}</option>
														@endforeach
													</select>
												</td>
												@if($errors->has('size'))
													<td>
														{{ $errors->first('size') }}
													</td>
												@endif
											</tr>
											<tr>
												<td>Màu sắc:</td>
												<td>
													<select class="btn btn-default" name="color" required="required">
														<option value="">-- Chọn màu sắc --</option>
														@foreach($colors as $color)
															{{ $color }}
															<option value="{{ trim($color) }}">{{ trim(ucwords($color)) }}</option>
															}
														@endforeach
													</select>
												</td>
												@if($errors->has('color'))
													<td>
														{{ $errors->first('color') }}
													</td>
												@endif
											</tr>
										</tbody>
									</table>
									<p class="h2">Dịch vụ chuyển phát:</p>
										@foreach($ships as $ship)
											<div class="col-md-4">
												<input type="radio" name="ship" value="{{ trim($ship->name) }}" required="required">
												<img src="{{ url($ship->logo) }}" alt="{{ $ship->name }}" title="{{ $ship->name }}" width="80" height="45">
												<input type="hidden" name="logo_ship" value="{{ url($ship->logo) }}">
											</div>
										@endforeach
									<div class="clearfix"></div>
									@if($errors->has('ship'))
										<p>
											{{ $errors->first('ship') }}
										</p>
									@endif
									<p class="h2">
										@if($product->sale != 0)
										Giá: <span class="unlink">{{ number_format($product->price) }}<sup>vnđ</sup></span> 
										<span class="gif">{{ number_format($product->price_at) }}<sup>vnđ</sup></span>
										@else
											Giá: <span class="gif">{{ number_format($product->price) }}<sup>vnđ</sup></span>
										@endif
									</p>
									<button type="submit" class="btn btn-success pull-center">Thêm vào giỏ hàng</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@stop

	@section('body.content')

        <div class="container specifications">
        	<div class="col-md-12 col-sm-12 col-xs-12">
        		<h3>Chi tiết sản phẩm</h3> 
	            <div class="detai-tabs">
	                <ul class="nav nav-pills tab-nike" role="tablist">
		                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin sản phẩm</a></li>
		                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Bình luận</a></li>
	                </ul>
	                <div class="tab-content">
		                <div role="tabpanel" class="tab-pane active" id="home">
			                {!! $product->content !!}
		                </div>
		                <div role="tabpanel" class="tab-pane" id="messages">
		                    comment    
		                </div>
	                </div>
	            </div>
        	</div>
        </div>
		<div class="container middle-content">
			<div class="section brand">
				<div class="row">
		            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-name fadeIn">
		                <h2><span class="high-light">Cùng thương hiệu</span></h2>
		            </div>
	            </div>
        		<div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="7000" id="myCarouselGrid">
				    <div class="carouselGrid-inner">
				    @if($producstAsBrand)
				    	@foreach($producstAsBrand as $productBrand)
				        <div class="item">
				            <div class="item-grid col-lg-15 col-md-3 col-sm-4 col-xs-6 col-mb-2">
								<div class="product-main simpleCart_shelfItem">
									<a href="{{ route('site.products', [ $productBrand->id, $productBrand->slug ]) }}" class="mask">
										<img class="img-responsive zoom-img" src="{{ $productBrand->image }}" alt="{{ $productBrand->name }}" title="{{ $productBrand->name }}">
									</a>
									<div class="product-bottom">
										<h3><a href="{{ route('site.products', [ $productBrand->id, $productBrand->slug ]) }}">{{ $productBrand->name }}</a></h3>
										<p><a href="{{ route('site.categories', [ $product->category_id, $product->categories->slug ]) }}"><span>{{ $productBrand->categories->name }}</span></a></p>
										<h4>
											<form method="POST" action="{{ route('site.cart') }}">
	                                            <input type="hidden" name="product_id" value="{{ $productBrand->id }}">
	                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                            <input type="hidden" name="slug" value="{{ $productBrand->slug }}">
	                                            <button type="submit" class="btn btn-default cart add-to-cart">
	                                                <i></i>
													<span class="item_price">
														{{ ($productBrand->sale != 0) ? number_format($productBrand->price_at) : number_format($productBrand->price) }}<sup>vnđ</sup>
													</span>
	                                            </button>
	                                        </form>
										</h4>
									</div>
									@if($product->sale != 0)
									<div class="srch">
										<span>Sale {{ $productBrand->sale }}%</span>
									</div>
									<div class="price-link">
										<span class="unlink">{{ number_format($productBrand->price) }}<sup>vnđ</sup></span>
									</div>
									@endif
								</div>
				        	</div>
				        </div>
				        @endforeach
				    @endif
			 		</div>
				    <a class="left carouselGrid-control" href="#myCarouselGrid" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
				    <a class="right carouselGrid-control" href="#myCarouselGrid" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
				</div>
			</div>
		</div>
	@stop

	@section('js')
		<script type="text/javascript" src="{{ url(elixir('js/zoom-image.js')) }}"></script>
		<script type="text/javascript">
			$(function(){
			   $(".carouselGrid-inner > .item:first-child").addClass("active");
			})
		</script>
	@stop