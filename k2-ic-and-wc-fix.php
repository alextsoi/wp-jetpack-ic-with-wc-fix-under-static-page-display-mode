<?php
	/*
		Description: Fix the jetpack infinite scroll not working problem if static page display mode is selected when you installed woo-commerce at the same time.
		Version:     1.0
		Author:      K2 Digital
		Author URI:  https://k2.digital
		License:     GNU General Public License v3.0
		License URI: http://www.gnu.org/licenses/gpl-3.0.txt
		Article URL: http://hands-on.online/wordpress-jetpack-infinite-scroll-not-working-with-woocommerce-when-static-page-is-used-as-front-page/
	*/
	
	/*
		Assuming you have installed the infinite scroll plugin from jetpack
		and also you install woo-commerce as well
		and you set the display mode to static page ( front page & posts page ),
		then infinite scroll will not work in custom post type
		( I didn't test the blog archive page, but I believe it is not work too)
		And this is the quick fix to make the infinite scroll work again
	*/

	// Bug fix if using woo-commerce at the same with infinite scroll
	add_filter('infinite_scroll_query_args', 'remove_meta_query_in_infinite_scroll', 999);
	function remove_meta_query_in_infinite_scroll($query_args){
		if(isset($query_args['post_type']) && in_array($query_args['post_type'], array('MY_CUSTOM_POST_TYPE', 'MY_OTHER_CUSTOM_POST_TYPE'))){
			unset($query_args['meta_query']);
			unset($query_args['product_query']);
			unset($query_args['orderby']);
		}
		return $query_args;
	}