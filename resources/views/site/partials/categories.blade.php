<div class="col-xs-12 col-md-3 col-sm-12">
	<nav id="main-nav" role="navigation">
		<?php
			$roots = App\Category::roots()->get();

			echo '<ul class="sm sm-vertical sm-blue" id="main-menu">';
			foreach($roots as $root) renderCate($root);
			echo "</ul>";

			function renderCate($node) {
				echo "<li> <a href='".route('site.categories', [$node->id, $node->slug])."'>{$node->name}</a>";

			  if ( $node->children()->count() > 0 ) {
			    echo "<ul>";
			    foreach($node->children as $child) renderCate($child);
			    echo "</ul>";
			  }

			  echo "</li>";
			}
		?>
	</nav>
</div>