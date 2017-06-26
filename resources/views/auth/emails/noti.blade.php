<body>
	<div class="row col-md-12 cart-item">
	    <div class="table-responsive cart_info">
	    	<p>Xin chào {{ $data->name }}!</p>
	    	@if($flag == 3)
		        <p>Vì một số xác nhận không chứng thực, đơn hàng của bạn đã bị hủy.</p>
		        <p>Xin vui lòng trả lời email này nếu bạn có bất kỳ câu hỏi nào.</p>
		        <p>Cảm ơn bạn đã ghé thăm sử dụng dịch vụ của chúng tôi.</p>
			@endif
	    </div>
	</div>
</body>