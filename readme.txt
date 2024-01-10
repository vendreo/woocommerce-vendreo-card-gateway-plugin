=== Woocommerce Vendreo Card Gateway Plugin ===
Contributors: vendreo
Tags: wordpress, wordpress-plugin, woocommerce, visa, payment-gateway, woocommerce-plugin, payment-processing, woocommerce-payment, mastercard
Requires at least: 6.1
Tested up to: 6.4
Stable tag: 1.0.1
Requires PHP: 7.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Vendreo's latest payment solution. Accept card payments online through your WooCommerce store safely and securely.

== Description ==

Vendreo are disrupting the payment processing industry, with a suite of class-leading solutions.

With decades of payments experience, the Vendreo team combine their expertise and points their focus exactly where it needs to be for the online world to benefit.

Vendreo's latest payment solution. Accept card payments online through your WooCommerce store safely and securely.


== Frequently Asked Questions ==

= Why are my orders not being marked as paid? =

Ensure that the callback endpoint is working by visiting `https://your-site.com/wc-api/card_callback` in your browser.
You should see `-1` shown with a 200 response code.

If not, this can be caused by permalinks automatically adding a slash to the end of the url.

Try resolving this by:

1. In the WordPress admin visit `Settings / Permalinks`.
2. Select `Day and name` under `Permalink structure` being sure to hit save.

== Screenshots ==

1. The WooCommerce Vendreo Card Gateway Plugins setting page.

== Changelog ==

= 1.0.1 =
* License changed to GPLv3.
* ReadMe file changes.

= 1.0.0 =
* Card gateway plugin released.

== Upgrade Notice ==
