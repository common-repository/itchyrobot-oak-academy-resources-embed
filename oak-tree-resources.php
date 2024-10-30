<?php
/*
Plugin Name: Embed Oak Academy Resources by iTCHYROBOT
Description: Activate the plugin then head to your page and add the iTCHYROBOT: Oak Academy Resources block.
Version: 1.0
Requires at least: 5.4.2
Requires PHP: 7.3
Author: iTCHYROBOT - Rob Adams, Scott Thornburn
Author URI: https://www.itchyrobot.co.uk/
License: GPLv2 
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function itchyrobot_oak_tree_render_callback( $attributes, $content ) {
    $post_id = (isset($attributes['selectedPost']) ? $attributes['selectedPost'] : "" ); //specify post id here
    $title =  (isset($attributes['title']) ? $attributes['title'] : "" );
    $output = $post_id;
    //$title = "";

    $output = "<div class='ir-oak-academy'><h3>".$title."</h3>";
    $output .= '<div class="oak-academy-container">';
    $output .= '<div class="iroa-card"><a href="https://classroom.thenational.academy/subjects-by-year/'.$post_id.'/subjects/english"><img src="'.plugin_dir_url( __FILE__  ).'images/english.jpg"/></a></div>';
    $output .= '<div class="iroa-card"><a href="https://classroom.thenational.academy/subjects-by-year/'.$post_id.'/subjects/foundation"><img src="'.plugin_dir_url( __FILE__ ).'images/foundation.jpg"/></a></div>';
    $output .= '<div class="iroa-card"><a href="https://classroom.thenational.academy/subjects-by-year/'.$post_id.'/subjects/maths"><img src="'.plugin_dir_url( __FILE__ ).'images/maths.jpg"/></a></div>';
    $output .= '<div class="iroa-card"><a href="https://classroom.thenational.academy/subjects-by-year/'.$post_id.'/subjects/pshe"><img src="'.plugin_dir_url( __FILE__ ).'images/PHSE.jpg"/></a></div>';
    $output .= '<div class="iroa-card"><a href="https://classroom.thenational.academy/pe"><img src="'.plugin_dir_url( __FILE__ ).'images/PE.jpg"/></a></div>';
    $output .= '<div class="iroa-card"><a href="https://classroom.thenational.academy/schedule-by-year/'.$post_id.'"><img src="'.plugin_dir_url( __FILE__ ).'images/schedule.jpg"/></a></div>';
    $output .= "</div></div>";

    $output.= "<style>
    .ir-oak-academy {
        background-color:#008237;
        border-radius:10px;
        margin-bottom:1rem;
        padding:1rem;
        background-image:url(".plugin_dir_url( __FILE__ )."images/oakacademy.png);
        background-position:top right;
        background-repeat:no-repeat;
        background-size: 126px;
    }
    .ir-oak-academy h3 {
        color:#fff !important;
    }
    .iroa-card {
        display:inline-block;
        max-width:200px;
        background-color:#008237;
        border-radius:10px;
        margin: 0 10px 10px 0;
    }
    .iroa-card img {
        border-radius:10px;
    }
    .iroa-card:hover {
        opacity:0.7;
    }
    </style>";
    return $output; 
}


function itchyrobot_oak_tree_block() {
    wp_register_script(
        'itchyrobot-oak-tree',
        plugins_url( 'block.js', __FILE__ ),
        array('wp-editor', 'wp-blocks', 'wp-element', 'wp-data' ), '2.0.1'
    );

    register_block_type( 'itchyrobot-oak-tree/oak-tree-resource', array(
        'editor_script' => 'itchyrobot-oak-tree',
        'render_callback' => 'itchyrobot_oak_tree_render_callback'
    ) );

}
add_action( 'init', 'itchyrobot_oak_tree_block' );