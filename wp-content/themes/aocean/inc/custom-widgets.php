<?php
/**
 * Adds custom widgets
 *
 * @package Modern WP Themes Widget Pack
 * @version 1.0
 */

/**
 * Helper function that updates fields in the dashboard form
 *
 * @since Modern WP Themes Widget Pack 1.0
 */
function modernwpthemes_widgets_updated_field_value( $widget_field, $new_field_value ) {

	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $modernwpthemes_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
		
	// Allow some tags in textareas
	} elseif( $modernwpthemes_widgets_field_type == 'textarea' ) {
		// Check if field array specifed allowed tags
		if( !isset( $modernwpthemes_widgets_allowed_tags ) ) {
			// If not, fallback to default tags
			$modernwpthemes_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $modernwpthemes_widgets_allowed_tags );
		
	// No allowed tags for all other fields
	} else {
		return strip_tags( $new_field_value );
	}

}

/**
 * Include helper functions that display widget fields in the dashboard
 *
 * @since Modern WP Themes Widget Pack 1.0
 */
require modernwpthemes_PATH . '/inc/widgets/widget-fields.php';


/**
 * Register Social Icons Widget
 *
 * @since Modern WP Themes  Widget Pack 1.0
 */
require modernwpthemes_PATH . '/inc/widgets/widget-social-icons.php';


/**
 * Tabber Widget
 *
 * @since Modern WP Themes Widget Pack 1.0
 */
require modernwpthemes_PATH . '/inc/widgets/widget-tabs.php';