<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Heading;

use KAFWPB\Controllers\WPBakery\Support\Animation;

/**
 * Class Heading Shortcode Callback.
 *
 * @package KDESKADDON
 */
class HeadingShortcodeCb {

	/**
	 * Heading Shortcode Callback.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts(
            [
				'id'                => '',
				'custom_class_id'   => wp_rand(),
				'title'             => '',
				'title_tag'         => 'h2',
				'title_color'       => KDESK_TEXT_COLOR,
				'sub_title'         => '',
				'sub_title_tag'     => 'h3',
				'sub_title_color'   => KDESK_TEXT_COLOR,
				'alt_pos'           => 0,
				'theme'             => '',
				'layout'            => 'layout_1',
				'border_height'     => '2',
				'border_upper'      => '#40C1F0',
				'border_bottom'     => '#EEEEEE',
				'sep_img'           => '',
				'content_alignment' => '',
				'animation'         => '',
				'cont_ext_class'    => '',
            ],
            $atts
        );

        extract( $atts ); // phpcs:ignore

        // This provide a backup of inline heading.
        $content_alignment = ( isset( $content_alignment ) && $content_alignment == '' && $layout == 'layout_3' ) ? 'left' : $content_alignment;

        $custom_class      = '';
        $custom_class_data = '';

        $custom_heading_style     = '';
        $custom_sub_heading_style = '';

        $sep_img_url = '';

        if ( $theme == 'custom' ) {

            // For heading text custom style.
            if ( isset( $title_color ) && ! empty( $title_color ) && $title_color != KDESK_TEXT_COLOR ) {

                $custom_heading_style .= 'color:' . $title_color . ';';
            }

            // For Sub heading text custom style.
            if ( isset( $sub_title_color ) && ! empty( $sub_title_color ) && $sub_title_color != KDESK_TEXT_COLOR ) {

                $custom_sub_heading_style .= 'color:' . $sub_title_color . ';';
            }
        }

        // If Layout3 Then Custom CSS Will Generate.
        if ( $layout == 'layout_3' ) {

            // For Layout 3 border bottom.
            if ( isset( $border_upper ) && ! empty( $border_upper ) && $layout == 'layout_3' ) {

                $custom_class      .= " kdesk_custom kc_{$custom_class_id}";
                $custom_class_data .= 'h2.kc_' . $custom_class_id . '::after{background: ' . $border_upper . '; height: ' . $border_height . 'px; bottom: -' . $border_height . 'px;}';
            }

            // For Layout 3 border bottom.
            if ( isset( $border_bottom ) && ! empty( $border_bottom ) && $layout == 'layout_3' ) {

                $custom_heading_style .= "border-bottom-color:{$border_bottom}; ";
                $custom_heading_style .= "border-bottom-width:{$border_height}px;";
            }
        }

        // For Seperator.
        if ( isset( $sep_img ) && ! empty( $sep_img ) ) {
            $custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
            $sep_img_url        = wp_get_attachment_url( $sep_img );
            $custom_class_data .= 'h2.kc_' . $custom_class_id . '::before{background-image: url(' . $sep_img_url . ')}';
        }

        // Wrapped By Data Attribute.
        if ( $custom_class != '' ) {
            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        // Finally, Wrapped By Style Attribute.
        if ( $custom_heading_style != '' ) {
            $custom_heading_style = ' style="' . $custom_heading_style . '"';
        }

        if ( $custom_sub_heading_style != '' ) {
            $custom_sub_heading_style = ' style="' . $custom_sub_heading_style . '"';
        }

        // Heading Wrapper Class.
        $section_heading_wrapper_class = ( isset( $cont_ext_class ) && $cont_ext_class != '' ) ? ' section-heading-container ' . $cont_ext_class : 'section-heading-container';

        // Animation Class
        $kdesk_heading_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class           = new Animation( [ 'base' => 'kdesk_vc_heading' ] );
            $kdesk_heading_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        // Alignment Class.
        $content_alignment = kdesk_alignment_class( $content_alignment );

        $content_alignment = $content_alignment . ' ' . $kdesk_heading_animation;

        // Alter Class.
        $kdesk_alt_pos_class = '';
        $alt_pos_status      = 0;

        if ( isset( $alt_pos ) && $alt_pos == 1 ) {
            $kdesk_alt_pos_class = ' kdesk_heading_pos_alt';
            $alt_pos_status      = 1;
        }

        // Buildiing Shortcode HTML.
        $heading_wrapper_start = '<div class="row">
                                                    <div class="col-md-12 col-sm-12 ' . $section_heading_wrapper_class . ' ' . $content_alignment . $kdesk_alt_pos_class . '">';

        $heading_wrapper_end = '</div>
                                               </div>';

        // Dark Background
        $dark_heading_class = ( isset( $layout ) && ( $layout == 'layout_light' ) ) ? '-alt ' : '';

        // Generate Heading Titlte HTML
        $heading_title = ( isset( $title ) && ( $title != '' ) ) ? '<' . $title_tag . ' class="section-heading' . $dark_heading_class . $custom_class . '"' . $custom_heading_style . ' ' . $custom_class_data . '>' . $title . '</' . $title_tag . '>' : '';

        // Generate Sub Heading Titlte HTML
        $heading_sub_title = ( isset( $sub_title ) && ( $sub_title != '' ) ) ? '<' . $sub_title_tag . ' class="section-subheading' . $dark_heading_class . '"' . $custom_sub_heading_style . '>' . $sub_title . '</' . $sub_title_tag . '>' : '';

        // Alter & Assign content
        if ( $alt_pos_status == 1 ) {

            $tmp_heading_sub_title = $heading_sub_title;
            $heading_sub_title     = $heading_title;
            $heading_title         = $tmp_heading_sub_title;
        }

        if ( $layout == 'layout_3' ) {
            $output = "<{$title_tag} class='only-heading {$content_alignment} {$custom_class}' {$custom_heading_style} {$custom_class_data}>{$title}</{$title_tag}>";
        } elseif ( $layout == 'layout_light' ) {

            $output = $heading_wrapper_start . $heading_title . $heading_sub_title . $heading_wrapper_end;
        } elseif ( $layout == 'layout_2' ) {

            $output = $heading_wrapper_start . $heading_title . $heading_wrapper_end;
        } else {

            $output = $heading_wrapper_start . $heading_title . $heading_sub_title . $heading_wrapper_end;
        }

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
