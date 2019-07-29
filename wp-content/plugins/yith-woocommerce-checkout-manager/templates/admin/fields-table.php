<?php
/**
 * Admin View: Fields Table Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div id="ywccp-add-field">
	<h4><?php echo __( 'Add new field', 'yith-woocommerce-checkout-manager' ); ?></h4>
	<label for="add-new-name"><?php _e( 'Enter field name', 'yith-woocommerce-checkout-manager' ); ?></label>
	<input type="text" id="add-new-name" name="add-new-name" value=""/>
	<input type="button" value="<?php _e( 'Add field', 'yith-woocommerce-checkout-manager' ); ?>" id="add-new" class="button" name="add-new">
</div>


<form method="post" id="ywccp_checkout_fields_form">
	<div class="fields_table_bulk_actions">
		<select name="bulk_action" id="bulk_actions_select">
			<option value=""><?php _e( 'Select an action', 'yith-woocommerce-checkout-manager'); ?></option>
			<option value="enable"><?php _e( 'Enable', 'yith-woocommerce-checkout-manager'); ?></option>
			<option value="disable"><?php _e( 'Disable', 'yith-woocommerce-checkout-manager'); ?></option>
		</select>
		<input type="submit" id="ywcc_doaction_bulk" class="button action" value="Apply">
	</div>
	<table id="ywccp_checkout_fields" class="wc_gateways widefat" cellspacing="0" data-prepend="<?php echo $current ?>_">
		<thead>
			<tr>
				<th class="sort is_responsive" style="width:15px;"></th>
				<th class="check-column is_responsive" style="padding-left:0px !important;"><input type="checkbox" style="margin-left:7px;" /></th>
				<th class="name is_responsive"><?php _e( 'Name', 'yith-woocommerce-checkout-manager' ) ?></th>
				<th class="type"><?php _e( 'Type', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="label"><?php _e( 'Label', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="placeholder"><?php _e( 'Placeholder', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="validation-rules"><?php _e( 'Validation rules', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="status"><?php _e( 'Required', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="actions is_responsive"><?php _e( 'Actions', 'yith-woocommerce-checkout-manager' ); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="sort is_responsive"></th>
				<th class="check-column is_responsive" style="padding-left:0px !important;"><input type="checkbox" style="margin-left:7px;" /></th>
				<th class="name is_responsive"><?php _e( 'Name', 'yith-woocommerce-checkout-manager' ) ?></th>
				<th class="type"><?php _e( 'Type', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="label"><?php _e( 'Label', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="placeholder"><?php _e( 'Placeholder', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="validation-rules"><?php _e( 'Validation rules', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="status"><?php _e( 'Required', 'yith-woocommerce-checkout-manager' ); ?></th>
				<th class="actions is_responsive"><?php _e( 'Actions', 'yith-woocommerce-checkout-manager' ); ?></th>
			</tr>
		</tfoot>
		<tbody class="ui-sortable">
		<?php
		$i = 0; // init counter
		foreach ( $fields as $name => $field ) :
			// check if is custom
			$custom = ! in_array( $name, $default_fields_key ) ? true : false;
			$class = apply_filters( 'ywcc_fields_main_table_row_class', array(
				$custom ? 'is_custom' : '',
				! $field['enabled'] ? 'disabled-row' : ''
			), $field );
			$class = array_filter( $class );
			?>
			<tr data-row="<?php echo $i; ?>" class="<?php echo implode(' ', $class ) ?>">
				<td width="1%" class="sort ui-sortable-handle is_responsive">
					<input type="hidden" name="field_name[]" class="field_name" data-name="field_name" value="<?php echo esc_attr( $name ); ?>"/>
					<input type="hidden" name="field_type[]" data-name="field_type" value="<?php echo $field['type'] ?>"/>
					<input type="hidden" name="field_label[]" data-name="field_label" value="<?php echo $field['label']; ?>"/>
					<input type="hidden" name="field_placeholder[]" data-name="field_placeholder" value="<?php echo $field['placeholder']; ?>"/>
					<input type="hidden" name="field_options[]" data-name="field_options" value="<?php echo $field['options']; ?>"/>

					<input type="hidden" name="field_position[]" data-name="field_position" value="<?php echo $field['position']; ?>"/>
					<input type="hidden" name="field_class[]" data-name="field_class" value="<?php echo $field['class']; ?>"/>
					<input type="hidden" name="field_label_class[]" data-name="field_label_class" value="<?php echo $field['label_class']; ?>"/>

					<input type="hidden" name="field_required[]" data-name="field_required" value="<?php echo $field['required']; ?>"/>
					<input type="hidden" name="field_enabled[]" data-name="field_enabled" value="<?php echo $field['enabled'] ?>"/>
					<input type="hidden" name="field_validate[]" data-name="field_validate" value="<?php echo $field['validate'] ?>"/>
					<input type="hidden" name="field_show_in_email[]" data-name="field_show_in_email" value="<?php echo $field['show_in_email'] ?>"/>
					<input type="hidden" name="field_show_in_order[]" data-name="field_show_in_order" value="<?php echo $field['show_in_order'] ?>"/>

					<input type="hidden" name="field_tooltip[]" data-name="field_tooltip" value="<?php echo $field['tooltip']; ?>"/>
					
					<input type="hidden" name="field_deleted[]" data-name="field_deleted" value="" />

					<span class="dashicons dashicons-move"></span>
				</td>
				<td class="td_select is_responsive"><input type="checkbox" name="select_field[<?php echo $i; ?>]"/></td>
				<td class="td_field_name is_responsive"><?php echo esc_attr( $name ); ?></td>
				<td class="td_field_type"><?php echo $field['type']; ?></td>
				<td class="td_field_label"><?php echo $field['label']; ?></td>
				<td class="td_field_placeholder"><?php echo $field['placeholder']; ?></td>
				<td class="td_field_validate"><?php echo $field['validate']; ?></td>
				<td class="td_field_required status"><?php echo( $field['required'] == 1 ? '<span class="status-enabled tips" data-tip="' .  __( 'Yes', 'yith-woocommerce-checkout-manager' ) . '"></span>' : '-' ) ?></td>
				<td class="td_field_action is_responsive">
					<button type="button" class="button edit_field"><?php _e( 'Edit', 'yith-woocommerce-checkout-manager' ); ?></button>
					<?php
					$enable_button_label = $field['enabled'] == 1 ? __( 'Disable', 'yith-woocommerce-checkout-manager' ) : __( 'Enable', 'yith-woocommerce-checkout-manager' );
					$enable_button_data  = $field['enabled'] != 1 ? __( 'Disable', 'yith-woocommerce-checkout-manager' ) : __( 'Enable', 'yith-woocommerce-checkout-manager' );
					?>
					<button type="button" class="button enable_field" data-label="<?php echo $enable_button_data ?>"><?php echo $enable_button_label ?></button>

					<button type="button" class="button remove_field"><?php _e( 'Remove', 'yith-woocommerce-checkout-manager' ); ?></button>
				</td>
			</tr>
			<?php $i ++; endforeach; ?>
		</tbody>
	</table>
	<div class="fields_table_bulk_actions">
		<select name="bulk_action_bottom" id="bulk_actions_select_bottom">
			<option value=""><?php _e( 'Select an action', 'yith-woocommerce-checkout-manager'); ?></option>
			<option value="enable"><?php _e( 'Enable', 'yith-woocommerce-checkout-manager'); ?></option>
			<option value="disable"><?php _e( 'Disable', 'yith-woocommerce-checkout-manager'); ?></option>
		</select>
		<input type="submit" id="ywcc_doaction_bulk_bottom" class="button action" value="Apply">
	</div>
		<input type="hidden" name="ywccp-admin-action" value="fields-save" />
		<input type="hidden" name="ywccp-admin-section" value="<?php echo $current ?>" />
		<input style="float: left; margin-right: 10px;" class="button-primary" type="submit" value="<?php _e( 'Save changes', 'yith-woocommerce-checkout-manager' )?>"/>
</form>