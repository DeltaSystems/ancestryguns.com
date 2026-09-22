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


add_filter( 'yit_recent-posts-title_std', 'filter_yit_recent_posts_title_std' );
function filter_yit_recent_posts_title_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#1f1f1f'
      );
}

add_filter( 'yit_recent-posts-title-hover_std', 'filter_yit_recent_posts_title_hover_std' );
function filter_yit_recent_posts_title_hover_std() { return "#aa620d"; }

add_filter( 'yit_recent-posts-excerpt_std', 'filter_yit_recent_posts_excerpt_std' );
function filter_yit_recent_posts_excerpt_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#ffffff'
      );
}

add_filter( 'yit_recent-posts-date_std', 'filter_yit_recent_posts_date_std' );
function filter_yit_recent_posts_date_std() {
      return array(
            'size'   => 10,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#585555'
      );
}

add_filter( 'yit_recent-posts-readmore_std', 'filter_yit_recent_posts_readmore_std' );
function filter_yit_recent_posts_readmore_std() {
      return array(
            'size'   => 13,
            'unit'   => 'px',
            'family' => 'regular',
            'style'  => 'bold',
            'color'  => '#585555'
      );
}

add_filter( 'yit_recent-posts-readmore-hover_std', 'filter_yit_recent_posts_readmore_hover_std' );
function filter_yit_recent_posts_readmore_hover_std() {
      return "#d98104";
}