<body>
	<style type="text/css">
		table tr td {
		    vertical-align: middle;
		    padding: 0 35px;
		}
	</style>
	<p><b>Xin chào</b> {{ $data->name }}!</p>
	<p>Đơn hàng của bạn đã được tiếp nhận, chúng tôi sẽ nhanh chóng liên hệ với bạn.</p>
	<p>Hoặc liên lệ với chúng tôi:</p>
	<table>
		<tr>
			<td style="padding: 0 35px;"><img src="{{ url($setting->logo) }}" width="100" height="60"></td>
			<td style="padding: 0 35px;"><b>E-mail:</b> {{ $setting->email }}</td>
			<td style="padding: 0 35px;"><b>Số ĐT:</b> <span style="letter-spacing: 1px">{{ $setting->phone }}</span></td>
		</tr>
	</table>
	<h3>Thông tin đơn hàng của bạn:</h3>
	<p> <b>Mã đơn hàng:</b> #{{$data->id}}	<b>Ngày tạo:</b> {{$data->created_at}}</p>
	<div class="row col-md-12 cart-item">
	    <div class="table-responsive cart_info">
	        <table style="boder: 1px solid #ccc; text-align: center;">
	            <thead>
	                <tr style="background: #1F79A7; color: #FFF;">
	                    <th>Mã đơn hàng</th>
	                    <th class="image" width="80">Sản phẩm</th>
	                    <th width="170"></th>
	                    <th class="">Màu sắc</th>
	                    <th class="">Kích thước</th>
	                    <th colspan="2">Dv chuyển phát</th>
	                    <th class="">Giá tiền</th>
	                    <th class="">Số lượng</th>
	                    <th class="price">Tổng tiền</th>
	                </tr>
	            </thead>
				@foreach(Cart::content() as $item)
	                <tbody>
	                    <tr>
	                        <td>
	                        	#{{$data->id}}
	                        </td>
	                        <td class="cart_product">
	                        	<img src="{{ url($item->options->image) }}" class="img-responsive" alt="" width="65" height="80" />
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