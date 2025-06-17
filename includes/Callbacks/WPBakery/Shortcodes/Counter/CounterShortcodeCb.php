<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Counter;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Counter Shortcode Callback.
 *
 * @package KDESKADDON
 */
class CounterShortcodeCb {

    /**
     * Primary Counter block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_the_counter_container( $atts, $content ) {

        $atts = shortcode_atts([
            'id'              => '',
            'custom_class_id' => wp_rand(),
            'layout'          => 'layout_1',
            'column'          => 4,
            'text_align'      => '',
            'time'            => 1000,
            'delay'           => 10,
            'hide_icon'       => 0,
            'theme'           => '',
            'counter_bg'      => '#FFFFFF',
            'counter_color'   => KDESK_PRIMARY_COLOR,
            'text_color'      => KDESK_TEXT_COLOR,
            'icon_color'      => KDESK_TEXT_COLOR,
            'animation'       => '',
        ], $atts);

        extract( $atts );

        $output = '';

        // For Custom Theme.
        $custom_class      = '';
        $custom_class_data = ! empty( $custom_class ) ? ' data-custom_style="' . $custom_class_data . '"' : '';

        // Modified shortcode.
        $output = '<div class="item_' . $column . ' row' . $custom_class . '" ' . $custom_class_data . '>';

        $content = str_replace( '[kdesk_counter_item', '[kdesk_counter_item column=' . $column . ' animation="' . $animation . '" layout="' . $layout . '" text_align="' . $text_align . '"  time="' . $time . '"  delay="' . $delay . '" hide_icon="' . $hide_icon . '" theme="' . $theme . '" counter_bg="' . $counter_bg . '" counter_color="' . $counter_color . '" text_color="' . $text_color . '" icon_color="' . $icon_color . '" ', $content );

        $output .= do_shortcode( $content );

        $output .= '</div>';

        return $output;
    }

    /**
     * Single counter block.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_the_counter_item( $atts ) {
        $atts = shortcode_atts([
            'column'            => 4,
            'id'                => '',
            'counter_title'     => '',
            'counter_title_tag' => 'h4',
            'counter_value'     => '',
            'counter_value_tag' => 'span',
            'layout'            => 'layout_1',
            'icon'              => 'fa fa-briefcase',
            'text_align'        => 'left',
            'time'              => 1000,
            'delay'             => 10,
            'theme'             => '',
            'hide_icon'         => 0,
            'counter_bg'        => '#FFFFFF',
            'counter_color'     => KDESK_PRIMARY_COLOR,
            'text_color'        => KDESK_TEXT_COLOR,
            'icon_color'        => KDESK_TEXT_COLOR,
            'animation'         => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        // Column Class.
        $column_class = kdesk_column_class( $column );

        // Alignment Class
        $text_align_class = kdesk_alignment_class( $text_align );

        // Animation Class
        $kdesk_counter_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class           = new Animation( [ 'base' => 'kdesk_counter_item' ] );
            $kdesk_counter_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        $column_class = $column_class . ' ' . $text_align_class . ' ' . $kdesk_counter_animation;

        // Custom Style.
        // @Since: 1.0.2

        $custom_bg_style      = '';
        $custom_counter_style = '';
        $custom_text_style    = '';
        $custom_icon_style    = '';

        if ( isset( $theme ) && $theme == 'custom' ) {

            $custom_bg_style      = ' style="background:' . $counter_bg . ';"';
            $custom_counter_style = ' style="color:' . $counter_color . ';"';
            $custom_text_style    = ' style="color:' . $text_color . ';"';
            $custom_icon_style    = ' style="color:' . $icon_color . ';"';
        }

        // Hide icon from counter block.
        // @Since: 1.0.1

        $icon_html = ( $hide_icon == 1 ) ? '' : '<span class="icon ' . $icon . '" ' . $custom_icon_style . '></span>';

        if ( $layout == 'layout_2' ) {

            $output = '<div class="' . $column_class . '">
                                <div class="counter-block-2">
                                    ' . $icon_html . '
                                    <span class="counter kdesk_counter_num" data-time="' . $time . '" data-delay="' . $delay . '"' . $custom_counter_style . '>' . $counter_value . '</span>
                                    <h4' . $custom_text_style . '>' . $counter_title . '</h4>
                                </div>
                            </div>';
        } else {

            $output = '<div class="' . $column_class . '">
                                    <div class="counter-block-1" ' . $custom_bg_style . '>
                                        ' . $icon_html . '
                                            <div class="count-info">
                                            <span class="counter kdesk_counter_num" data-time="' . $time . '" data-delay="' . $delay . '"' . $custom_counter_style . '>' . $counter_value . '</span>
                                            <h4' . $custom_text_style . '>' . $counter_title . '</h4>
                                            </div>
                                    </div>
                                </div>';
        }

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
