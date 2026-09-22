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


add_filter( 'yit_success-box_std', 'filter_yit_success_box_std' );
function filter_yit_success_box_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#599847'
      );
}

add_filter( 'yit_arrow-box_std', 'filter_yit_arrow_box_std' );
function filter_yit_arrow_box_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#599847'
      );
}

add_filter( 'yit_alert-box_std', 'filter_yit_alert_box_std' );
function filter_yit_alert_box_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#CA6B1C'
      );
}

add_filter( 'yit_error-box_std', 'filter_yit_error_box_std' );
function filter_yit_error_box_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#883333'
      );
}

add_filter( 'yit_notice-box_std', 'filter_yit_notice_box_std' );
function filter_yit_notice_box_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#9F6722'
      );
}

add_filter( 'yit_info-box_std', 'filter_yit_info_box_std' );
function filter_yit_info_box_std() {
      return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#277DCE'
      );
}

add_filter( 'yit_box-sections_std', 'filter_yit_box_sections_std' );
function filter_yit_box_sections_std() {
      return array(
            'size'   => 16,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#51595D'
      );
}
