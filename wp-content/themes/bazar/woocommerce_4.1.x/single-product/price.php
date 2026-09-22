<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$shop_view_show_price_range_option = yit_get_option( 'shop-view-show-price-range' );
$porduct_type = property_exists( 'WC_Product', 'product_type' ) ? $product->product_type : $product->get_type();
if ( ! ( $shop_view_show_price_range_option == "1" || $shop_view_show_price_range_option == "true" ) && ( $porduct_type == 'variable' || $porduct_type == 'variable-subscription' ) ) return ;

/* woocommerce subscription price fix */
$class_subscription ="";
if($porduct_type == 'subscription' || $porduct_type == 'variable-subscription') $class_subscription ="subscription";
/*--------------------------*/

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
