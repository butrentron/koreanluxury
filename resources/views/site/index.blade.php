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
		@if($types)
			@foreach($types as $type)
				<div class="section">
					<div class="row">
			            <div class="col-md-12 title-name fadeIn">
			                <h2><span class="high-light"><a href="{{ route('site.types', [ $type->id, $type->slug ]) }}">{{ $type->name }}</a></span></h2>
			            </div>
		            </div>
		            <div class="row item">
		            <p style="display: none;">
		            	{{{ 
		            		$products = $type->products()
                                    		->orderBy('id', 'desc')
                                    		->skip(0)->take(12)->get()
		            	}}}
		            </p>
		            @foreach($products as $product)
						<div class="item-grid col-lg-3 col-md-4 col-sm-6 col-xs-6">
							<div class="product-main Cart_shelfItem">
								<a href="{{ route('site.products', [ $product->id, $product->slug ]) }}" class="mask" title="{{ $product->name }}">
									<img class="img-responsive zoom-img" src="{{ url($product->image) }}" alt="{{ $product->name }}" title="{{ $product->name }}">
								</a>
								<div class="product-bottom">
									<h3><a href="{{ route('site.products', [ $product->id, $product->slug ]) }}" title="{{ $product->name }}">{{ str_limit($product->name, 34) }}</a></h3>
									<p>
										<a href="{{ route('site.categories', [ $product->category_id, $product->categories->slug ]) }}" class="btn btn-default"><span>{{ $product->categories->name }}</span></a>
										<a href="{{ route('site.brands', [ $product->brand_id, $product->brands->slug ]) }}" class="btn btn-default"><span>{{ $product->brands->name }}</span></a>
									</p>
									<h4>
										<a href="{{ route('site.products', [ $product->id, $product->slug ]) }}" class="btn btn-default cart add-to-cart" id="add_cart">
                                            <i></i>
											<span class="item_price">
												{{ ($product->sale != 0) ? number_format($product->price_at) : number_format($product->price) }}<sup>vnđ</sup>
											</span>
                                        </a>
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
		            @endforeach
		            </div>
				</div>
			@endforeach
		@endif
	@stop

	@section('brands')
		@include('site.partials.brands')
	@stop