# WooCommerce Vendreo Card Gateway Plugin

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![PHP 7.2](https://img.shields.io/badge/PHP-7.2-blue.svg)
![Wordpress](https://img.shields.io/badge/wordpress-v6.1.1-green)
![woocommerce](https://img.shields.io/badge/woocommerce-v6.9-green)


### Description
Vendreo's latest payment solution. Accept online card payments in your WooCommerce store safely and securely.

### Requirements

To install the Vendreo Card Gateway plugin, you need:

* WordPress Version 6.1.1 or newer (installed).
* WooCommerce Version 6.9 or newer (installed and activated).
* PHP Version 7.2 or newer.

### Instructions, Setup and Configuration
 
For instructions, setup and configuration information please refer to the WooCommerce Integration guide in your Vendreo Admin area.


## Note

## Orders not being marked as Processing?
Firstly, check that the callback endpoint is working as expected by visiting `https://your-site.com/wc-api/card_callback` in a browser. You should see `-1` shown.
If not, this can be caused by permalinks adding a slash to the end of the url. 

Try resolving this by:

1. In the WordPress admin visit `Settings / Permalinks`.
2. Select `Day and name` under `Permalink structure` being sure to hit save.

---

## Changelog
As documented here [Keep A Change Log](https://keepachangelog.com/en/1.0.0/).


blocks fix
