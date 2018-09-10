<?php

function ju_head(){
	?>
    <style type="text/css">
	.navbar.navbar-inverse, .card .card-header.bg-primary{
		background-color: <?php echo get_theme_mod('header_bg_color', '#4205f4'); ?> !important;	
	}
	</style>
	<?php
}