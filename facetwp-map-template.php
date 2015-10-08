<?php
/*
Plugin Name: FacetWP - Map Template
Plugin URI: https://facetwp.com/
Description: Use a Google Map for your template listing
Version: 0.1
Author: Matt Gibbs

Copyright 2015 Matt Gibbs

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/>.
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


class FacetWP_Map_Template
{
    function __construct() {
        add_action( 'init', array( $this, 'init' ) );
    }


    function init() {
        add_filter( 'facetwp_templates', array( $this, 'register_template' ) );
        add_filter( 'facetwp_template_html', array( $this, 'generate_map' ), 10, 2 );
    }


    function register_template( $templates ) {
        $templates[] = array(
            'label'     => 'Map',
            'name'      => 'map',
            'query'     => '<' . "?php\nreturn array(\n  'post_type' => 'post',\n  'post_status' => 'publish',\n  'posts_per_page' => -1\n);",
            'template'  => ''
        );

        return $templates;
    }


    function generate_map( $override, $class ) {
        if ( 'map' == $class->template['name'] ) {
            ob_start();
            include( dirname( __FILE__ ) . '/includes/display-code.php' );
            return ob_get_clean();
        }

        return $override;
    }
}


new FacetWP_Map_Template();
