<!DOCTYPE html>
<html>
<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="vi" />
	@yield('head.title')<meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('meta')<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="page-enter" content="revealtrans(duration=seconds,transition=num)" />
	<meta http-equiv="refresh" content="1000">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url(elixir('css/app.css')) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.smartmenus.bootstrap.css') }}">
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
	<link rel="alternate" type="application/rss+xml" title="Shop thời trang Hàn Quốc Luxury.com" href="{{ url('feed') }}" />
</head>
<body>
	<div id="wrapper">
		<div class="container header" id="header">
			<div class="row">
				<div class="col-xs-5 col-md-4 col-sm-5 align-mob" ">
					<a href="/" class="logo">
						@if($setting->logo && $setting->logo != '')
							<img src="{{ url($setting->logo) }}" alt="{{ $setting->name }}" title="{{ $setting->name }}">
						@else
							<h1>{{ $setting->name }}</h1>
						@endif
					</a>
				</div>
				<div class="col-xs-12 col-md-5 col-sm-7">
					<form action="{{ route('site.search') }}" method="get" role="form" class="search">
						<input type="search" class="form-control" placeholder="Nhập từ khóa cần tìm kiếm..." id="search" name="keywords">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
					</form>
				</div>
				<div class="col-md-3 col-xs-10">
					<div class="row">
					</div>
				</div>
			</div>
		</div>
		
		@if(Session::has('message'))
			<div class = "alert alert-{{ Session::get('type') }} text-center" style="border-radius:0">{{ Session::get('message') }}</div>
		@endif

		@include('site.partials.nav')

		@yield('top-header')

		<div class="container banner">
	        
		</div>

		<div class="container middle-content">
		
			@yield('body.content')

			@if($setting && $setting->content)
			<div class="section infomation">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-name fadeIn">
		                <h2><span class="high-light">Luxury.com</span></h2>
		            </div>
				</div>
				<div class="row">
					<div class="text">
						{!! $setting->content !!}
					</div>
				</div>
			</div>
			@endif

			@yield('brands')
		</div>
		<div class="footer" id="footer">
			<div class="footer-top">
				<div class="container">
					<div class="foo-grids">
						<div class="col-md-4 col-sm-8 col-xs-12 footer-grid">
							<h4 class="footer-head">Danh mục sản phẩm</h4>
							<div class="list-cate">
								@foreach(\App\Category::select('id', 'name', 'slug')->get() as $category)
									<span class="tags btn"><a href="{{ route('site.categories', [$category->id, $category->slug]) }}">{{$category->name}}</a></span>
								@endforeach
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 footer-grid p-100">
							<h4 class="footer-head">Hỗ trợ khách hàng</h4>
							<ul>
								@foreach(\App\Page::select('id', 'uri', 'name')->where('hidden', 0)->get() as $page)
								<li><a href="{{ route('site.pages', [$page->uri]) }}">{{ $page->name }}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12 footer-grid p-100">
							<h4 class="footer-head">Thông tin Liên hệ</h4>
							<ul>
								<li><a href="#0">Email: {!! $setting->email !!}</a></li>						
								<li><a href="#0">Số ĐT: {!! $setting->phone !!}</a></li>
								<li><a href="#0">Địa chỉ: {!! $setting->address !!}</a></li>
							</ul>
						</div>
						
						<div class="clearfix"></div>
					</div>						
				</div>	
			</div>	
			<div class="footer-bottom text-center">
				<div class="container">
					<div class="footer-social-icons">
						<ul>
							<li><a class="facebook" href="{{ $setting->facebook }}"><span>Facebook</span></a></li>
							<li><a class="twitter" href="{{ $setting->twitter }}"><span>Twitter</span></a></li>
							<li><a class="flickr" href="{{ $setting->flickr }}"><span>Flickr</span></a></li>
							<li><a class="googleplus" href="{{ $setting->google }}"><span>Google+</span></a></li>
							<li><a class="dribbble" href="{{ $setting->dribbble }}"><span>Dribbble</span></a></li>
						</ul>
					</div>
					<div class="copyrights">
						<p> © 2016 luxury.com | Design by  <a href=""> danangtech.com</a></p>
					</div>
					<div class="sitemap">
						<ul>
							<li><a href="{{ url('/feed') }}">RSS</a></li>
							<li>|</li>
							<li><a href="{{ url('/sitemap') }}" target="_blank">Sitemap</a></li>
						</ul>
						<style type="text/css">
							.sitemap ul li {
								display: inline-block;
							}
							.sitemap ul li, .sitemap ul li a {
								color: #FFF;
							}
						</style>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="back-top">
			<a href="#0" class="cd-top">Top</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ url(elixir('js/main.js')) }}"></script>
	<script type="text/javascript" src="{{ url(elixir('js/modernizr.js')) }}"></script>
	<script type="text/javascript" src="{{ url(elixir('js/slide.js')) }}"></script>
	<script src="{{ asset('js/jquery.smartmenus.js') }}"></script>
	<script src="{{ asset('js/jquery.smartmenus.bootstrap.js') }}"></script>
	@yield('js')
	<script src="http://uhchat.net/code.php?f=4c5cb1"></script>
</body>
</html>