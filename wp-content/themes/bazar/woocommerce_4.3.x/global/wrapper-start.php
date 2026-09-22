<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="primary" class="<?php yit_sidebar_layout(); ?> <?php echo ( function_exists('WC') && is_product() ) ? 'product' : ''; ?> clearfix">
	<div class="container group">
		<div class="row">
			<?php do_action( 'yit_before_content' ) ?>
			<!-- START CONTENT -->
			<?php if( is_product() ): ?>
				<div id="content-shop" class="span<?php echo ( yit_get_sidebar_layout() == 'sidebar-no' && yit_product_form_position_is('in-content') ) ? 12 : 9 ?> content group">
			<?php else : ?>
				<div id="content-shop" class="span<?php echo ( yit_get_sidebar_layout() == 'sidebar-no' ) ? 12 : 9 ?> content group">
			<?php endif; ?>