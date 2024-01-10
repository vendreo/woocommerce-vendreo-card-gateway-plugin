<p align="center">   
    <img src="https://cdn.vendreo.com/images/vendreo-fullcolour.svg" width="270" height="auto">
</p>

# WooCommerce Vendreo Card Gateway Plugin
Tags: wordpress, wordpress-plugin, woocommerce, visa, payment-gateway, woocommerce-plugin, payment-processing, woocommerce-payment, mastercard\
Requires at least WordPress: 6.1.1\
Tested on WordPress up to: 6.4.2\
Requires at least WooCommerce: 6.9\
Tested on WooCommerce up to: 8.4.0\
Tested on PHP: 7.4 & 8.0\
Stable tag: 1.0.1\
License: GPLv3\
License URI: https://www.gnu.org/licenses/gpl-3.0.html

[![License: MIT](https://img.shields.io/badge/license-GPLv3-blue)](https://opensource.org/licenses/GPLv3)
![PHP 7.2](https://img.shields.io/badge/PHP-7.4-blue.svg)
![Wordpress](https://img.shields.io/badge/wordpress-v6.1.1-green)
![woocommerce](https://img.shields.io/badge/woocommerce-v6.9-green)

### Description

Vendreo's latest payment solution. Accept card payments online through your WooCommerce store safely and securely.

### Requirements

To install the WooCommerce Vendreo Card Gateway Plugin, you need:

* WordPress Version 6.1.1 or newer (installed).
* WooCommerce Version 6.9 or newer (installed and activated).
* PHP Version 7.4 or newer.

In order to process payments you will also need a Vendreo account. To get started please visit here. [Vendreo](https://vendreo.com). 

### Instructions, Setup and Configuration

For instructions, setup and configuration information please refer to the `WooCommerce Integration Guide` in your Vendreo
Admin area `https://app.vendreo.com/developer/woocommerce-integration`.


#### Notes:
**Orders not being marked as Processing?**\
Ensure that the callback endpoint is working by visiting `https://your-site.com/wc-api/card_callback` in your browser.
You should see `-1` shown with a 200 response code.

If not, this can be caused by permalinks automatically adding a slash to the end of the url.
Try resolving this by:
1. In the WordPress admin visit `Settings / Permalinks`.
2. Select `Day and name` under `Permalink structure` being sure to hit save.
---

## Changelog

As documented here [Keep A Change Log](https://keepachangelog.com/en/1.0.0/).

### [1.0.1] - 10-01-2024

#### Changed
- License to GPLv3.
- ReadMe file changes.

### [1.0.0] - 04-01-2024

#### Added
- Card gateway plugin released.
