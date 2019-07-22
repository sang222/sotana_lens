<?php namespace Premmerce\Redirect;

use Premmerce\Redirect\Admin\Admin;
use Premmerce\SDK\V2\FileManager\FileManager;

/**
 * Class RedirectPlugin
 * @package Premmerce\Redirect
 */
class RedirectPlugin
{
    const DOMAIN = 'premmerce-redirect';

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var RedirectModel
     */
    private $model;

    /**
     * PremmerceRedirectPlugin constructor.
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->fileManager = new FileManager($file);
        $this->model       = new RedirectModel();
        $this->registerHooks();
    }

    /**
     * Register plugin hooks
     */
    private function registerHooks()
    {
        add_action('init', array($this, 'useRedirect'));
        add_action('init', array($this, 'loadTextDomain'));
    }

    /**
     * Run plugin part
     */
    public function run()
    {
        if (is_admin()) {
            new Admin($this->fileManager, $this->model);
        }
    }

    /**
     * Fired when the plugin is activated
     */
    public function activate()
    {
        $this->model->createTable();
    }

    /**
     * Redirect to another page from DB
     */
    public function useRedirect()
    {
        $uri = rtrim($_SERVER['REQUEST_URI'], '/');

        $redirect = $this->model->getOneRedirectByOldUrl($uri);

        if ($redirect) {
            $url = null;

            switch ($redirect->redirect_type) {
                case 'url':
                    $url = $redirect->redirect_content;
                    break;

                case 'product':
                    if (is_plugin_active('woocommerce/woocommerce.php')) {
                        $url = get_permalink($redirect->redirect_content);
                    }
                    break;

                case 'product_category':
                    if (is_plugin_active('woocommerce/woocommerce.php')) {
                        $url = get_term_link((int)$redirect->redirect_content, 'product_cat');
                    }
                    break;

                case 'category':
                    $url = get_term_link((int)$redirect->redirect_content, 'category');
                    break;

                case 'post':
                    $url = get_permalink($redirect->redirect_content);
                    break;

                case 'page':
                    $url = get_permalink($redirect->redirect_content);
                    break;
            }

            if ($url) {
                wp_redirect($url, $redirect->type);
                exit;
            }
        }
    }

    /**
     * Fired during plugin uninstall
     */
    public static function uninstall()
    {
        $model = new RedirectModel();
        $model->deleteTable();

        delete_option('premmerce_redirect_items_per_page');
        delete_option('premmerce_redirect_change_status_product');
        delete_option('premmerce_redirect_delete_product');
    }

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
        load_plugin_textdomain(self::DOMAIN, false, $name . '/languages/');
    }
}
