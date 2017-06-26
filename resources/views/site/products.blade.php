@extends('site.layouts.master')

@section('head.title')
<title>{!! $setting && $setting->title ? $setting->title : 'Luxury - Thời trang Hàn Quốc' !!}</title>
@stop

@section('meta')
	<meta name="keywords" content="{!! $setting->keyword !!}">
	<meta name="description" content="{!! $setting->description !!}">
@stop

@section('top-header')
	@include('site.partials.top_header')
@stop

@section('body.content')
		<div class="container middle-content">
			<div class="section">
				<div class="row">
		            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-name fadeIn">
		                <h2>
		                	<span class="high-light">
		                		Sản phẩm
		                	</span>
		                </h2>
		            </div>
	            </div>
	            
	            <div class="row item">
	            	@if($products && $products->count() > 0)
            			@foreach($products as $product)
				            	<div class="item-grid col-md-3 col-sm-6 col-xs-6">
									<div class="product-main simpleCart_shelfItem">
										<a href="{{ route('site.products', [ $product->id, $product->slug ]) }}" class="mask">
											<img class="img-responsive zoom-img" src="{{ $product->image }}" alt="">
										</a>
										<div class="product-bottom">
											<h3><a href="{{ route('site.products', [ $product->id, $product->slug ]) }}">{{ $product->name }}</a></h3>
											<p>
												<a href="{{ route('site.categories', [ $product->category_id, $product->categories->slug ]) }}" class="btn btn-default"><span>{{ $product->categories->name }}</span></a>
												<a href="{{ route('site.brands', [ $product->brand_id, $product->brands->slug ]) }}" class="btn btn-default"><span>{{ $product->brands->name }}</span></a>
											</p>
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
										@if($product->sale && $product->sale != 0)
										<div class="srch">
											<span>{{ $product->sale }} %</span>
										</div>
										@endif
										<div class="price-link">
											<span class="unlink">{{ number_format($product->price) }}<sup>vnđ</sup></span>
										</div>
									</div>
					            </div>
			            @endforeach
				    @else
				    	<p>Hiện tại chưa có sản phẩm nào trong danh mục này.</p>
				    @endif
					<div class="center-block">
							{!! $products->appends(Request::query())->render() !!}
					</div>
	            </div>
			</div>
		</div>
@endsection
@section('brands')
	@include('site.partials.brands')
@stop