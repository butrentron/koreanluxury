<body>
	<p>Xin chào Admin Luxury.com!</p>
	<p>{{ $data->name }} đã gửi 1 yêu cầu đặt hàng đến hệ thống, {{ $data->created_at }}</p>

	<a href="{{ url('admin/orders/'.$data->id) }}">Chi tiết đơn hàng #{{ $data->id }}</a>

	<p>Thông tin liên hệ</p>
	<table>
		<tr>
			<td>Họ tên:</td>
			<td>{{ $data->name }}</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{ $data->email }}</td>
		</tr>
		<tr>
			<td>Số ĐT:</td>
			<td>{{ $data->phone }}</td>
		</tr>
		<tr>
			<td>Địa chỉ nhận hàng:</td>
			<td>{{ $data->address }}</td>
		</tr>
	</table>

	<h5>Thông tin đơn hàng của {{ $data->name }}</h5>
	<div class="row col-md-12 cart-item">
	    <div class="table-responsive cart_info">
	        <table style="boder: 1px solid #ccc; text-align: center;">
	            <thead>
	                <tr style="background: #1F79A7; color: #FFF;">
	                    <th class="image" width="80">Sản phẩm</th>
	                    <th width="170"></th>
	                    <th class="">Màu sắc</th>
	                    <th class="">Kích thước</th>
	                    <th colspan="2">Dịch vụ chuyển phát</th>
	                    <th class="">Giá tiền</th>
	                    <th class="">Số lượng</th>
	                    <th class="price">Tổng tiền</th>
	                </tr>
	            </thead>
				@foreach(Cart::content() as $item)
	                <tbody>
	                    <tr>
	                        <td class="cart_product">
	                        	<img src="{{ url($item->options->image) }}" class="img-responsive" alt=""/>
	                        </td>
	                        <td class="cart_description">
	                            <h4><a href="{{ route('site.products', [ $item->id, $item->options->slug ]) }}">{{$item->name}}</a></h4>
	                        </td>
	                        <td class="cart_price text-center">
	                            <p>{{ $item->options->color ? $item->options->color : '-' }}</p>
	                        </td>
	                        <td class="cart_price text-center">
	                            <p>{{ $item->options->size ? $item->options->size : '-' }}</p>
	                        </td>
	                        <td class="cart_price text-center">
	                            <img src="{{ $item->options->logo_ship }}" width="80" height="45">
	                        </td>
	                        <td class="cart_price text-center">
	                            <p>{{ $item->options->ship ? $item->options->ship : '-' }}</p>
	                        </td>
	                        <td class="cart_price text-center">
	                            <p>{{ number_format($item->price) }} <sup>vnđ</sup></p>
	                        </td>
	                        <td class="cart_quantity">
	                            <div class="cart_quantity_button">
	                            	{{ $item->qty }}
	                            </div>
	                        </td>
	                        <td class="cart_total">
	                            <p class="cart_total_price">{{ number_format($item->subtotal) }} <sup>vnđ</sup></p>
	                        </td>
	                    </tr>
					@endforeach
						<tr style="background: #1F79A7; color: #FFF;">
							<td colspan="9">Tổng cộng</td>
							<td>{{ number_format(Cart::total()) }}</td>
						</tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</body>