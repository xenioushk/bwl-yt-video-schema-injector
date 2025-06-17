<?php

function kdesk_addon_get_img( $attachment_id, $img_size = '' ) {

    $img_width = ( isset( $img_size ) && $img_size != '' ) ? $img_size : 'knowledgedesk-img-xxl';

    $img_string = wp_get_attachment_image( $attachment_id, $img_width );

    return $img_string;
}

function kdesk_img_dimension( $attachment_id, $img_size = '' ) {

    $img_string = '';

    // thumbnail, medium, large, full, knowledgedesk-img-xxl

    $img_width = ( isset( $img_size ) && $img_size != '' ) ? $img_size : 'knowledgedesk-img-xxl';

    $image_info = wp_get_attachment_image_src( $attachment_id, $img_width );

    $image_srcset = wp_get_attachment_image_srcset( $attachment_id );

    if ( isset( $image_info ) && ! empty( $image_info ) ) {

        $img_string .= 'src="' . $image_info[0] . '"';
        $img_string .= ' width="' . $image_info[1] . '" height="' . $image_info[2] . '" ';
        $img_string .= ' srcset="' . $image_srcset . '"';
    }

    return $img_string;
}

function kdesk_content_alignment() {

    $alignment = [
        esc_html__( 'Select', 'kdesk_vc' ) => '',
        'Left'                             => 'left',
        'Center'                           => 'center',
        'Right'                            => 'right',
    ];

    return $alignment;
}

function kdesk_content_tag() {

    $tags = [
        esc_html__( 'Select', 'kdesk_vc' ) => '',
        'h1'                               => 'h1',
        'h2'                               => 'h2',
        'h3'                               => 'h3',
        'h4'                               => 'h4',
        'h5'                               => 'h5',
        'h6'                               => 'h6',
        'p'                                => 'p',
    ];

    return $tags;
}

function kdesk_boolean_term() {

    $boolean_term = [
        esc_html__( 'Select', 'kdesk_vc' ) => '',
        esc_html__( 'Yes', 'kdesk_vc' )    => 1,
        esc_html__( 'No', 'kdesk_vc' )     => 0,
    ];

    return $boolean_term;
}

function kdesk_order_type() {

    $order_type_term = [
        esc_html__( 'Select', 'kdesk_vc' )     => '',
        esc_html__( 'Ascending', 'kdesk_vc' )  => 'ASC',
        esc_html__( 'Descending', 'kdesk_vc' ) => 'DESC',
    ];

    return $order_type_term;
}

function kdesk_order_by() {

    $order_by_term = [
        esc_html__( 'Select', 'kdesk_vc' ) => '',
        esc_html__( 'ID', 'kdesk_vc' )     => 'ID',
        esc_html__( 'TITLE', 'kdesk_vc' )  => 'TITLE',
        esc_html__( 'Date', 'kdesk_vc' )   => 'DATE',
        esc_html__( 'Random', 'kdesk_vc' ) => 'rand',
    ];

    return $order_by_term;
}

function kdesk_layout() {

    $layout_term = [
        esc_html__( 'Select', 'kdesk_vc' )    => '',
        esc_html__( 'Layout 01', 'kdesk_vc' ) => 'layout_1',
        esc_html__( 'Layout 02', 'kdesk_vc' ) => 'layout_2',
    ];

    return $layout_term;
}

function kdesk_counter_delay() {

    $counter_delay = [
        '5'   => '5',
        '10'  => '10',
        '15'  => '15',
        '20'  => '20',
        '25'  => '25',
        '30'  => '30',
        '35'  => '35',
        '40'  => '40',
        '45'  => '45',
        '50'  => '50',
        '60'  => '60',
        '100' => '100',
    ];

    return $counter_delay;
}

function kdesk_counter_time() {

    $wiz_counter_time = [
        '1 Second'   => '1000',
        '2 Seconds'  => '2000',
        '3 Seconds'  => '3000',
        '5 Seconds'  => '5000',
        '10 Seconds' => '10000',
        '20 Seconds' => '20000',
        '30 Seconds' => '30000',
    ];

    return $wiz_counter_time;
}

function kdesk_hex_to_rgb( $hex ) {

    $hex   = str_replace( '#', '', $hex );
    $color = [];

    if ( strlen( $hex ) == 3 ) {
        $color['r'] = hexdec( substr( $hex, 0, 1 ) . $r );
        $color['g'] = hexdec( substr( $hex, 1, 1 ) . $g );
        $color['b'] = hexdec( substr( $hex, 2, 1 ) . $b );
    } elseif ( strlen( $hex ) == 6 ) {
        $color['r'] = hexdec( substr( $hex, 0, 2 ) );
        $color['g'] = hexdec( substr( $hex, 2, 2 ) );
        $color['b'] = hexdec( substr( $hex, 4, 2 ) );
    }

    return implode( ',', $color );
}

function kdesk_overlay_opacity() {

    $overlay_opacity = [
        '1.0' => '1.0',
        '0.9' => '0.9',
        '0.8' => '0.8',
        '0.7' => '0.7',
        '0.6' => '0.6',
        '0.5' => '0.5',
        '0.4' => '0.4',
        '0.3' => '0.3',
        '0.2' => '0.2',
        '0.1' => '0.1',
    ];

    return $overlay_opacity;
}

// Added in version 1.0.1

function kdesk_items_per_row( $start = 6, $end = 1 ) {

    $items_per_row = [];

    for ( $i = $start; $i >= $end; $i-- ) {

        $items_per_row[ $i ] = $i;
    }

    return $items_per_row;
}

// Added in version 1.0.1

function kdesk_border_radius( $start = 0, $end = 10 ) {

    $border_radius = [];

    for ( $i = $start; $i <= $end; $i++ ) {

        $border_radius[ $i . 'px' ] = $i;
    }

    return $border_radius;
}


function kdesk_carousel_timeout( $start = 30, $end = 5, $interval = 5 ) {

    $carousel_timeout = [];

    for ( $i = $start; $i >= $end; $i = $i - $interval ) {

        $carousel_timeout[ $i . ' ' . __( 'Seconds', 'kdesk_vc' ) ] = $i * 1000;
    }

    return $carousel_timeout;
}

function kdesk_count_time( $start = 50, $end = 10, $interval = 5 ) {

    $count_time = [];

    for ( $i = $start; $i >= $end; $i = $i - $interval ) {

        $count_time[ $i . ' ' . __( 'Seconds', 'kdesk_vc' ) ] = $i * 100;
    }

    return $count_time;
}

function kdesk_count_delay( $start = 10, $end = 1, $interval = 1 ) {

    $count_delay = [];

    for ( $i = $start; $i >= $end; $i = $i - $interval ) {

        $count_delay[ $i . ' ' . esc_html__( 'Milliseconds ', 'kdesk_vc' ) ] = $i;
    }

    return $count_delay;
}


function kdesk_column_class( $column = 3 ) {

    switch ( $column ) {

        case '1':
            return 'col-12';

        case '2':
            return 'col-12 col-sm-12 col-md-6';

        case '3':
            return 'col-12 col-sm-6 col-md-4';

		case '4':
            return 'col-12 col-sm-6 col-md-3';

		case '6':
            return 'col-12 col-sm-6 col-md-2';

        default:
            return 'col-12 col-sm-6 col-md-4';
    }
}

function kdesk_pricing_table_column_class( $column = 4 ) {

    switch ( $column ) {

        case '1':
            return 'col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0';

        case '2':
            return 'col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0';

        case '3':
            return 'col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0';

        case '4':
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0';

        default:
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0';
    }
}


function kdesk_gallery_column_class( $column = 4 ) {

    switch ( $column ) {

        case '1':
            return 'col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0';

        case '2':
            return 'col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0';

        case '3':
            return 'col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0';

        case '4':
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0';

        default:
            return 'col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0';
    }
}

function kdesk_alignment_class( $alignment = 'center' ) {

    switch ( $alignment ) {

        case 'left':
            return 'text-start';

        case 'right':
            return 'text-end';

        default:
            return 'text-center';
    }
}

function kdesk_price_table_title( $title = '' ) {

    switch ( $title ) {

        case 'year':
            return esc_html__( '/ Year', 'kdesk_vc' );

        case 'month':
            return esc_html__( '/ Month', 'kdesk_vc' );

        case 'day':
            return esc_html__( '/ Day', 'kdesk_vc' );

        case 'hour':
            return esc_html__( '/ Hour', 'kdesk_vc' );

        default:
            return esc_html__( '/ Month', 'kdesk_vc' );
    }
}

/**
 * Fix & Clear Shortcode Isseus
 *
 * @$shortcode string
 * @return string
 */
function kdesk_cleanup_shortcode( $shortcode ) {

    $shortcode_content = str_replace( '`{`', '[', $shortcode );
    $clean_shortcode   = str_replace( '`}`', ']', $shortcode_content );
    return $clean_shortcode;
}

/**
 * Fix shortcode extra paragraph adding issue.
 *
 * @param string $content shortcode content.
 * @return string
 */
function kdesk_shortcode_empty_paragraph_fix( $content ) {
    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];

    $content = strtr( $content, $array );
    return $content;
}

add_filter( 'the_content', 'kdesk_shortcode_empty_paragraph_fix' );


// Create Custom Parameters for WPBakery Page Builder Elements.

if ( function_exists( 'vc_add_shortcode_param' ) ) {
    vc_add_shortcode_param( 'kdesk_hidden_field', 'cb_kdesk_hidden_field' );
}

// Function generate param type "number"
function cb_kdesk_hidden_field( $settings, $value ) {

    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = isset( $settings['class'] ) ? $settings['class'] : '';

    $output = "<input type='hidden' class='wpb_vc_param_value wpbc {$param_name} {$type} {$class}' name='{$param_name}' value='{$value}'>";

    return $output;
}

// Added http before URL

if ( ! function_exists( 'kdesk_addhttp' ) ) {

    function kdesk_addhttp( $url ) {
        if ( ! preg_match( '~^(?:f|ht)tps?://~i', $url ) ) {
            $url = 'http://' . $url;
        }
        return trim( $url );
    }
}
