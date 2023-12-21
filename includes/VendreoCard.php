<?php

namespace Automattic\WooCommerce\Blocks\Payments\Integrations;

use Automattic\WooCommerce\Blocks\Assets\Api;

/**
 * Cheque payment method integration
 *
 * @since 2.6.0
 */
final class VendreoCard extends AbstractPaymentMethodType {
    /**
     * Payment method name defined by payment methods extending this class.
     *
     * @var string
     */
    protected $name = 'vendreo-card-woocommerce';

    /**
     * Settings from the WP options table
     *
     * @var array
     */
    protected $settings;

    public function __construct() {
    }

    /**
     * Initializes the payment method type.
     */
    public function initialize() {
        $this->settings = get_option( 'woocommerce_vendreo_card_settings', [] );
    }

    /**
     * Returns if this payment method should be active. If false, the scripts will not be enqueued.
     *
     * @return boolean
     */
    public function is_active() {
        return true;
        return filter_var( $this->get_setting( 'enabled', false ), FILTER_VALIDATE_BOOLEAN );
    }

    public function get_payment_method_script_handles() {

        wp_register_script(
            'wc-vendreo-card-payment-method',
            plugins_url( 'wc-vendreo-card-payment-method.js', __FILE__ ),
            [],
            1.0,
            false
        );

        return [ 'wc-vendreo-card-payment-method' ];
    }

    /**
     * Returns an array of key=>value pairs of data made available to the payment methods script.
     *
     * @return array
     */
    public function get_payment_method_data() {
        return [
            'title'       => $this->get_setting( 'title' ),
            'description' => $this->get_setting( 'description' ),
//            'supports'    => $this->get_supported_features(),
        ];
    }
}
