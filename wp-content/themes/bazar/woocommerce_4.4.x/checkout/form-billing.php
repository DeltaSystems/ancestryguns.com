<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
    <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

        <h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

    <?php else : ?>

        <h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

    <?php endif; ?>

    <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
        <?php
        $fields = $checkout->get_checkout_fields( 'billing' );

        foreach ( $fields as $key => $field ) {
            woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
        }
        ?>
    </div>

    <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>

    <?php if( !yit_get_option('shop-checkout-multistep') ): ?>
        <?php if (!is_user_logged_in() && $checkout->enable_signup)  : ?>

            <?php if ($checkout->enable_guest_checkout) : ?>

                <p class="form-row form-row-wide create-account">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
                    </label>
                </p>

            <?php endif; ?>

            <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

            <?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

                <div class="create-account">

                    <p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'yit' ); ?></p>

                    <?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

                        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

                    <?php endforeach; ?>

                    <div class="clear"></div>

                </div>

            <?php endif; ?>

            <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

        <?php endif; ?>
    <?php else: ?>
        <?php if ( ( WC()->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) && ! wc_ship_to_billing_address_only() ) : ?>

            <?php
            if ( empty( $_POST ) ) {

                $shiptobilling = yit_woocommerce_default_shiptobilling() ? 1 : 0;
                $shiptobilling = apply_filters('woocommerce_shiptobilling_default', $shiptobilling);

            } else {

                $shiptobilling = $checkout->get_value('ship_to_billing');

            }
            ?>

            <p class="form-row" id="shiptobilling_bill">
                <input id="shiptobilling_bill-checkbox" class="input-checkbox" <?php checked($shiptobilling, 1); ?> type="checkbox" name="ship_to_billing" value="1" />
                <label for="shiptobilling_bill-checkbox" class="checkbox"><?php _e('Ship to billing address?', 'yit'); ?></label>
            </p>
        <?php endif ?>
    <?php endif; ?>

</div>