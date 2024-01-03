<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class Vendreo_Card_Gateway_Blocks extends AbstractPaymentMethodType
{
    private $gateway;

    protected $name = 'vendreo_gateway';

    public function initialize()
    {
        $this->settings = get_option('woocommerce_vendreo_gateway_settings', []);
        $this->gateway = new Vendreo_Card_Gateway();
    }

    public function is_active()
    {
        return $this->gateway->is_available();
    }

    public function get_payment_method_script_handles()
    {
        wp_register_script(
            'vendreo_gateway-blocks-integration',
            plugin_dir_path( dirname( __FILE__ ) ). 'js/checkout.js',
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
                'wp-i18n',
            ],
            null,
            true
        );

        if (function_exists('wp_set_script_translations')) {
            wp_set_script_translations('vendreo_gateway-blocks-integration');
        }

        return ['vendreo_gateway-blocks-integration'];
    }

    public function get_payment_method_data()
    {
        return [
            'title' => $this->gateway->title,
            'description' => $this->gateway->description,
        ];
    }
}
