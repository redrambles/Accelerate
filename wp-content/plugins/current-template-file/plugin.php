<?php

/*
  Plugin Name: Current Template File
  Plugin URI: http://wordpress.org/extend/plugins/current-template-file
  Description: Displays the current template file (and template parts if any) in WordPress admin toolbar
  Version: 1.3
  Author: Konstantinos Kouratoras
  Author URI: http://www.kouratoras.gr
  Author Email: kouratoras@gmail.com
  License: GPL v2

  Copyright 2012 Konstantinos Kouratoras (kouratoras@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class CurrentTemplateFile {

	private $current_template_parts = array();

	public function __construct() {
		
		load_plugin_textdomain('current-template-file',false,dirname( plugin_basename( __FILE__ ) ) . '/languages');
		add_action( 'all', array( $this, 'ctf_template_parts' ), 1, 3 );
		add_action('admin_bar_init', array(&$this, 'ctf_admin_bar_init'));
	}

	function ctf_admin_bar_init() {

		if (current_user_can( 'manage_options' ) && !is_admin() && is_admin_bar_showing()) {
			add_action('admin_bar_menu', array(&$this, 'ctf_admin_bar_item_add'), 100);
		}
	}
	
	function ctf_template_parts( $tag, $slug = null, $name = null ) {
		
		if ( strpos( $tag, 'get_template_part_' ) === 0)
		{
			if ( $slug != null ) {

				$current_templates = array();				
				if ( $name != null ) {
					$current_templates[] = "{$slug}-{$name}.php";
				}
				$current_templates[] = "{$slug}.php";
				$current_template_part = str_replace( get_template_directory() . '/', '', locate_template( $current_templates ) );

				if ( $current_template_part != '' ) {
					$this->current_template_parts[] = $current_template_part;
				}
			}
		}
	}
	
	function ctf_admin_bar_item_add() {

		global $wp_admin_bar;
		global $template;
		$template = str_ireplace( get_stylesheet_directory() . '/', '', str_ireplace( get_template_directory() . '/', '', $template ) );
				
		$wp_admin_bar->add_menu(array(
			'id' => 'ctf-header',
			'title' => __('Current Template File', 'current-template-file'),
			'href' => false,
			'parent' => false
		));
		
		$wp_admin_bar->add_menu(array(
			'id' => 'ctf-folder',
			'title' => __('Template folder', 'current-template-file'),
			'href' => false,
			'parent' => 'ctf-header'
		));
		
		$wp_admin_bar->add_menu(array(
			'id' => 'ctf-folder-value',
			'title' =>substr( get_template_directory_uri(), ( strpos( get_template_directory_uri(), 'wp-content') ) ),
			'href' => false,
			'parent' => 'ctf-folder'
		));
		
		$wp_admin_bar->add_menu(array(
			'id' => 'ctf-template',
			'title' => __('Template file', 'current-template-file'),
			'href' => false,
			'parent' => 'ctf-header'
		));
		
		$wp_admin_bar->add_menu(array(
			'id' => 'ctf-template-value',
			'title' => $template,
			'href' => false,
			'parent' => 'ctf-template'
		));
				
		if ( count( $this->current_template_parts ) > 0 ) {
		
			$wp_admin_bar->add_menu(array(
				'id' => 'ctf-template-parts',
				'title' => __('Template parts', 'current-template-file'),
				'href' => false,
				'parent' => 'ctf-header'
			));
		
			foreach ( $this->current_template_parts as $template_part_key => $template_part ) {
				$wp_admin_bar->add_menu(array(
						'id' => 'ctf-template-parts-' . $template_part_key,
						'title' => $template_part,
						'href' => false,
						'parent' => 'ctf-template-parts'
				));
			}
		}		
	}
}

new CurrentTemplateFile();