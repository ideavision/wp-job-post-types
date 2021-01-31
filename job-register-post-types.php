<?php
/*
Plugin Name: Job Register Post Types
Plugin URI: https://ideavision.com/
Description: add job post type , job category for your wordpress.
Version: 1.0
Author: Narvik Aghamalian
Author URI: https://ideavisionx.com/
License: GPLv2 or later
*/
	

/*****************************************************************************
stylesheet
*****************************************************************************/
function ideavision_job_styles() {
 
    wp_enqueue_style( 'jobs',  plugin_dir_url( __FILE__ ) . '/css/jobs.css');                      

}
add_action( 'wp_enqueue_scripts', 'ideavision_job_styles');

/*****************************************************************************
Include job content file
*****************************************************************************/
include( plugin_dir_path( __FILE__ ) . 'includes/job-content.php');

/*****************************************************************************
Register post type - job
*****************************************************************************/
function ideavision_register_post_type() {
	
	// jobs
	$labels = array( 
		'name' => __( 'Jobs' , 'ideavision' ),
		'singular_name' => __( 'Jobs' , 'ideavision' ),
		'add_new' => __( 'New Jobs' , 'ideavision' ),
		'add_new_item' => __( 'Add New Jobs' , 'ideavision' ),
		'edit_item' => __( 'Edit Jobs' , 'ideavision' ),
		'new_item' => __( 'New Movie' , 'ideavision' ),
		'view_item' => __( 'View Jobs' , 'ideavision' ),
		'search_items' => __( 'Search Jobs' , 'ideavision' ),
		'not_found' =>  __( 'No Jobs Found' , 'ideavision' ),
		'not_found_in_trash' => __( 'No Jobs found in Trash' , 'ideavision' ),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'hierarchical' => false,
		'supports' => array(
			'title', 
			'editor', 
			'excerpt', 
			'custom-fields', 
			'thumbnail',
			'page-attributes'
		),
		'rewrite'   => array( 'slug' => 'jobs' ),
		'show_in_rest' => true

	);
	register_post_type( 'ideavision_job', $args );
		
}
add_action( 'init', 'ideavision_register_post_type' );


/**********************************************************************************
	 register taxonomy - Category
**********************************************************************************/
function ideavision_register_taxonomy() {	
	
	// jobs
	$labels = array(
		'name' => __( 'Category' , 'ideavision' ),
		'singular_name' => __( 'Category', 'ideavision' ),
		'search_items' => __( 'Search Category' , 'ideavision' ),
		'all_items' => __( 'All Category' , 'ideavision' ),
		'edit_item' => __( 'Edit Category' , 'ideavision' ),
		'update_item' => __( 'Update Category' , 'ideavision' ),
		'add_new_item' => __( 'Add New Category' , 'ideavision' ),
		'new_item_name' => __( 'New Category Name' , 'ideavision' ),
		'menu_name' => __( 'Job Category' , 'ideavision' ),
	);
	
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'sort' => true,
		'args' => array( 'orderby' => 'term_order' ),
		'rewrite' => array( 'slug' => 'category' ),
		'show_admin_column' => true,
		'show_in_rest' => true

	);
	
	register_taxonomy( 'ideavision_category', array( 'ideavision_job' ), $args);
	
}
add_action( 'init', 'ideavision_register_taxonomy' );
