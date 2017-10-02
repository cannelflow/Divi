<?php

// enqueue styles for child theme
// @ https://digwp.com/2016/01/include-styles-child-theme/

function example_enqueue_styles() {
	
	
	//enqueue bootstrap.min.css
	wp_enqueue_style( 'bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css' );
	
	//enqueue bootstrap.min.js
	wp_enqueue_script( 'bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array(), '3.0.0', true );
	
	
	//font awesome icon
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 
	
	//enqueue main.js
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() .'/main.js', array('jquery'));
	
	// enqueue parent styles
	wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css');
	
	// enqueue child styles
	wp_enqueue_style('child-theme', get_stylesheet_directory_uri() .'/style.css', array('parent-theme'));
	
	// circular progress bar styles
	//wp_enqueue_style('circular-progress bar', get_stylesheet_directory_uri() .'/progressbar.css');
	
}

add_action( 'wp_enqueue_scripts', 'example_enqueue_styles' );

// Register code.php to remove extra dot after excerpt
require_once get_stylesheet_directory().'/custom-modules/code.php';


?>
