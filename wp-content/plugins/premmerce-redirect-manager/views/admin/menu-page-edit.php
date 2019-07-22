<?php
if(!defined('ABSPATH')){
	exit;
}
?>
<div class="wrap">
    <h2><?php _e('Edit redirect', 'premmerce-redirect'); ?></h2>

    <?php if ($errorMessage): ?>
        <div class="notice notice-error is-dismissible">
            <p>
                <?= $errorMessage; ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div id="message" class="updated">
            <p>
                <strong><?= $successMessage; ?></strong>
            </p>
            <p>
                <a href="<?= menu_page_url('premmerce_redirect', false) ?>">
                    <?= '← ' . __('Back to Premmerce Redirect Manager', 'premmerce-redirect'); ?>
                </a>
            </p>
        </div>
    <?php endif; ?>

    <form id="edittag" method="post" class="validate">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= $redirect->id; ?>">
        <table class="form-table">
            <tr class="form-field">
                <th scope="row"><label for="old_url"><?php _e('Source URL', 'premmerce-redirect'); ?></label></th>
                <td>
                    <div class="site_url_block">
                        <code><?= get_site_url(); ?></code>

                        <input type="text" id="old_url" name="old_url" class="resource_url" size="40" value="<?= $redirect->old_url; ?>">
                    </div>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><label for="redirect_type"><?php _e('Type of target URL', 'premmerce-redirect'); ?></label></th>
                <td>
                    <select id="redirect_type" name="redirect_type">
                        <option value="url" <?php selected($redirect->redirect_type == 'url') ?>>
                            <?php _e('URL', 'premmerce-redirect'); ?>
                        </option>

                        <option value="page" <?php selected($redirect->redirect_type == 'page') ?>>
                            <?php _e('Page', 'premmerce-redirect'); ?>
                        </option>

                        <option value="post" <?php selected($redirect->redirect_type == 'post') ?>>
                            <?php _e('Post', 'premmerce-redirect'); ?>
                        </option>

                        <option value="category" <?php selected($redirect->redirect_type == 'category') ?>>
                            <?php _e('Post category', 'premmerce-redirect'); ?>
                        </option>

                        <?php if (is_plugin_active('woocommerce/woocommerce.php')) : ?>
                            <option value="product" <?php selected($redirect->redirect_type == 'product') ?>>
                                <?php _e('Product', 'premmerce-redirect'); ?>
                            </option>

                            <option value="product_category" <?php selected($redirect->redirect_type == 'product_category') ?>>
                                <?php _e('Product category', 'premmerce-redirect'); ?>
                            </option>
                        <?php endif; ?>

                    </select>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><?php _e('HTTP response status code', 'premmerce-redirect'); ?></th>
                <td>
                    <input type="radio" name="redirect_method" value="301" <?php checked($redirect->type == '301') ?>>301
                    <input type="radio" name="redirect_method" value="302" <?php checked($redirect->type == '302') ?>>302
                </td>
            </tr>
            <tr data-type="redirect_url" class="redirect_data form-field" <?= ($redirect->redirect_type != 'url') ?: 'style="display: table-row"'; ?>>
                <th scope="row">
                    <label for="url_content"><?php _e('URL', 'premmerce-redirect'); ?></label>
                </th>
                <td>
                    <input type="text"
                           id="url_content"
                           name="url_content"
                           value="<?= ($redirect->redirect_type != 'url') ?: $redirect->redirect_content; ?>"
                    >
                </td>
            </tr>

            <?php if (is_plugin_active('woocommerce/woocommerce.php')) : ?>
            <tr data-type="redirect_product" class="redirect_data form-field" <?= ($redirect->redirect_type != 'product') ?: 'style="display: table-row"'; ?>>
                <th scope="row"><label><?php _e('Product', 'premmerce-redirect'); ?></label></th>
                <td>
                    <select data-type-select="redirect_product" name="product_content">
                        <?php if ($redirect->redirect_type == 'product') : ?>

                        <option value="<?= $redirect->redirect_content; ?>"><?= get_the_title($redirect->redirect_content); ?></option>

                        <?php else: ?>

                        <option value=""><?php _e('Select product', 'premmerce-redirect'); ?></option>

                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr data-type="redirect_product_category" class="redirect_data form-field" <?= ($redirect->redirect_type != 'product_category') ?: 'style="display: table-row"'; ?>>
                <th scope="row"><label><?php _e('Product category', 'premmerce-redirect'); ?></label></th>
                <td>
                    <select data-type-select="redirect_product_category" name="product_category_content">
                        <?php if ($redirect->redirect_type == 'product_category') : ?>

                        <option value="<?= $redirect->redirect_content; ?>"><?= get_term($redirect->redirect_content)->name; ?></option>

                        <?php else: ?>

                        <option value=""><?php _e('Select product category', 'premmerce-redirect'); ?></option>

                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <?php endif; ?>

            <tr data-type="redirect_category" class="redirect_data form-field" <?php echo ($redirect->redirect_type != 'category') ?: 'style="display: table-row"'; ?>>
                <th scope="row"><label><?php _e('Post category', 'premmerce-redirect'); ?></label></th>
                <td>
                    <select data-type-select="redirect_category" name="category_content">
                        <?php if ($redirect->redirect_type == 'category') : ?>

                        <option value="<?= $redirect->redirect_content; ?>"><?= get_term($redirect->redirect_content)->name; ?></option>

                        <?php else: ?>

                        <option value=""><?php _e('Select category', 'premmerce-redirect'); ?></option>

                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr data-type="redirect_post" class="redirect_data form-field" <?= ($redirect->redirect_type != 'post') ?: 'style="display: table-row"'; ?>>
                <th scope="row"><label><?php _e('Post'); ?></label></th>
                <td>
                    <select data-type-select="redirect_post" name="post_content">
                        <?php if ($redirect->redirect_type == 'post') : ?>

                        <option value="<?= $redirect->redirect_content; ?>"><?= get_the_title($redirect->redirect_content); ?></option>

                        <?php else: ?>

                        <option value=""><?php _e('Select post', 'premmerce-redirect'); ?></option>

                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr data-type="redirect_page" class="redirect_data form-field" <?= ($redirect->redirect_type != 'page') ?: 'style="display: table-row"'; ?>>
                <th scope="row"><label><?php _e('Page', 'premmerce-redirect'); ?></label></th>
                <td>
                    <select data-type-select="redirect_page" name="page_content">
                        <?php if ($redirect->redirect_type == 'page') : ?>

                        <option value="<?= $redirect->redirect_content; ?>"><?= get_the_title($redirect->redirect_content); ?></option>

                        <?php else: ?>

                        <option value=""><?php _e('Select page', 'premmerce-redirect'); ?></option>

                        <?php endif; ?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="edit-tag-actions">
            <input type="submit" class="button button-primary" value="<?php _e('Update') ?>" />

            <span id="delete-link">
                <a class="delete" data-link="delete" href="<?= admin_url('admin-post.php') . '?action=premmerce_delete_redirect'; ?>&id=<?= $redirect->id ?>"><?php _e('Delete') ?></a>
            </span>
        </div>
    </form>

    <div data-lang-name="api-url" data-lang-value="<?= get_rest_url() ?>"></div>
</div>
<div data-lang-name="confirm-delete" data-lang-value="<?= __("You are about to permanently delete these items from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete."); ?>"></div>
