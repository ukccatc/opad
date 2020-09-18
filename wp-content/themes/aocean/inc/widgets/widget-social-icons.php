<?php
/**
 * Social icons widget
 *
 * @package Modern WP Themes Widget Pack
 * @version 1.0
 */

/**
 * Adds Modern_WP_Themes_Social_Icons widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "modernwpthemes_social_icons" );' ) );
class modernwpthemes_Social_Icons extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'modernwpthemes_social_icons',
			'(MWPT) Social Icons',
			array(
				'description'	=> __( 'Display links to your social network profiles, enter full profile URLs', 'modernwpthemes' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
		$fields = array(
			// Title
			'widget_title' => array(
				'modernwpthemes_widgets_name'			=> 'widget_title',
				'modernwpthemes_widgets_title'			=> __( 'Title', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			
			// Other fields
			'facebook' => array (
				'modernwpthemes_widgets_name'			=> 'facebook',
				'modernwpthemes_widgets_title'			=> __( 'Facebook', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'twitter' => array (
				'modernwpthemes_widgets_name'			=> 'twitter',
				'modernwpthemes_widgets_title'			=> __( 'Twitter', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),

			'linkedin' => array (
				'modernwpthemes_widgets_name'			=> 'linkedin',
				'modernwpthemes_widgets_title'			=> __( 'LinkdIn', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'gplus' => array (
				'modernwpthemes_widgets_name'			=> 'gplus',
				'modernwpthemes_widgets_title'			=> __( 'Google+', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'pinterest' => array (
				'modernwpthemes_widgets_name'			=> 'pinterest',
				'modernwpthemes_widgets_title'			=> __( 'Pinterest', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'youtube' => array (
				'modernwpthemes_widgets_name'			=> 'youtube',
				'modernwpthemes_widgets_title'			=> __( 'YouTube', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'dribbble' => array (
				'modernwpthemes_widgets_name'			=> 'dribbble',
				'modernwpthemes_widgets_title'			=> __( 'Dribbble', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'tumblr' => array (
				'modernwpthemes_widgets_name'			=> 'tumblr',
				'modernwpthemes_widgets_title'			=> __( 'Tumblr', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
			'instagram' => array (
				'modernwpthemes_widgets_name'			=> 'instagram',
				'modernwpthemes_widgets_title'			=> __( 'Instagram', 'modernwpthemes' ),
				'modernwpthemes_widgets_field_type'		=> 'text'
			),
		);

		return $fields;
	 }


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		$widget_title 			= apply_filters( 'widget_title', $instance['widget_title'] );
				
		echo $before_widget;
		
		// Show title
		if( isset( $widget_title ) ) {
			echo $before_title . $widget_title . $after_title;
		}

		echo '<ul class="clearfix widget-social-icons">';
			// Loop through fields
			$widget_fields = $this->widget_fields();
			foreach( $widget_fields as $widget_field ) {
				// Make array elements available as variables
				extract( $widget_field );
				// Check if field has value and skip title field
				unset( $modernwpthemes_widgets_field_value );
				if( isset( $instance[$modernwpthemes_widgets_name] ) && 'widget_title' != $modernwpthemes_widgets_name ) { 
					$modernwpthemes_widgets_field_value = esc_attr( $instance[$modernwpthemes_widgets_name] ); 
					if( '' != $modernwpthemes_widgets_field_value ) {	?>
					<li class="widget-si-<?php echo $modernwpthemes_widgets_name; ?>"><a href="<?php echo $modernwpthemes_widgets_field_value; ?>" title="<?php echo $modernwpthemes_widgets_title; ?>"><i class="fa-<?php echo $modernwpthemes_widgets_name; ?>"></i></a></li>
					<?php }
				}
			}
		echo '<!-- .widget-social-icons --></ul>';
		
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	modernwpthemes_widgets_show_widget_field()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			extract( $widget_field );
	
			// Use helper function to get updated field values
			$instance[$modernwpthemes_widgets_name] = modernwpthemes_widgets_updated_field_value( $widget_field, $new_instance[$modernwpthemes_widgets_name] );
			echo $instance[$modernwpthemes_widgets_name];
		}
				
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @uses	modernwpthemes_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
		
			// Make array elements available as variables
			extract( $widget_field );
			$modernwpthemes_widgets_field_value = isset( $instance[$modernwpthemes_widgets_name] ) ? esc_attr( $instance[$modernwpthemes_widgets_name] ) : '';
			modernwpthemes_widgets_show_widget_field( $this, $widget_field, $modernwpthemes_widgets_field_value );
		
		}	
	}

}