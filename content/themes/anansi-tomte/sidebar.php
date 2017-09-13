<?php

if (class_exists( 'WooCommerce' ) && is_woocommerce()) :
	dynamic_sidebar( 'sidebar-shop' );
elseif ( is_search() ) :
	dynamic_sidebar( 'sidebar-content-left' );
else :
	dynamic_sidebar( 'sidebar-blog' );
endif;
?> 

