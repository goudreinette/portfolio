<?php
/**
 * Plugin Name: WerkStatt - Required Plugin
 * Description: This contains the custom post types needed for the theme functionality
 * Version: 1.0.2
 * Author: fuelthemes
 * Author URI: http://themeforest.net/user/fuelthemes
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

function thb_create_post_type_portfolios() {
	$slug = sanitize_title(ot_get_option('portfolio_slug','portfolio'));
	$labels = array(
		'name' => __( 'Portfolio','werkstatt'),
		'singular_name' => __( 'Portfolio','werkstatt' ),
		'rewrite' => array('slug' => __( 'portfolios','werkstatt' )),
		'add_new' => _x('Add New', 'portfolio', 'werkstatt'),
		'add_new_item' => __('Add New Portfolio','werkstatt'),
		'edit_item' => __('Edit Portfolio','werkstatt'),
		'new_item' => __('New Portfolio','werkstatt'),
		'view_item' => __('View Portfolio','werkstatt'),
		'search_items' => __('Search Portfolio','werkstatt'),
		'not_found' =>  __('No portfolios found','werkstatt'),
		'not_found_in_trash' => __('No portfolios found in Trash','werkstatt'), 
		'parent_item_colon' => ''
  );
  
  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-schedule',
		'query_var' => true,
		'rewrite' => array('slug' => $slug),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor', 'excerpt', 'thumbnail', 'comments')
  ); 
  
  register_post_type('portfolio',$args);
  flush_rewrite_rules();
  
  $category_labels = array(
  	'name' => __( 'Portfolio Categories', 'werkstatt'),
  	'singular_name' => __( 'Portfolio Category', 'werkstatt'),
  	'search_items' =>  __( 'Search Portfolio Categories', 'werkstatt'),
  	'all_items' => __( 'All Portfolio Categories', 'werkstatt'),
  	'parent_item' => __( 'Parent Portfolio Category', 'werkstatt'),
  	'edit_item' => __( 'Edit Portfolio Category', 'werkstatt'),
  	'update_item' => __( 'Update Portfolio Category', 'werkstatt'),
  	'add_new_item' => __( 'Add New Portfolio Category', 'werkstatt'),
    'menu_name' => __( 'Portfolio Categories', 'werkstatt')
  ); 	
  
  register_taxonomy("portfolio-category", 
  		array("portfolio"), 
  		array("hierarchical" => true, 
  				'labels' => $category_labels,
  				'show_ui' => true,
      		'query_var' => true,
  				'rewrite' => array( 'slug' => 'portfolio-category' )
  ));

	/* Add Custom Columns */
  function thb_column_value($column_name, $id) {
  	if ($column_name == 'thbpid') echo $id;
  }
  function thb_column_add_clean($cols) {
  	$cols['thbpid'] = __('ID', 'werkstatt');
  	return $cols;
  }

  add_filter("manage_portfolio_posts_custom_column", 'thb_column_value', 10, 2);
  add_filter("manage_portfolio_posts_columns", 'thb_column_add_clean', 10 );
}
/* Initialize post types */
add_action( 'init', 'thb_create_post_type_portfolios', 10 );