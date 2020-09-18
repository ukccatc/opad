<?php
/**
 * File that holds helper functions that display widget fields in the dashboard
 *
 * @package Modern WP Themes Widget Pack
 * @version 1.0
 */

/**
 * Widget form fields helper function
 * 
 *
 * @package Modern WP Themes Widget Pack
 * @version 1.0

 * @param	object	$instance		Widget instance
 * @param	array	$widget_field	Widget field array
 * @param	string	$field_value	Field value
 *
 * @since Modern WP Themes Widget Pack 1.0
 */
function modernwpthemes_widgets_show_widget_field( $instance = '', $widget_field = '', $mwpt_field_value = '' ) {
	
	extract( $widget_field );
	
	switch( $modernwpthemes_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>"><?php echo $modernwpthemes_widgets_title; ?>:</label>
				<input class="widefat" id="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $modernwpthemes_widgets_name ); ?>" type="text" value="<?php echo $mwpt_field_value; ?>" />
				
				<?php if( isset( $modernwpthemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $modernwpthemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>"><?php echo $modernwpthemes_widgets_title; ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $modernwpthemes_widgets_name ); ?>"><?php echo $mwpt_field_value; ?></textarea>
			</p>
			<?php
			break;
			
		// Checkbox field
		case 'checkbox' : ?>
			<p>
				<input id="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>" name="<?php echo $instance->get_field_name( $modernwpthemes_widgets_name ); ?>" type="checkbox" value="1" <?php checked( '1', $mwpt_field_value ); ?>/>
				<label for="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>"><?php echo $modernwpthemes_widgets_title; ?></label>

				<?php if( isset( $modernwpthemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $modernwpthemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo $modernwpthemes_widgets_title; 
				echo '<br />';
				foreach( $modernwpthemes_widgets_field_options as $mwpt_option_name => $mwpt_option_title ) { ?>
					<input id="<?php echo $instance->get_field_id( $mwpt_option_name ); ?>" name="<?php echo $instance->get_field_name( $modernwpthemes_widgets_name ); ?>" type="radio" value="<?php echo $mwpt_option_name; ?>" <?php checked( $mwpt_option_name, $mwpt_field_value ); ?> />
					<label for="<?php echo $instance->get_field_id( $mwpt_option_name ); ?>"><?php echo $mwpt_option_title; ?></label>
					<br />
				<?php } ?>
				
				<?php if( isset( $modernwpthemes_widgets_description ) ) { ?>
				<small><?php echo $modernwpthemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>"><?php echo $modernwpthemes_widgets_title; ?>:</label>
				<select name="<?php echo $instance->get_field_name( $modernwpthemes_widgets_name ); ?>" id="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>" class="widefat">
					<?php
					foreach ( $modernwpthemes_widgets_field_options as $mwpt_option_name => $mwpt_option_title ) { ?>
						<option value="<?php echo $mwpt_option_name; ?>" id="<?php echo $instance->get_field_id( $mwpt_option_name ); ?>" <?php selected( $mwpt_option_name, $mwpt_field_value ); ?>><?php echo $mwpt_option_title; ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $modernwpthemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $modernwpthemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>"><?php echo $modernwpthemes_widgets_title; ?>:</label><br />
				<input name="<?php echo $instance->get_field_name( $modernwpthemes_widgets_name ); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id( $modernwpthemes_widgets_name ); ?>" value="<?php echo $mwpt_field_value; ?>" class="small-text" />
				
				<?php if( isset( $modernwpthemes_widgets_description ) ) { ?>
				<br />
				<small><?php echo $modernwpthemes_widgets_description; ?></small>
				<?php } ?>
			</p>
			<?php
			break;
		
	}
	
}