<?php

class Vendreo_Card_Gateway extends WC_Payment_Gateway
{
    protected $url = 'https://api.vendreo-test.com/v1/request-payment';
    protected $testmode;
    protected $application_key;
    protected $secret_key;

    public function __construct()
    {
        $this->id = 'vendreo_gateway';
        $this->method_title = __('WooCommerce Vendreo Gateway (Card)', 'vendreo-gateway');

        $this->method_description = __('Accept payments via card or bank transfer using Vendreo\'s Payment Gateway.', 'vendreo-gateway');
        $this->icon = 'https://cdn.vendreo.com/images/vendreo-fullcolour.svg';

        $this->supports = ['products'];

        $this->init_form_fields();
        $this->init_settings();

        $this->testmode = 'yes' === $this->get_option('testmode');
        $this->application_key = $this->testmode ? $this->get_option('test_application_key') : $this->get_option('application_key');
        $this->secret_key = $this->testmode ? $this->get_option('test_secret_key') : $this->get_option('secret_key');

        add_action('woocommerce_api_card_callback', [$this, 'callback_handler']);
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    public function init_form_fields()
    {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'label' => 'Enable Vendreo Card Gateway',
                'type' => 'checkbox',
                'description' => '',
                'default' => 'no'
            ],
            'title' => [
                'title' => 'Title',
                'type' => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default' => 'Vendreo Card Payments',
                'desc_tip' => true,
            ],
            'description' => [
                'title' => 'Description',
                'type' => 'textarea',
                'description' => 'This controls the description which the user sees during checkout.',
                'default' => 'Pay safe and secure using your card.',
            ],
            'testmode' => [
                'title' => 'Test mode',
                'label' => 'Enable Test Mode',
                'type' => 'checkbox',
                'description' => 'Place the payment gateway in test mode using test API keys.',
                'default' => 'yes',
                'desc_tip' => true,
            ],
            'test_application_key' => [
                'title' => 'Test Application Key',
                'type' => 'text'
            ],
            'test_secret_key' => [
                'title' => 'Test Secret Key',
                'type' => 'password',
            ],
            'application_key' => [
                'title' => 'Live Application Key',
                'type' => 'text'
            ],
            'secret_key' => [
                'title' => 'Live Secret Key',
                'type' => 'password'
            ],
        ];
    }

    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);

        $order->update_status('pending-payment', __('Awaiting Vendreo Card Payment', 'wc-card-gateway-vendreo'));

        $post = [
            'application_key' => $this->application_key,
            'amount' => (int)($order->get_total() * 100),
            'currency' => 'GBP',
            "description" => "Order #{$order_id}",
            'payment_type' => 'dynamic-one-off',
            "redirect_url" => $this->get_return_url($order),
            'failed_url' => $this->get_cancelled_url(),
            "reference_id" => $order_id,
            "basket_items" => $this->get_basket_details(),
            'order_reference' => 'TM-ORDER_#' . $order_id,
            'mandate_3ds_challenge' => true,
            'enable_address_field' => true,
            'customer_billing_email' => $order->get_billing_email(),
            'customer_billing_address' => $order->get_billing_address_1(),
            'customer_billing_town' => $order->get_billing_city(),
            'customer_billing_post_code' => $order->get_billing_postcode(),
            'country_code' => 'GB',
        ];

        header('Content-Type: application/json');
        $ch = curl_init($this->url);
        $authorization = "Authorization: Bearer " . $this->secret_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json', $authorization]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($responseCode <> 200 || !$result) {
            return false;
        }

        $result = json_decode($result);

        return [
            'result' => 'success',
            'redirect' => $result->redirect_url
        ];
    }

    public function get_cancelled_url()
    {
        return wc_get_checkout_url();
    }

    /**
     * Returns itemised basket details.
     *
     * @return array[]
     */
    public function get_basket_details(): array
    {
        $basket = [];

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];

            $basket[] = [
                'description' => $product->get_name(),
                'quantity' => $cart_item['quantity'],
                'price' => (int)($product->get_price() * 100),
                'total' => (int)(($product->get_price() * 100) * $cart_item['quantity']),
            ];
        }

        return $basket;
    }

    public function callback_handler()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $order = wc_get_order($data->reference_id);

        if ($data->act == 'card_payment_completed') {
            $order->payment_complete();
            wc_reduce_stock_levels($order->get_id());
        }
    }
}
