<?php

namespace Premmerce\Premmerce\Data;

class Plugins
{
    /**
     * @return array
     */
    public static function getAll()
    {
        $plugins = array();
        $plugins['woocommerce'] = array(
            'name'   => 'WooCommerce',
            'plugin' => 'woocommerce.php',
        );
        $plugins['wordpress-seo'] = array(
            'name'   => 'Yoast SEO',
            'plugin' => 'wp-seo.php',
        );
        $plugins['contact-form-7'] = array(
            'name'   => 'Contact Form 7',
            'plugin' => 'wp-contact-form-7.php',
        );
        $plugins['premmerce-search'] = array(
            'name'   => 'Premmerce Search',
            'plugin' => 'premmerce-search.php',
        );
        $plugins['premmerce-user-roles'] = array(
            'name'   => 'Premmerce User Roles',
            'plugin' => 'premmerce-users-roles.php',
        );
        $plugins['premmerce-woocommerce-brands'] = array(
            'name'   => 'Premmerce WooCommerce Brands',
            'plugin' => 'premmerce-brands.php',
        );
        $plugins['premmerce-woocommerce-product-filter'] = array(
            'name'   => 'Premmerce WooCommerce Product Filter',
            'plugin' => 'premmerce-filter.php',
        );
        $plugins['woo-customers-manager'] = array(
            'name'   => 'WooCommerce Customers Manager',
            'plugin' => 'premmerce-extended-users.php',
        );
        $plugins['woo-permalink-manager'] = array(
            'name'   => 'WooCommerce Permalink Manager',
            'plugin' => 'premmerce-url-manager.php',
        );
        $plugins['woo-seo-addon'] = array(
            'name'   => 'WooCommerce SEO Addon',
            'plugin' => 'premmerce-seo-addon.php',
        );
        $plugins['premmerce-woocommerce-wishlist'] = array(
            'name'   => 'Premmerce WooCommerce Wishlist',
            'plugin' => 'premmerce-wishlist.php',
        );
        $plugins['premmerce-redirect-manager'] = array(
            'name'   => 'Premmerce Redirect Manager',
            'plugin' => 'premmerce-redirect.php',
        );
        $plugins['premmerce-woocommerce-wholesale-pricing'] = array(
            'name'   => 'Premmerce Woocommerce Wholesale Pricing',
            'plugin' => 'premmerce-price-types.php',
        );
        $plugins['premmerce-woocommerce-product-bundles'] = array(
            'name'   => 'Woocommerce Frequently Bought Together',
            'plugin' => 'premmerce-product-bundles.php',
        );
        $plugins['google-analytics-dashboard-for-wp'] = array(
            'name'   => 'Google Analytics Dashboard',
            'plugin' => 'gadwp.php.php',
        );
        $plugins['woocommerce-google-analytics-integration'] = array(
            'name'   => 'WooCommerce Google Analytics Integration',
            'plugin' => 'woocommerce-google-analytics-integration.php',
        );
        $plugins['ml-slider'] = array(
            'name'   => 'MetaSlider',
            'plugin' => 'ml-slider.php',
        );
        return $plugins;
    }
    
    /**
     * @param $slug
     *
     * @return bool
     */
    public static function exists( $slug )
    {
        return array_key_exists( $slug, self::getAll() );
    }
    
    /**
     * @param $slug
     *
     * @return mixed
     */
    public static function get( $slug )
    {
        if ( self::exists( $slug ) ) {
            return self::getAll()[$slug];
        }
    }
    
    /**
     * @param $slug
     *
     * @return null|string
     */
    public static function getPath( $slug )
    {
        if ( $plugin = self::get( $slug ) ) {
            return ( isset( $plugin['link'] ) ? 'extra/' . $plugin['link'] : null );
        }
    }

}