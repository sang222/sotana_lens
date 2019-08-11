<?php

namespace Premmerce\Premmerce\Data;

class Tasks
{
    const  TYPE_DEFAULT = 'default' ;
    const  TYPE_AUTO = 'auto' ;
    const  TYPE_PREMIUM = 'premium' ;
    const  STATE_CHECKED = 'checked' ;
    const  STATE_SKIPPED = 'skipped' ;
    const  STATE_DEFAULT = 'todo' ;
    const  MAGIC_INSTALL_PLUGIN = 'install_plugin_' ;
    const  MAGIC_INSTALL_THEME = 'install_theme_' ;
    public static function getAll()
    {
        $tasks = self::getFree();
        return $tasks;
    }
    
    /**
     * @return array
     */
    private static function getFree()
    {
        $tasks = array();
        $isImageCMS = in_array( get_user_locale(), array(
            'ru',
            'ru_RU',
            'uk',
            'uk_UA'
        ) );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'woocommerce'] = array(
            'title'       => __( 'WooCommerce Installation', 'premmerce' ),
            'description' => __( 'WooCommerce is a basic platform for your future store, one of the most popular on the web. After activation WooCommerce will suggest using the WooCommerce Onboarding Wizard which you can either use or skip and continue settings with the Premmerce Setup Wizard.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#wooinstall', 'premmerce' ),
        ) ),
        );
        $tasks['create_wordpress_basic_pages'] = array(
            'title'       => __( 'Creating the basic default WordPress pages', 'premmerce' ),
            'description' => __( 'In order to proceed with further interface settings, the Front Page, Blog and Contact pages have to be created.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Create', 'premmerce' ),
            'link'  => admin_url( 'edit.php?post_type=page' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#hpsett', 'premmerce' ),
        ) ),
        );
        $tasks['create_woocommerce_default_pages'] = array(
            'title'       => __( 'Creating the WooCommerce default pages', 'premmerce' ),
            'description' => __( 'In some cases if you skip the WooCommerce Onboarding Wizard, the essential default pages may not be created automatically. In order to create them, go to the Status section, select Create default WooCommerce pages on the Tools tab and click  Create.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Create', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wc-status&tab=tools' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#skipped', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_THEME . 'storefront'] = array(
            'title'       => __( 'Storefront, the basic WooCommerce theme installation', 'premmerce' ),
            'description' => __( 'For a better visualization set Storefront, the bulletproof theme created by the WordPress core developers.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
        );
        
        if ( !$isImageCMS ) {
            $tasks[self::MAGIC_INSTALL_THEME . 'storefront']['description'] .= ' ' . __( 'You can skip this step and move on to installing the SalesZone Free straight away.' );
            $tasks[self::MAGIC_INSTALL_THEME . 'saleszone'] = array(
                'title'       => __( 'SalesZone - Free WooCommerce Theme Installation', 'premmerce' ),
                'description' => __( 'You can also use our free WooCommerce SalesZone Theme that  provides you with a demo data installer and an easy-to-use configuration manager.', 'premmerce' ),
                'type'        => self::TYPE_AUTO,
                'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
                'links'       => array( array(
                'link'  => __( 'https://premmerce.com/saleszone-woocommerce-theme/', 'premmerce' ),
                'label' => __( 'Details', 'premmerce' ),
            ) ),
            );
        }
        
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo'] = array(
            'title'       => __( 'Yoast SEO Installation', 'premmerce' ),
            'description' => __( 'Yoast SEO is an obligatory plugin if you want your store products to be easily found on the search engines by your customers.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'woo-seo-addon'] = array(
            'title'       => __( 'WooCommerce SEO Addon Installation', 'premmerce' ),
            'description' => __( 'This plugin provides additional SEO capabilities that are not available in the basic Yoast SEO.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce', self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-seo-addon-yoast/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'woo-permalink-manager'] = array(
            'title'       => __( 'WooCommerce Permalink Manager Installation', 'premmerce' ),
            'description' => __( 'This plugin is used for your store\'s URL settings fine-tuning.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-permalink-manager-remove-shop-product-product-category-url/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'google-analytics-dashboard-for-wp'] = array(
            'title'       => __( 'Google Analytics Dashboard Installation for WordPress', 'premmerce' ),
            'description' => __( 'Basic Google Analytics settings and interactive widget for Dashboard.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-google-analytics-integration-plugins/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'woocommerce-google-analytics-integration'] = array(
            'title'       => __( 'WooCommerce Google Analytics Integration Plugin Installation', 'premmerce' ),
            'description' => __( 'Additional plugin for sending ecommerce data to Google Analytics account.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce', self::MAGIC_INSTALL_PLUGIN . 'google-analytics-dashboard-for-wp' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-google-analytics-integration-plugins/', 'premmerce' ),
        ) ),
        );
        $tasks['ssl_certificate'] = array(
            'title'       => __( 'SSL Certificate Purchase', 'premmerce' ),
            'description' => __( 'We highly recommend you to buy the SSL certificate from your hosting provider or another SSL provider and then install it on your site for better SEO rankings and user experience.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
        );
        $tasks['setup_options_general'] = array(
            'title'       => __( 'WordPress Basic Settings', 'premmerce' ),
            'description' => __( 'Adjust the following fields: Site Title, Tagline, WordPress Address (URL), Site Address (URL), Email Address, Site Language, Timezone', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'options-general.php' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#basic_wordpress_settings', 'premmerce' ),
        ) ),
        );
        $tasks['setup_reading'] = array(
            'title'       => __( 'Reading Settings', 'premmerce' ),
            'description' => __( 'Change the displayed by default  "Your Latest Posts" to a more easy-to-use setting " A Static Page" and select the default pages created earlier.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'options-reading.php' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#readsett', 'premmerce' ),
        ) ),
        );
        $tasks['setup_permalinks'] = array(
            'title'       => __( 'Permalinks Settings', 'premmerce' ),
            'description' => __( 'We recommend that you remove the unnecessary slag from your store’s URL and make it more concise and readable. To do this you need to adjust the following settings in Permaink Manager: select "Remove base"(from the category), "Remove base"(from the product) and leave Remove parent slugs without changes.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woo-permalink-manager' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=premmerce-url-manager-admin' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#permalinks_settings', 'premmerce' ),
        ) ),
        );
        $tasks['setup_woocommerce_base'] = array(
            'title'       => __( 'WooCommerce Basic Settings', 'premmerce' ),
            'description' => __( 'Adjust the following fields: Address line 1, Address line 2, City, Country / State, Postcode / ZIP, Currency and Check Enable taxes(Only if your store will use automatic tax calculations).', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wc-settings' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#basic_woocommerce_settings', 'premmerce' ),
        ) ),
        );
        $tasks['setup_shipping'] = array(
            'title'       => __( 'The Shipping Tab Settings', 'premmerce' ),
            'description' => __( 'On this tab you can make shipping options  and shipping zones settings.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wc-settings&tab=shipping' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-shipping-guide-zones-classes-calculator-labels/', 'premmerce' ),
        ) ),
        );
        $tasks['setup_checkout'] = array(
            'title'       => __( 'The Checkout Tab Settings', 'premmerce' ),
            'description' => __( 'Here you can setup your checkout process and select all payment options that would be used in the store.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wc-settings&tab=checkout' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://docs.woocommerce.com/documentation/plugins/woocommerce/getting-started/sell-products/core-payment-options/', 'premmerce' ),
        ) ),
        );
        $tasks['setup_emails'] = array(
            'title'       => __( 'The Emails Tab Settings', 'premmerce' ),
            'description' => __( 'Adjust the following fields:  "From" name, "From" address, Header image, Footer text.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wc-settings&tab=email' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#emails_tab', 'premmerce' ),
        ) ),
        );
        $tasks['setup_yoast_company_info'] = array(
            'title'       => __( 'Filling in the Company info field', 'premmerce' ),
            'description' => __( 'In the Company or person field select “Company” and fill all the fields below.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wpseo_titles' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#fill_company_info', 'premmerce' ),
        ) ),
        );
        $tasks['setup_yoast_webmaster_tools'] = array(
            'title'       => __( 'Adding the information to Google Webmaster Tools', 'premmerce' ),
            'description' => __( 'It\'s important to set Google Webmaster Tools, Yandex and  Bing if they are used', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wpseo_dashboard#top#webmaster-tools' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#webmaster_tools', 'premmerce' ),
        ) ),
        );
        $tasks['setup_yoast_social'] = array(
            'title'       => __( 'The Social page settings', 'premmerce' ),
            'description' => __( 'On the Accounts tab fill in all information about all social networks that are used by the store.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wpseo_social' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#social_page', 'premmerce' ),
        ) ),
        );
        $tasks['setup_yoast_search_console'] = array(
            'title'       => __( 'The Yoast Search Console Authorization', 'premmerce' ),
            'description' => __( 'There\'s an option to authorise Yoast SEO and your Google Webmaster console. After authorization the information about all pages 404 would be displayed on this page.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wpseo_search_console&tab=settings' ),
        ) ),
        );
        $tasks['setup_woo_seo_addon'] = array(
            'title'       => __( 'The WooCommerce SEO Addon settings', 'premmerce' ),
            'description' => __( 'Adjust the following fields: Brand, Address, Email, Phone, Opening hours, Payment Accepted', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woo-seo-addon' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=premmerce_seo' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#seo_addon', 'premmerce' ),
        ) ),
        );
        $tasks['ga_account'] = array(
            'title'       => __( 'The Google Analytics Account settings', 'premmerce' ),
            'description' => __( 'Get registered in Google Analytics and make all the necessary settings in your Google Analytics Account.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-google-analytics-integration-plugins/#google_settings', 'premmerce' ),
        ) ),
        );
        $tasks['setup_gadash_auth'] = array(
            'title'       => __( 'Authorising the Google Analytics Dashboard for WP', 'premmerce' ),
            'description' => __( 'Get authozised in order to use all pluging settings available.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'google-analytics-dashboard-for-wp' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=gadwp_settings' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-google-analytics-integration-plugins/#gadwp', 'premmerce' ),
        ) ),
        );
        $tasks['ga_ecomerce_tracking'] = array(
            'title'       => __( 'Enabling  the Ecommerce Tracking: Enhanced Ecommerce Plugin', 'premmerce' ),
            'description' => __( 'Go to Integration Tab and select in the "Ecommerce Tracking" field "Enhanced Ecommerce Plugin" option.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'google-analytics-dashboard-for-wp', self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Enable', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=gadwp_tracking_settings#top#gadwp-integration' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-google-analytics-integration-plugins/#enhanced', 'premmerce' ),
        ) ),
        );
        $tasks['setup_woo_ga'] = array(
            'title'       => __( 'WooCommerce Google Analytics Integration Plugin settings', 'premmerce' ),
            'description' => __( 'Enter your Google Analytics ID, Enable Standard Tracking - uncheck, "Display Advertising" Support - uncheck, Use Enhanced Link Attribution - uncheck, Enable Universal Analytics - check, Anonymize IP addresses - check, Track 404 (Not found) Errors - check,  Purchase Transactions - check, Add to Cart Events - check, Enable Enhanced eCommerce - check and all other checkboxes, that appered after Enable Enhanced eCommerce - check too.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'google-analytics-dashboard-for-wp', self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=wc-settings&tab=integration' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-google-analytics-integration-plugins/#woocommerce', 'premmerce' ),
        ) ),
        );
        $tasks['select_theme'] = array(
            'title'       => __( 'Selecting and setting up a theme', 'premmerce' ),
            'description' => __( 'Select a new theme or use Storefront by default.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Select', 'premmerce' ),
            'link'  => admin_url( 'themes.php' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#install_theme', 'premmerce' ),
        ) ),
        );
        if ( !$isImageCMS ) {
            $tasks['select_theme']['description'] = __( 'Select a new theme or use SalesZone Free by default.', 'premmerce' );
        }
        $tasks['customize_theme'] = array(
            'title'       => __( 'Customise all elements of your store by using the customiser.', 'premmerce' ),
            'description' => __( 'Customise the selected theme to your needs', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Customize', 'premmerce' ),
            'link'  => admin_url( 'customize.php' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#customizer', 'premmerce' ),
        ) ),
        );
        $tasks['setup_menu_basic'] = array(
            'title'       => __( 'The basic menu settings', 'premmerce' ),
            'description' => __( 'Create a new menu with the menu points that your store needed and then assign it to one of the menu location that your theme supports.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'nav-menus.php' ),
        ) ),
        );
        $tasks['setup_home_page'] = array(
            'title'       => __( 'The Homepage settings', 'premmerce' ),
            'description' => __( 'Make all SEO settings for the Front Page (Homepage) with the help of Yoast SEO Meta Tags and change description if you need it.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'edit.php?post_type=page' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#front_page', 'premmerce' ),
        ) ),
        );
        $tasks['setup_shop_page'] = array(
            'title'       => __( 'Shop Page SEO Settings', 'premmerce' ),
            'description' => __( 'Make all SEO settings for the Shop Page with the help of Yoast SEO Meta Tags or adjust the canonical URL to the home page.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'wordpress-seo' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'edit.php?post_type=page' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#shop_page', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'contact-form-7'] = array(
            'title'       => __( 'Contact Form 7 Installation', 'premmerce' ),
            'description' => __( 'It\'s used to display the online feedback form on the Contact page.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
        );
        $tasks['setup_cf7_shortcode'] = array(
            'title'       => __( 'Placement of the Contact Form 7 shortcode on the Contact page.', 'premmerce' ),
            'description' => __( 'You can add Contact Form 7 shortcode to any page you need, but we recommend that you use it  for Contact Page, that you have created earlier.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'contact-form-7' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'edit.php?post_type=page' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#contact', 'premmerce' ),
        ) ),
        );
        $tasks['create_categories'] = array(
            'title'       => __( 'Creating the necessary product categories', 'premmerce' ),
            'description' => __( 'It\'s recommended that you add all necessary categories for a better catalog navigation.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Create', 'premmerce' ),
            'link'  => admin_url( 'edit-tags.php?taxonomy=product_cat&post_type=product' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#product_categories', 'premmerce' ),
        ) ),
        );
        $tasks['create_attributes'] = array(
            'title'       => __( 'Creating the product attributes', 'premmerce' ),
            'description' => __( 'Product attributes are needed for the flexible filtering and extended search of products by the set attributes.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Create', 'premmerce' ),
            'link'  => admin_url( 'edit.php?post_type=product&page=product_attributes' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#product_att', 'premmerce' ),
        ) ),
        );
        $tasks['create_products'] = array(
            'title'       => __( 'Adding products and deleting the sample data', 'premmerce' ),
            'description' => __( 'The store products are managed from the Product page. If you are using the sample  data - it\'s time to delete it and add your own products.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Create', 'premmerce' ),
            'link'  => admin_url( 'edit.php?post_type=product' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/complete-woocommerce-tutorial-step-step/#products', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-search'] = array(
            'title'       => __( 'Premmerce Search Installation', 'premmerce' ),
            'description' => __( 'This plugin performs two functions at a time: it replaces  the standart WooCommerce search for the Live Search  and searches for the items which have been misspelled.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-product-search/', 'premmerce' ),
        ) ),
        );
        $tasks['setup_premmerce_search_indexes'] = array(
            'title'       => __( 'Update Premmerce Search Indexes', 'premmerce' ),
            'description' => __( 'We recommend that you update the indexes after any products list changes to improve search results.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'premmerce-search' ),
            'links'       => array( array(
            'label' => __( 'Update', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=premmerce-search-admin' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-product-search/#settings', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-product-filter'] = array(
            'title'       => __( 'Premmerce WooCommerce Product Filter Installation', 'premmerce' ),
            'description' => __( 'This plugin upgrades the standart WooCommerce filtering to a new level  and adds some new options such as search results filtering, etc. ', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-product-filter/', 'premmerce' ),
        ) ),
        );
        $tasks['setup_premmerce-woocommerce-product-filter'] = array(
            'title'       => __( 'Make all you need to make filters visible', 'premmerce' ),
            'description' => __( 'Manage Premmerce WooCommerce Product Filter Setting and set to display all attributes, you need to show in filter.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-product-filter' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=premmerce-filter-admin' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-product-filter/#managing', 'premmerce' ),
        ) ),
        );
        $tasks['setup_widget_premmerce-woocommerce-product-filter'] = array(
            'title'       => __( 'Add Premmerce Filter Widget to Sidebar', 'premmerce' ),
            'description' => __( 'The filter for all product attributes, which can be selected in the settings, is added to the store page with the help of  Premmerce Filter widget. It is displayed as a regular WordPress widget via the Widgets page in the admin menu.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-product-filter' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'widgets.php' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-product-filter/#displaying', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-brands'] = array(
            'title'       => __( 'Premmerce WooCommerce Brands Installation', 'premmerce' ),
            'description' => __( 'This plugin is highly convenient if your products\' using different brands, so it will improve your site usability and product search.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/premmerce-woocommerce-brands-free-plugin/', 'premmerce' ),
        ) ),
        );
        $tasks['setup_brands_premmerce-woocommerce-product-filter'] = array(
            'title'       => __( 'Display Brands on Product Filter', 'premmerce' ),
            'description' => __( 'Set brands to display on Attribute tab on the WooCommerce filter and then set to display all brands that you need on your store filter.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-brands', self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-product-filter' ),
            'links'       => array( array(
            'label' => __( 'Set up', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=premmerce-filter-admin&tab=product_brand' ),
        ), array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-product-filter/#integration', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'woo-customers-manager'] = array(
            'title'       => __( 'WooCommerce Customers Manager Installation', 'premmerce' ),
            'description' => __( 'This plugin contributes to the informative aspect of customer management, such filtering users by the registration date, the amount of money spent in the store, displays the order history on the customer page.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-customers-manager/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-user-roles'] = array(
            'title'       => __( 'Premmerce User Roles Plugin Installation', 'premmerce' ),
            'description' => __( 'The Premmerce User Roles Plugin would help you to create the new groups of users  in a way that best suits your business model.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/wordpress-custom-user-roles/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-wishlist'] = array(
            'title'       => __( 'Premmerce WooCommerce Wishlist Installation', 'premmerce' ),
            'description' => __( 'This plugin provides the possibility for your customers to create wishlists with the further possibility to share them with friends.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-wishlist/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-redirect-manager'] = array(
            'title'       => __( 'Premmerce WooCommerce Redirect Manager Installation', 'premmerce' ),
            'description' => __( 'The Premmerce Redirect Manager enables you to create 301 and 302 redirects and to set up the automatic redirects for the deleted products in the WooCommerce store.', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-redirect-manager/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-wholesale-pricing'] = array(
            'title'       => __( 'Premmerce WooCommerce Wholesale Pricing Installation', 'premmerce' ),
            'description' => __( 'The Premmerce WooCommerce Wholesale Pricing is a plugin that allows you to add individual wholesale prices or other prices types for WooCommerce products for any customers’ roles.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/premmerce-woocommerce-wholesale-pricing/', 'premmerce' ),
        ) ),
        );
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'premmerce-woocommerce-product-bundles'] = array(
            'title'       => __( 'Woocommerce Frequently Bought Together Installation', 'premmerce' ),
            'description' => __( 'This plugin is used to add bundles of products with discounts and to display them as a list on a  product page.', 'premmerce' ),
            'depends'     => array( self::MAGIC_INSTALL_PLUGIN . 'woocommerce' ),
            'type'        => self::TYPE_AUTO,
            'links'       => array( array(
            'label' => __( 'Details', 'premmerce' ),
            'link'  => __( 'https://premmerce.com/woocommerce-frequently-bought-together/', 'premmerce' ),
        ) ),
        );
        $tasks['enable_transliteration'] = array(
            'title'       => __( 'Turn on the transliteration settings if your store does not use English.', 'premmerce' ),
            'description' => __( 'It\'s recommended that you use transliteration in your URLs to avoid any further errors.', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Turn on', 'premmerce' ),
            'link'  => admin_url( 'admin.php?page=premmerce&tab=settings' ),
        ) ),
        );
        $tasks['rate_us'] = array(
            'title'       => __( 'Please Rate Us', 'premmerce' ),
            'description' => __( 'If you like our wizard and it has really helped you to make a full store setup, please rate us on WordPress.org directory', 'premmerce' ),
            'type'        => self::TYPE_DEFAULT,
            'links'       => array( array(
            'label' => __( 'Rate Us', 'premmerce' ),
            'link'  => __( 'https://wordpress.org/plugins/premmerce/#reviews', 'premmerce' ),
        ) ),
        );
        return $tasks;
    }
    
    public static function getPremium()
    {
        $tasks = array();
        $tasks[self::MAGIC_INSTALL_PLUGIN . 'wp-rocket'] = array(
            'title'       => __( 'Install and Setup Cache', 'premmerce' ),
            'description' => __( 'This feature will install the cache system based on WP Rocket on your store and setup the best settings to improve total speed of your WooCommerce store', 'premmerce' ),
            'type'        => self::TYPE_AUTO,
        );
        return $tasks;
    }

}