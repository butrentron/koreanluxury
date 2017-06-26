<div class="col-xs-12 col-md-9 col-sm-12">  
    <div class="slider_container">
		<div class="flexslider">
		    <ul class="slides">
		    	@foreach($slides as $slide)
		    	<li>
		    		<a href="{{ ($slide->link && $slide->link != '') ? $slide->link : '#'}}">
		    			<img src="{{ url($slide->image) }}" alt="{{ $slide->title }}" title="{{ $slide->title }}"/>
		    		</a>
		    		<div class="flex-caption">
	                     <div class="caption_title_line">
	                     	<h2>{{ $slide->title }}</h2>
	                     	<p>{{ $slide->desc }}</p>
	                     </div>
	                </div>
		    	</li>
		    	@endforeach
		    </ul>
		</div>
	</div> 
</div>