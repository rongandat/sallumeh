<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce;
?>
<div class="billing">
    <?php if ($woocommerce->cart->ship_to_billing_address_only() && $woocommerce->cart->needs_shipping()) : ?>

        <h1><?php _e('Billing &amp; Shipping', 'woocommerce'); ?></h1>

    <?php else : ?>

        <h1><?php _e('Billing Address', 'woocommerce'); ?></h1>

    <?php endif; ?>

    <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

    <?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

        <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>

    <?php endforeach; ?>

    <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>



    <?php if (!is_user_logged_in() && $checkout->enable_signup) : ?>

        <?php if ($checkout->enable_guest_checkout) : ?>

        <p class="form-row form-row-wide" style="float: left;">
                <input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e('Create an account?', 'woocommerce'); ?></label>
            </p>

            <?php if (( $woocommerce->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) && !$woocommerce->cart->ship_to_billing_address_only()) : ?>
                <?php
                if (empty($_POST)) :

                    $shiptobilling = (get_option('woocommerce_ship_to_same_address') == 'yes') ? 1 : 0;
                    $shiptobilling = apply_filters('woocommerce_shiptobilling_default', $shiptobilling);

                else :

                    $shiptobilling = $checkout->get_value('shiptobilling');

                endif;
                ?>

                <p class="form-row" id="shiptobilling" style="float: left;">
                    <input id="shiptobilling-checkbox" class="input-checkbox" <?php checked($shiptobilling, 1); ?> type="checkbox" name="shiptobilling" value="1" />
                    <label for="shiptobilling-checkbox" class="checkbox"><?php _e('Ship to billing address?', 'woocommerce'); ?></label>
                </p>
                
            <?php endif; ?>
        <?php endif; ?>
                <div class="clb"></div>
        <?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

        <div class="create-account">

            <p><?php _e('Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce'); ?></p>

            <?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>

                <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>

            <?php endforeach; ?>

            <div class="clear"></div>

        </div>

        <?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>

    <?php endif; ?>
</div>