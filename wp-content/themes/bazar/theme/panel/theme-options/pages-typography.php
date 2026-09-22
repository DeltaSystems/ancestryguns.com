<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

function yit_pages_404_font_std( $array ) {
    $array['size'] = 18;
    $array['family'] = 'Play';
	$array['style']  = 'regular';
    $array['color']  = '#676768';
    
    return $array;
}
add_filter( 'yit_pages-404-font_std', 'yit_pages_404_font_std' );

add_filter( 'yit_pages-404-a-font_std', 'filter_yit_pages_404_a_font_std' );
add_filter( 'yit_pages-404-a-font-hover_std', 'filter_yit_pages_404_a_font_hover_std' );

function filter_yit_pages_404_a_font_std() { return "#aa620d"; }
function filter_yit_pages_404_a_font_hover_std() { return "#d98104"; }