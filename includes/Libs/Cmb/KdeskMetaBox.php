<?php
namespace KDESKADDON\Libs\Cmb;

/**
 * Class for Portfolio CMB Library.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class KdeskMetaBox {

	public $custom_fields;

	public function __construct( $custom_fields ) {
		$this->custom_fields = $custom_fields; // Set custom field data as global value.
		$this->register_assets();
		add_action( 'add_meta_boxes', [ $this, 'register_cmb_fields' ] );
	}

	/**
	 * Register the assets for the custom fields.
	 */
	public function register_assets() {

		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );

		wp_enqueue_style( 'bptm-cmb-colorpicker-style', KDESKADDON_LIBS_DIR . 'admin/colorpicker/styles/colorpicker.css' );

		wp_register_style( 'bwl-cmb-admin-style', KDESKADDON_LIBS_DIR . 'admin/cmb/styles/bwl_cmb.css', [], false, 'all' );
		wp_enqueue_style( 'bwl-cmb-admin-style' );

		wp_register_script( 'bptm-cmb-color-picker-script', KDESKADDON_LIBS_DIR . 'admin/colorpicker/scripts/colorpicker.js', [ 'jquery' ], '', false );
		wp_enqueue_script( 'bptm-cmb-color-picker-script' );

		wp_register_script( 'bwl-cmb-admin-main', KDESKADDON_LIBS_DIR . 'admin/cmb/scripts/bwl_cmb.js', [ 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ], false, false );
		wp_enqueue_script( 'bwl-cmb-admin-main' );
	}


	/**
	 * Register the custom fields.
	 */
	public function register_cmb_fields() {

		$bwl_cmb_custom_fields = $this->custom_fields;

		// First parameter is meta box ID.
		// Second parameter is meta box title.
		// Third parameter is callback function.
		// Last paramenter must be same as post_type_name

		add_meta_box(
            $bwl_cmb_custom_fields['meta_box_id'],
            $bwl_cmb_custom_fields['meta_box_heading'],
            [ $this, 'generate_cmb_fields' ],
            $bwl_cmb_custom_fields['post_type'],
            $bwl_cmb_custom_fields['context'],
            $bwl_cmb_custom_fields['priority']
		);
	}

	/**
	 * Generate the custom fields.
	 *
	 * @param object $post The post object.
	 */
	public function generate_cmb_fields( $post ) {

		$bwl_cmb_custom_fields = $this->custom_fields;

		foreach ( $bwl_cmb_custom_fields['fields'] as $custom_field ) :

			$type        = ( isset( $custom_field['type'] ) && ! empty( $custom_field['type'] ) ) ? $custom_field['type'] : 'text'; // text, textarea, select
			$id          = $custom_field['id'];
			$field_value = get_post_meta( $post->ID, $custom_field['id'], true ) ?? ''; // database saved values.
			$name        = ( isset( $custom_field['name'] ) && ! empty( $custom_field['name'] ) ) ? "name={$custom_field['name']}" : '';
			$class       = ( isset( $custom_field['class'] ) && ! empty( $custom_field['class'] ) ) ? "{$custom_field['class']} wide-fat" : 'wide-fat';
			$placeholder = ( isset( $custom_field['placeholder'] ) && ! empty( $custom_field['placeholder'] ) ) ? "placeholder={$custom_field['placeholder']}" : '';
			$title       = ( isset( $custom_field['title'] ) && ! empty( $custom_field['title'] ) ) ? $custom_field['title'] : '';
			$description = ( isset( $custom_field['desc'] ) && $custom_field['desc'] != '' ) ? "<small class='small-text'>{$custom_field['desc']}</small>" : '';

			if ( $type == 'text' ) : ?>

<p class="bwl_cmb_row post-attributes-label-wrapper">

				<?php
				echo "<label for={$id} class='post-attributes-label'>{$title}{$description}</label>
          <input type={$type} id={$id} {$name} class={$class} {$placeholder} value='{$field_value}'>";
				?>

</p>

				<?php

			elseif ( $type == 'textarea' ) :
				?>

<p class="bwl_cmb_row post-attributes-label-wrapper">

				<?php
				echo "<label for={$id} class='post-attributes-label'>{$title}{$description}</label>
          <textarea type={$type} id={$id} {$name} class={$class} {$placeholder}>{$field_value}</textarea>";
				?>
</p>

				<?php
			elseif ( $type == 'select' ) :
				$options = ( isset( $custom_field['options'] ) && ! empty( $custom_field['options'] ) ) ? $custom_field['options'] : [];
				?>

<p class="bwl_cmb_row post-attributes-label-wrapper">
				<?php
				$output  = "<label for={$id} class='post-attributes-label'>{$title}{$description}</label>";
				$output .= "<select name='{$id}' class='{$class}'>";
				if ( ! empty( $options ) ) {
					foreach ( $options as $key => $value ) {
						$output .= "<option value='{$key}'";
						$output .= ( $field_value == $key ) ? 'selected="selected"' : '';
						$output .= ">{$value}</option>";
					}
				}
				$output .= '</select>';
				echo $output;
				?>

</p>

				<?php

			elseif ( $type == 'repeatable' ) :
				?>
<div classs="kdesk_repeat_field">
    <p class="bwl_cmb_row bwl_cmb_db">
    <label for="<?php echo $custom_field['id']; ?>"><?php echo $custom_field['title']; ?>: </label>

				<?php if ( isset( $custom_field['desc'] ) && $custom_field['desc'] != '' ) : ?>
    <small class="small-text"><?php echo $custom_field['desc']; ?></small>
    <?php endif; ?>
    </p>

    <ul class="bwl_cmb_repeat_field_container">

				<?php

				$i = 0;

				if ( ! empty( $field_value ) && is_array( $field_value ) ) {

					foreach ( $field_value as $data ) {
						?>

    <li class="bwl_cmb_repeat_row" data-row_count="<?php echo $i; ?>">
        <span class="label"><?php echo $custom_field['label_text']; ?></span>
        <input name="<?php echo $custom_field['name'] . '[' . $i . ']'; ?>" type="text"
        value="<?php if ( ! empty( $data ) ) { echo $data;} ?>">
        <div class="clear"></div>
        <a class="delete_row"
        title="<?php esc_html_e( 'Delete', 'kdesk_vc' ); ?>"><?php esc_html_e( 'Delete', 'kdesk_vc' ); ?></a>
    </li>

						<?php

						++$i;
					}
				}

				?>
    </ul>

    <input id="add_new_row" type="button" class="button" value="<?php echo $custom_field['btn_text']; ?>"
    data-delete_text="<?php esc_html_e( 'Delete', 'kdesk_vc' ); ?>"
    data-field_type="<?php echo $custom_field['field_type']; ?>" data-field_name="<?php echo $custom_field['name']; ?>"
    data-label_text="<?php echo $custom_field['label_text']; ?>">

</div>

				<?php

			elseif ( $type == 'wpeditor' ) :

				$editor_height = ( isset( $custom_field['height'] ) && is_numeric( $custom_field['height'] ) ) ? $custom_field['height'] : 250;

				?>

<p class="bwl_cmb_row">
    <label for="<?php echo $custom_field['id']; ?>"><?php echo $custom_field['title']; ?>: </label>

				<?php
				echo wp_editor($field_value, $custom_field['id'], [
                    'wpautop'       => true,
                    'textarea_name' => $custom_field['id'],
                    'media_buttons' => true,
                    'textarea_rows' => 5,
				]);
				?>
				<?php if ( isset( $custom_field['desc'] ) && $custom_field['desc'] != '' ) : ?>
    <small class="small-text"><?php echo $custom_field['desc']; ?></small>
    <?php endif; ?>
</p>

<?php elseif ( $type == 'bgcolor' ) : ?>

<p class="bwl_cmb_row">
    <label for="<?php echo $custom_field['id']; ?>"><?php echo $custom_field['title']; ?>: </label>
    <input type="text" id="<?php echo $custom_field['id']; ?>" name="<?php echo $custom_field['name']; ?>"
    class="<?php echo $custom_field['class']; ?> bgcolor" value="<?php echo esc_attr( $field_value ); ?>"
    placeholder="<?php echo $custom_field['placeholder']; ?>" style="width: 100px;">

	<?php if ( isset( $custom_field['desc'] ) && $custom_field['desc'] != '' ) : ?>
    <small class="small-text"><?php echo $custom_field['desc']; ?></small>
    <?php endif; ?>
</p>

<?php elseif ( $type == 'upload' ) : ?>

<p class="bwl_cmb_row">
    <label for="<?php echo $custom_field['id']; ?>"><?php echo $custom_field['title']; ?>: </label>

    <input id="<?php echo $custom_field['id']; ?>" class="img-path" type="text" style="direction:ltr; text-align:left"
    name="<?php echo $custom_field['name']; ?>" value="<?php if ( ! empty( $field_value ) ) { echo $field_value;} ?>">
    <input id="upload_<?php echo $custom_field['id']; ?>_button" type="button" class="button"
    value="<?php esc_html_e( 'Upload', 'kdesk_vc' ); ?>" data-bg_img_box_id='<?php echo $custom_field['id']; ?>'>
    <input data-parent_field="<?php echo $custom_field['id']; ?>" type="button" class="bwl_cmb_remove_file button"
    value="<?php esc_html_e( 'Remove', 'kdesk_vc' ); ?>">
    <script type='text/javascript'>
    bwl_cmb_set_uploader('<?php echo $custom_field['id']; ?>');
    </script>

	<?php if ( isset( $custom_field['desc'] ) && $custom_field['desc'] != '' ) : ?>
    <small class="small-text"><?php echo $custom_field['desc']; ?></small>
    <?php endif; ?>
</p>

	<?php
        elseif ( $type == 'checkbox' ) :
			?>

<p>
    <input type="checkbox" id="my_meta_box_check" name="my_meta_box_check" <?php checked( $check, 'on' ); ?>>
    <label for="my_meta_box_check">Do not check this</label>
</p>

			<?php
			elseif ( $type == 'kdesk_stats' ) :
				?>

<p>

    <label for="<?php echo $custom_field['id']; ?>"><?php echo $custom_field['title']; ?> </label>

				<?php

				global $post;

				$kdesk_portfolio_sign_lists = get_post_meta( $post->ID, 'kdesk_portfolio_sign_lists' );

				if ( ! empty( $kdesk_portfolio_sign_lists ) ) :

					?>

<ol>
					<?php foreach ( $kdesk_portfolio_sign_lists[0] as $sign_info ) : ?>

    <li><?php echo $sign_info['user_name']; ?> <br><?php echo ucfirst( $sign_info['user_country'] ); ?>
    <br><?php echo $sign_info['sign_date_time']; ?>
    </li>

    <?php endforeach; ?>
</ol>

<?php else : ?>
<p>No <?php echo $custom_field['title']; ?> Found!</p>
<?php endif; ?>
</p>

<?php endif; ?>

			<?php

		endforeach;
	}
}
