<div class="section brand">
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-name fadeIn">
            <h2><span class="high-light">Thương hiệu</span></h2>
        </div>
    </div>
	<div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="7000" id="myCarouselGrid">
	    <div class="carouselGrid-inner">
	    	@foreach($brands as $brand)
	        <div class="item">
	            <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6 col-mb-2">
	            	<img src="{{ url($brand->image) }}" title="{{ $brand->name }}" alt="{{ $brand->name }}" width="180" height="140" >
	        	</div>
	        </div>
	        @endforeach
 		</div>
	    <a class="left carouselGrid-control" href="#myCarouselGrid" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
	    <a class="right carouselGrid-control" href="#myCarouselGrid" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
	</div>
</div>