<?php
/*
Plugin Name: WooCommerce Vendreo Gateway (Card)
Description: Accept payments via card or bank transfer using Vendreo's Payment Gateway
Version: 1.0.0
Author: Vendreo
Author URI: docs.vendreo.com
License: MIT
License URI: https://opensource.org/license/mit/
Text Domain: vendreo-gateway
Domain Path: /languages
*/

add_action('plugins_loaded', 'woocommerce_myplugin', 0);

function woocommerce_myplugin()
{
    if (!class_exists('WC_Payment_Gateway'))
        return;

    include(plugin_dir_path(__FILE__) . 'vendreo-card-gateway.php');
}


add_filter('woocommerce_payment_gateways', 'add_vendreo_gateway');

function add_vendreo_gateway($gateways)
{
    $gateways[] = 'Vendreo_Card_Gateway';
    return $gateways;
}

/**
 * Custom function to declare compatibility with cart_checkout_blocks feature
 */
function declare_cart_checkout_blocks_compatibility()
{
    if (class_exists('\Automattic\WooCommerce\Utilities\FeaturesUtil')) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__, true);
    }
}

// Hook the custom function to the 'before_woocommerce_init' action
add_action('before_woocommerce_init', 'declare_cart_checkout_blocks_compatibility');

// Hook the custom function to the 'woocommerce_blocks_loaded' action
add_action('woocommerce_blocks_loaded', 'oawoo_register_order_approval_payment_method_type');

/**
 * Custom function to register a payment method type
 */
function oawoo_register_order_approval_payment_method_type()
{
    // Check if the required class exists
    if (!class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
        return;
    }

    // Include the custom Blocks Checkout class
    require_once plugin_dir_path(__FILE__) . 'vendreo-block.php';

    // Hook the registration function to the 'woocommerce_blocks_payment_method_type_registration' action
    add_action(
        'woocommerce_blocks_payment_method_type_registration',
        function (Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry) {
            // Register an instance of Vendreo_Card_Gateway_Blocks
            $payment_method_registry->register(new Vendreo_Gateway_Blocks);
        }
    );
}

?>
