<?php

// Plugin Name: Flowpress Simple Update
// Description: A simpler way to update your page content.

class simple_update{

	var $import_validation;

	function setup_menu(){
		add_menu_page( 'Simple Update', 'Simple Update', 'administrator', __FILE__, array($this,'import_page') );
	}

	function enqueue_scripts(){
		wp_enqueue_script('simple_update',plugins_url( '/scripts.js' , __FILE__ ) ,array( 'jquery' ));
		wp_enqueue_style( 'simple_update', plugins_url( '/styles.css', __FILE__ ), array(), '0.1' );
	}

	
}

$simple_update = new simple_update;

add_action('admin_menu',array(&$simple_update,'setup_menu'));
add_action('init', array(&$simple_update,'enqueue_scripts'), 1);

function add_some_box() {
    add_meta_box(
        'simple_update', // id of the <div> we'll add
        'Simple Update [ <a href="http://flowpress.ca/">Flowpress</a> ]', //title
        'add_something_in_the_box', // callback function that will echo the box content
        array('post','page'), // where to add the box: on "post", "page", or "link" page
    	'normal',         // Priority
    	'high'         // Priority
    );
}
 
// This function echoes the content of our meta box
function add_something_in_the_box() {
	echo '<div class="simple_update_temp_data">nothing here</div>';
	echo '<div class="simple_update_temp_vars">no simple update variables found</div>';
}
 
// Hook things in, late enough so that add_meta_box() is defined
if (is_admin())
    add_action('admin_menu', 'add_some_box');
