<!DOCTYPE>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="csrf_token" content="{{ csrf_token() }}">
	<title>Shopping</title>

	<meta name="robots" content="noindex, nofollow" />

	<link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('crown/css/main.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/css.css') }}" media="screen" />
	@yield('css')
	<style type="text/css" media="screen">
		ul.pagination li.active {
		    padding: 2px 15px;
		    text-decoration: underline;
		}
		ul.pagination li {
		    display: inline-block;
		    vertical-align: middle;
		}
	</style>
</head>

<body>
	
	<!-- Left side content -->
	<div id="left_content">
		<div id="leftSide" style="padding-top:30px;">
		
		    <!-- Account panel -->
			
		<div class="sideProfile">
			<a href="#" title="" class="profileFace"><img width="40" src="{{asset('images/user.png')}}" /></a>
			<span>Xin chào: <strong>{{ Auth::guard('admin')->user()->name }}</strong></span>
			<span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime(Auth::guard('admin')->user()->updated_at))->diffForHumans() }}</span>
			<div class="clear"></div>
		</div>
		<div class="sidebarSep"></div>		    
				    <!-- Left navigation -->
					
		<ul id="menu" class="nav">
			<li class="home">
				<a href="{{ route('admin.index') }}" {{ Request::segment(2) == '' ? 'class=active'. ' ' .'id=current' : null }} >
					<span>Bảng điều khiển</span>
					<strong></strong>
				</a>
			</li>
			<li class="tran" {{ in_array(Request::segment(2), ['orders'] ) ? 'class=active'. ' ' .'id=current' : 'class=exp' }}>
				<a href="#0" class=" exp">
					<span>Quản lý bán hàng</span>
					<strong>1</strong>
				</a>
					
				<ul class="sub">
					<li {{ (Request::segment(2) == 'orders') ? 'class=this' : '' }}>
						<a href="{{ route('admin.orders.index') }}">Đơn hàng</a>
					</li>
				</ul>
			</li>
			<li class="product">

				<a href="#0" {{ in_array(Request::segment(2), ['categories', 'products', 'types', 'brands', 'ship'] ) ? 'class=active'. ' ' .'id=current' : 'class=exp' }}>
					<span>Sản phẩm</span>
					<strong>5</strong>
				</a>
			
				<ul class="sub">
					<li {{ (Request::segment(2) == 'products') ? 'class=this' : '' }}>
						<a href="{{ route('admin.products.index') }}">Sản phẩm</a>
					</li>
					<li {{ (Request::segment(2) == 'categories') ? 'class=this' : '' }}>
						<a href="{{ route('admin.categories.index') }}">Danh mục</a>
					</li>
					<li {{ (Request::segment(2) == 'types') ? 'class=this' : '' }}>
						<a href="{{ route('admin.types.index') }}">Mục sản phẩm</a>
					</li>
					<li {{ (Request::segment(2) == 'ship') ? 'class=this' : '' }}>
						<a href="{{ route('admin.ship.index') }}">Dịch vụ ship</a>
					</li>
					<li {{ (Request::segment(2) == 'brands') ? 'class=this' : '' }}>
						<a href="{{ route('admin.brands.index') }}">Nhà cung cấp</a>
					</li>
				</ul>
			</li>
			<li class="account">
				<a href="" class=" exp" >
					<span>Tài khoản</span>
					<strong>1</strong>
				</a>
				<ul class="sub">
					<li >
						<a href="{{ route('admin.list') }}">Ban quản trị</a>
					</li>
				</ul>
			</li>
			<li class="content">
				<a href="#" {{ in_array(Request::segment(2), ['pages', 'slides'] ) ? 'class=active'. ' ' .'id=current' : 'class=exp' }} >
					<span>Nội dung</span>
					<strong>3</strong>
				</a>
				<ul class="sub">
					<li {{ (Request::segment(2) == 'slides') ? 'class=this' : '' }}>
						<a href="{{ route('admin.slides.index') }}">Slide</a>
					</li>
					<li >
						<a href="admin/news.html">Tin tức</a>
					</li>
					<li {{ (Request::segment(2) == 'pages') ? 'class=this' : '' }}>
						<a href="{{ route('admin.pages.index') }}">Quản lí trang</a>
					</li>
				</ul>
			</li>
			<li class="setting">
				<a href="#" {{ in_array(Request::segment(2), ['setting'] ) ? 'class=active'. ' ' .'id=current' : 'class=exp' }} >
					<span>Cài đặt</span>
					<strong>1</strong>
				</a>
				<ul class="sub">
					<li {{ (Request::segment(2) == 'description') ? 'class=this' : '' }}>
						<a href="{{ route('admin.settings.show') }}">Cấu hình website</a>
					</li>
				</ul>
			</li>
		</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<!-- Right side -->
	<div id="rightSide">
	    <!-- Account panel top -->
		<div class="topNav">
			<div class="wrapper">
				<div class="welcome">
					<span>Xin chào: <b>Admin</b></span>
				</div>
				<div class="userNav">
					<ul>
						<li><a href="/" target="_blank">
							<img style="margin-top:7px;" src="{{ asset('images/icons/light/home.png') }}" />
							<span>Trang chủ</span>
						</a></li>
						<!-- Logout -->
						<li><a href="{{ route('admin.logout') }}">
							<img src="{{ asset('images/icons/topnav/logout.png') }}" alt="" />
							<span>Đăng xuất</span>
						</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	    <!-- Main content -->
		<!-- Common -->
<!-- Title area -->
		<div class="titleArea">
			<div class="wrapper">
				<div class="pageTitle">
					<h5>@yield('title')</h5>
					<span>@yield('title.name')</span>
				</div>
				
				<div class="horControlB menu_action">
					<ul>
						@yield('link')
					</ul>
				</div>
				
				<div class="clear"></div>
			</div>
		</div>
		<div class="line"></div>

<!-- Message -->

<!-- Main content wrapper -->
		<div class="wrapper" id="main_product">
			@yield('content')
		</div>
        <div class="clear mt30"></div>
		
	    <!-- Footer -->
	    <div id="footer">
	    	<div class="wrapper">
	        	<div>Copy © 2016 luxury.com</div>
	        </div>
	     </div>
	</div>
	<div class="clear"></div>

	<script type="text/javascript">
		var admin_url 	= '';
		var base_url 	= '';
		var public_url 	= '';
	</script>

	<script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('crown/js/plugins/spinner/jquery.mousewheel.js') }}"></script>

	<script type="text/javascript" src="{{ asset('crown/js/plugins/forms/uniform.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/forms/jquery.tagsinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/forms/autogrowtextarea.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/forms/jquery.maskedinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/forms/jquery.inputlimiter.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('crown/js/plugins/tables/datatable.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/tables/tablesort.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/tables/resizable.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.tipsy.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.collapsible.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.progress.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.timeentry.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.colorpicker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.jgrowl.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.breadcrumbs.js') }}"></script>
	<script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.sourcerer.js') }}"></script>

	<script type="text/javascript" src="{{ asset('crown/js/custom.js') }}"></script>


	<!-- <script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>  -->
	<script type="text/javascript" src="{{ asset('js/jquery/chosen/chosen.jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery/scrollTo/jquery.scrollTo.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery/number/jquery.number.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery/zclip/jquery.zclip.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/jquery/colorbox/jquery.colorbox.js') }}"></script>

	<link rel="stylesheet" type="text/css" href="{{ asset('js/jquery/colorbox/colorbox.css') }}" media="screen" />

	<script type="text/javascript" src="{{ asset('js/custom_admin.js') }}" type="text/javascript"></script>
	<script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>
	<script>
		tinymce.init({
		    selector: '#content',
		    theme: 'modern',
		    height: 300,
		    entity_encoding : "raw",
		    plugins: [
		      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		      'save table contextmenu directionality emoticons template paste textcolor'
		    ],
		    content_css: 'css/content.css',
		    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
		});
	</script>
	@yield('js')
</body>
</html>