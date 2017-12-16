<?php
/*
  Plugin Name: Import Old Articles
  Plugin URI: https://raduganea.com
  Description:
  Version: 1
  Author: Radu Ganea
 */

/**
 * Register a custom menu page.
 */
function k_custom_menu_item() {
	add_menu_page(
	'Import Old Content', 'Import Old Content', 'manage_options', 'k-custom-page', 'k_custom_content_page', '', 6
	);
}

add_action( 'admin_menu', 'k_custom_menu_item' );

function k_custom_content_page() {
	?>
	<h2>Import Old Content</h2>
	<a class="button" id="k-custom-ajax">Import</a>
	<div id="k-results"></div>

	<script>
	    jQuery( document ).ready( function () {
	        jQuery( "#k-custom-ajax" ).on( "click", function ( event ) {
	            event.preventDefault();
	            k_custom_process();
	        } );
	    } );
	    function k_custom_process() {
	        var data = {
	            'action': 'k_custom_action'
	        };
	        jQuery.post( ajaxurl, data, function ( response ) {
	            jQuery("#k-results").html('<p>Got this from the server:</p><pre>' + response + '</pre>');
	        } );
	    }
	</script>

	<?php
}

add_action('wp_ajax_k_custom_action', 'k_custom_action_func');
function k_custom_action_func(){
	ob_start();
	echo "something";
	$result = ob_get_clean();
	echo $result;
	exit();
}