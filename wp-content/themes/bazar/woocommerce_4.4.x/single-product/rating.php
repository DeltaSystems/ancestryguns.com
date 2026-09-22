<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$averange_rating = wc_get_rating_html( $product->get_average_rating() );
$rating_count = $product->get_rating_count();

if ( $rating_count > 0 ) : ?>

	<div class="rating-single-product">
		<?php
			// if we have some rating we'll show the div content.
			if ( $averange_rating != '' ) {
				echo $averange_rating . " <span class='rating-text'>" . $rating_count . " " . _n( "REVIEW", "REVIEWS", $rating_count, "yit" ) . " </span>";
			}
		?>
	</div>
	<div class="clearfix"></div>

<?php endif; ?>
