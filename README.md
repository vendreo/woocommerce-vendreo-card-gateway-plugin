# WooCommerce Vendreo Card Gateway Plugin

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![PHP 7.2](https://img.shields.io/badge/PHP-7.2-blue.svg)
![Wordpress](https://img.shields.io/badge/wordpress-v6.1.1-green)
![woocommerce](https://img.shields.io/badge/woocommerce-v6.9-green)


### Description
Vendreo's latest payment solution. Accept online payments in your WooCommerce store via the Open Banking API, safe and secure.

### Requirements

To install the Vendreo Payment Gateway plugin, you need:

* WordPress Version 6.1.1 or newer (installed).
* WooCommerce Version 6.9 or newer (installed and activated).
* PHP Version 7.2 or newer.

### Instructions, Setup and Configuration
 
For instructions, setup and configuration information please refer to the WooCommerce Integration guide in your Vendreo Admin area.

---

## Changelog
As documented here [Keep A Change Log](https://keepachangelog.com/en/1.0.0/).

### [1.1.1] - 01-12-2022

#### Added
- 200 response code check.

### [1.1.0] - 01-12-2022

#### Added
- File `LICENSE.txt`.
- Doc blocks to `vendreo-gateway.php` to help improve code readability.
- Class variables to make code more explicit within `vendreo-gateway.php` file.
- Changed `vendreo-gateway.php` file by adding `basket_items` key to POST data (using data from the new `get_basket_details()` method).

#### Changed
- `README.md` updated to contain useful project information such as dependency versions, instructional and the Changelog.
- Updated clearing of basket to be applied only upon successful checkout in `vendreo-gateway.php` file.
- Converted `array()` calls to`[]` in `vendreo-gateway.php` file.
- Altered Curl request in `vendreo-gateway.php` file to match new API endpoint requirements.

#### Removed
- Unnecessary comments and spacing in the `vendreo-gateway.php` file.


### [1.0.2] - 15-06-2022

#### Changed
- relocated `vendreo-gateway.php` to root of project.

#### Removed
- `vendreo` folder from root of project as it was no longer required.


### [1.0.1] - 15-06-2022

#### Changed
- Appended project title to the `README.md` file.

#### Removed
- `vendreo.zip` file, as no longer required.


### [1.0.0] - 14-06-2022

#### Added
- `vendreo.zip` file containing compressed version of the entire project.
- `vendreo` folder to hold the main files.
- `vendreo-gateway.php` main plugin script.
