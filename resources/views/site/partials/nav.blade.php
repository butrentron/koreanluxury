    
<nav class="navbar navbar-default navbar-static-top" role="navigation"> 
	<div class="container"> 
		<div class="navbar-header"> 
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false"> 
				<span class="sr-only">Toggle navigation</span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button> 
			<a href="/" class="navbar-brand">Trang chủ</a> 
		</div> 
		<!-- <li><a href="" class="gif">Hot sale 70%</a></li> -->
		<nav id="bs-navbar" class="collapse navbar-collapse"> 
			<?php
				$roots = App\Page::roots()->get();

				echo '<ul class="nav navbar-nav">';
				foreach($roots as $root) renderNode($root);
				echo "</ul>";

				function renderNode($node) {
					$caret = ($node->depth == 0) ? "<b class='caret'> </b>" : "<b class='right-caret pull-right'> </b>";
				  	echo ($node->children()->count() > 0) ? "<li class='dropdown'> <a href='". route('site.pages', [$node->uri]) ."' class='dropdown-toggle' data-toggle='dropdown'>{$node->name} {$caret}</a>" 
				  										: "<li> <a href='". route('site.pages', [$node->uri]) ."'>{$node->name}</a>";

				  if ( $node->children()->count() > 0 ) {
				    echo "<ul class='dropdown-menu'>";
				    foreach($node->children as $child) renderNode($child);
				    echo "</ul>";
				  }

				  echo "</li>";
				}
			?>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				        	<span class="glyphicon glyphicon-shopping-cart"></span> {{ Cart::count() }} - sản phẩm<span class="caret"></span>
				        </a>
			          	<ul class="dropdown-menu dropdown-cart" role="menu">
			          		@if(count(Cart::content()))
			          			@foreach(Cart::content() as $item)
					              	<li>
					                  	<span class="item">
						                    <span class="item-left">
						                        <img src="{{ $item->options->image }}" alt="{{ $item->name }}" title="{{ $item->name }}" width="50" height="50"/>
						                        <span class="item-info">
						                            <span>{{ $item->name }}</span>
						                            <span>{{ number_format($item->price) }} <sup>vnđ</sup></span>
						                        </span>
						                    </span>
						                    <span class="item-right">
						                        <a class="btn btn-xs btn-danger pull-right" href="{{ route('site.cart.get', ['product_id' => $item->id, 'remove' => 'true']) }}">x</a>
						                    </span>
						                </span>
					              	</li>
					            @endforeach
			              	@endif
				            <li class="divider"></li>
				            <li><a class="text-center" href="{{ route('site.cart.get') }}">Xem giỏ hàng</a></li>
			          	</ul>
				    </li>
				    <!-- @if(Auth::guest())
					<li> <a href="/login" class="btn-primary a-menu">Đăng Nhập</a></li>
					<li> <a href="/register" class="btn-danger a-menu">Đăng kí</a></li>
					@else
					<li> 
						<a href=""> <b>Xin chào:</b> {{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="">Thông tin cá nhân</a></li>
							<li><a href="">Lịch sử đặt/mua hàng</a></li>
							<li><a href="{{ url('/logout') }}">Đăng xuất</a></li>
						</ul>
					</li>
					@endif -->
				</ul>
			</div>
		</nav> 
	</div> 
</nav>
