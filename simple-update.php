<?php

// Plugin Name: Flowpress Simple Update
// Plugin URI: http://flowpress.ca/
// Description: A simpler way to update your page content.
// Version: 0.0.2
// Author: Mario Dabek, Flowpress

class simple_update{

	var $import_validation;
	
	function setup_menu(){
		add_menu_page( 'Simple Update', 'Simple Update', 'administrator', __FILE__, array($this,'import_page') );
	}
	function enqueue_scripts(){
		wp_enqueue_script('simple_update',plugins_url( '/scripts.js' , __FILE__ ) ,array( 'jquery' ), '0.0.2');
		wp_enqueue_style( 'simple_update', plugins_url( '/styles.css', __FILE__ ), array(), '0.0.2' );
	}
	
}

$simple_update = new simple_update;
add_action('admin_menu',array(&$simple_update,'setup_menu'));
add_action('init', array(&$simple_update,'enqueue_scripts'), 1);

function add_some_box() {
    add_meta_box(
        'simple_update', 
        'Simple Update [ <a href="http://flowpress.ca/">Flowpress</a> ]',
        'add_something_in_the_box',
        array('post','page'), 
    	'normal',         
    	'high'       
    );
}
 
function add_something_in_the_box() {
	echo '<div class="simple_update_temp_data">nothing here</div>';
	echo '<div class="simple_update_temp_vars">no simple update variables found</div>';
}
 
if (is_admin()) add_action('admin_menu', 'add_some_box');