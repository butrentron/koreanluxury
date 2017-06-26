@extends('site.layouts.master')

@section('head.title')
<title>{!! $setting && $setting->title ? $setting->title : 'Luxury - Thời trang Hàn Quốc' !!}</title>
@stop

@section('meta')
	<meta name="keywords" content="{!! $setting->keyword !!}">
	<meta name="description" content="{!! $setting->description !!}">
@stop
	
@section('body.content')
		<div class="container top-header">
            <div class="container check-cart">
                <!-- <div class="col-md-3 cart-total">
                    <div class="price-details">
                        <h3>Chi tiết giá</h3>
                        <table class="table table-hover">
                        	<tr class="info">
							  	<th>Sản phẩm</th>
							  	<th>Số lượng</th>
							  	<th>Giá</th>
							</tr>
                        @foreach($cart as $item)
                        <tr>
                        	<td>{{ $item->name }}</td>
                        	<td class="text-center">{{ $item->qty }}</td>
                        	<td>{{ number_format($item->subtotal) }}</td>
                        </tr>
                        @endforeach	
                        <tr>
                        	<th>Tổng hóa đơn</th>
                        	<td class="text-center">{{ $cart->count() }} sản phẩm</td>
                        	<td>{{ number_format(Cart::total()) }}</td>
                        </tr>
                        </table>		 
                    </div>
                    <div class="clearfix"></div>
                    @if(Cart::count() != 0 )
                    	<a class="order" href="{{ route('site.info') }}">Tiến hành đặt hàng</a>
                    @endif
                </div> -->
                <div class="col-md-12 cart-items">
                @if(count($cart))
                    <h1>Giỏ hàng của bạn ({{ Cart::count() }}) <a href="{{ route('site.delcart') }}">Hủy giỏ hàng</a></h1>

                    <div class="row col-md-12 cart-item">
                        <div class="table-responsive cart_info">
				            <table class="table table-hover">
				                <thead>
				                    <tr class="cart_menu info">
				                        <th class="image" width="80">Sản phẩm</th>
				                        <th width="170"></th>
				                        <th width="70">Màu sắc</th>
				                        <th class="">Kích thước</th>
				                        <th class="">Dv chuyển phát</th>
				                        <th class="">Giá tiền</th>
				                        <th class="">Số lượng</th>
				                        <th class="price">Tổng tiền</th>
				                        <th class="text-center">Hủy sản phẩm</th>
				                    </tr>
				                </thead>
                    			@foreach($cart as $item)
					                <?php
					                	$product = \App\Product::find($item->id);
										$sizes = explode(',', $product->size);
										$colors = explode(',', $product->color);
									?>
					                <tbody>
					                    <tr>
					                        <td class="cart_product">
					                        	<img src="{{ $item->options->image }}" class="img-responsive" alt="{{$item->name}}" title="{{$item->name}}" width="80" />
					                        </td>
					                        <td class="cart_description">
					                            <h4><a href="{{ route('site.products', [ $item->id, $item->options->slug ]) }}">{{$item->name}}</a></h4>
					                        </td>
					                        <td>
					                            <p>
					                            	<select class="btn btn-default" name="color" style="width: 95px" required="required">
														<option value="">-- Chọn màu sắc --</option>
														@foreach($colors as $color)
															<option value="{{ trim($color) }}" {{ $item->options->color && trim($item->options->color) == trim($color) ? 'selected=selected' : null }}>{{ trim(ucwords($color)) }}</option>
														@endforeach
													</select>
					                            </p>
					                        </td>
					                        <td class="cart_price text-center">
					                            <p>
					                            	<select class="btn btn-default" name="color" style="width: 95px" required="required">
														<option value="">-- Chọn kích cỡ --</option>
														@foreach($sizes as $size)
															<option value="{{ trim($size) }}" {{ $item->options->size && trim($item->options->size) == trim($size) ? 'selected=selected' : null }}>{{ trim(ucwords($size)) }}</option>
														@endforeach
													</select>
					                            </p>
					                        </td>

					                        <td class="cart_price text-center">
					                            <p>
					                            	<select class="btn btn-default" name="color" style="width: 95px" required="required">
														<option value="">-- Chọn dịch vụ chuyển phát --</option>
														@foreach($ships as $ship)
															<option value="{{ trim($ship->name) }}" {{ $item->options->ship && $item->options->ship == trim($ship->name) ? 'selected=selected' : null }}>{{ $ship->name }}</option>
														@endforeach
													</select>
					                            </p>
					                        </td>
					                        <td class="cart_price text-center">
					                            <p>{{ number_format($item->price) }} <sup>vnđ</sup></p>
					                        </td>
					                        <td class="cart_quantity">
					                            <div class="cart_quantity_button">
					                                <a class="cart_quantity_down" href="{{ route('site.cart.get', ['product_id' => $item->id, 'decrease' => 1]) }}"> - </a>
					                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2">
					                                <a class="cart_quantity_up" href="{{ route('site.cart.get', ['product_id' => $item->id, 'increment' => 1]) }}"> + </a>
					                            </div>
					                        </td>
					                        <td class="cart_total">
					                            <p class="cart_total_price">{{ number_format($item->subtotal) }} <sup>vnđ</sup></p>
					                        </td>
					                        <td class="cart_delete text-center">
					                            <a class="cart_quantity_delete" href="{{ route('site.cart.get', ['product_id' => $item->id, 'remove' => 'true']) }}"><i class="glyphicon glyphicon-remove"></i></a>
					                        </td>
					                    </tr>
	                				@endforeach

				                        <tr>
				                        	<th colspan="6">Tổng hóa đơn</th>
				                        	<th class="text-center">{{ Cart::count() }} sản phẩm</th>
				                        	<th colspan="2">{{ number_format(Cart::total()) }} <sup>vnđ</sup></th>
				                        </tr>
					                </tbody>
					            </table>
					        </div>
		                    <div class="clearfix"></div>
		                    @if(Cart::count() != 0 )
		                    	<div class="pull-right">
		                    		<a class="btn btn-primary" href="{{ route('site.info') }}">Tiến hành đặt hàng</a>
		                    	</div>
		                    	<div class="pull-left">
                    				<a class="btn btn-success" href="/">Tiếp tục mua hàng</a>
		                    	</div>
		                    @endif
	                    </div>
		            @else
		            	<p>Hiện tại vẫn chưa có sản phẩm nào trong giỏ hàng của bạn. Hãy mua sắm.</p>	
	                @endif    
                	</div>
                	<div class="clearfix"> </div>
            	</div>
            </div>
		</div>

		<div class="container middle-content">
			<div class="section brand">
				<div class="row">
		            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-name fadeIn">
		                <h2><span class="high-light">Xem nhiều</span></h2>
		            </div>
	            </div>
        		<div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="7000" id="myCarouselGrid">
				    <div class="carouselGrid-inner">
				    @foreach($products as $product)
				        <div class="item">
				            <div class="item-grid col-lg-15 col-md-3 col-sm-4 col-xs-6 col-mb-2">
								<div class="product-main simpleCart_shelfItem">
									<a href="{{ route('site.products', [ $product->id, $product->slug ]) }}" class="mask">
										<img class="img-responsive zoom-img" src="{{ url( $product->image ) }}" alt="{{ $product->name }}" title="{{ $product->name }}">
									</a>
									<div class="product-bottom">
										<h3><a href="{{ route('site.products', [ $product->id, $product->slug ]) }}">{{ $product->name }}</a></h3>
										<p><a href="{{ route('site.categories', [ $product->category_id, $product->categories->slug ]) }}"><span>{{ $product->categories->name }}</span></a></p>
										<h4>
											<form method="POST" action="{{ route('site.cart') }}">
	                                            <input type="hidden" name="product_id" value="{{$product->id}}">
	                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                            <button type="submit" class="btn btn-default cart add-to-cart">
	                                                <i></i>
													<span class="item_price">
														{{ ($product->sale != 0) ? number_format($product->price_at) : number_format($product->price) }}<sup>vnđ</sup>
													</span>
	                                            </button>
	                                        </form>
										</h4>
									</div>
									@if($product->sale != 0)
									<div class="srch">
										<span>Sale {{ $product->sale }}%</span>
									</div>
									<div class="price-link">
										<span class="unlink">{{ number_format($product->price) }}<sup>vnđ</sup></span>
									</div>
									@endif
								</div>
				        	</div>
				        </div>
				    @endforeach
			 		</div>
				    <a class="left carouselGrid-control" href="#myCarouselGrid" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
				    <a class="right carouselGrid-control" href="#myCarouselGrid" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
				</div>
			</div>
@stop