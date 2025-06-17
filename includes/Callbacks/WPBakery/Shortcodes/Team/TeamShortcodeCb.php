<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Team;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Team Shortcode Callback.
 *
 * @package KDESKADDON
 */
class TeamShortcodeCb {

    /**
     * Primary Team block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
	public function get_team( $atts, $content ) {
		$atts = shortcode_atts([
            'id'                       => '',
            'custom_class_id'          => wp_rand(),
            'layout'                   => 'layout_1',
            'carousel'                 => 0,
            'carousel_items'           => 4,
            'carousel_nav'             => 1,
            'carousel_dots'            => 0,
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
            'theme'                    => '',
            'theme_color'              => KDESK_PRIMARY_COLOR,
            'animation'                => '',
		], $atts);

		extract( $atts ); // phpcs:ignore

		// For Custom Theme.

		// Column.

		$columns = ( $carousel_items == '' ) ? 3 : $carousel_items;

		$custom_class      = '';
		$custom_class_data = '';

		if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

			$custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
			$custom_class_data .= '.kc_' . $custom_class_id . ' .team-meta{background: ' . $theme_color . ';}';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .team-social-share a{color: ' . $theme_color . ';}';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .teams-container .owl-controls  i.nav-icon {background: ' . $theme_color . ';}';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .team-layout-2:hover .team-meta h3{color: ' . $theme_color . ' ;}';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .team-layout-2:hover .team-meta p{color: ' . $theme_color . ' ;}';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .owl-prev,';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .owl-next{color: ' . $theme_color . ' !important;}';
			$custom_class_data .= '.kc_' . $custom_class_id . ' .owl-dots .active span{background: ' . $theme_color . ' !important;}';
		}

		// Wrapped By Data Attribute.

		if ( $custom_class != '' ) {

			$custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
		}

		$output = '<div class="item_' . $columns . ' row ' . $custom_class . '" ' . $custom_class_data . '>';

		// Starting div condition for carousel.
		if ( $carousel == 1 ) {

			$carousel_nav_status  = ( $carousel_nav == 1 ) ? 'false' : 'true';
			$carousel_dots_status = ( $carousel_dots == 1 ) ? 'false' : 'true';

			$output .= '<div class="team-container owl-carousel" data-carousel="1" data-items="' . $carousel_items . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '"  data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
		}

		// Modified shortcode.

		$content = str_replace( '[kdesk_team_item', '[kdesk_team_item layout="' . $layout . '" animation="' . $animation . '" ', $content );

		$output .= do_shortcode( $content );

		// Ending div condition for carousel.
		if ( $carousel == 1 ) {
			$output .= '</div>';
		}

		$output .= '</div>';

		return $output;
	}

	/**
     * Single Team block
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
	public function get_team_item( $atts ) {

		$atts = shortcode_atts([
            'layout'             => 'layout_1',
            'team_name'          => '',
            'team_info'          => '',
            'team_image'         => '',
            'team_custom_link'   => '#',
            'social_link_status' => 0,
            'team_facebook'      => '#',
            'team_twitter'       => '#',
            'team_instagram'     => '#',
            'team_linkedin'      => '#',
            'animation'          => '',

		], $atts);

		extract( $atts ); // phpcs:ignore

		// Featured Image For Team.

		$feat_image_url_string = '';

		$feat_image_info = kdesk_addon_get_img( $team_image );

		if ( ! empty( $feat_image_info ) ) {

			$feat_image_url_string .= $feat_image_info;
		}

		$column_class = 'col-md-3 col-sm-6 col-12';

		// Animation Class

		$kdesk_team_animation = '';

		if ( ! empty( $animation ) ) {
			$animate_class        = new Animation( [ 'base' => 'kdesk_team_item' ] );
			$kdesk_team_animation = ' ' . $animate_class->getCSSAnimation( $animation );
		}

		$column_class = $column_class . ' ' . $kdesk_team_animation;

        // Layout Class.
        $layout_class = ( $layout === 'layout_2' ) ? 'team-layout-2' : 'team-layout-1';

		// Generate Output.

		$team_custom_url = $team_custom_link;

		$team_custom_url_target = '';

		if ( isset( $team_custom_link ) && $team_custom_link != '#' ) {
			$team_custom_string     = vc_build_link( $team_custom_link );
			$team_custom_url        = esc_url( $team_custom_string['url'] );
			$team_custom_url_target = ( isset( $team_custom_string['target'] ) && $team_custom_string['target'] != '' ) ? ' target="_blank"' : '';
		}

		// Social Links.

		if ( isset( $social_link_status ) && $social_link_status == 1 ) {
			$social_link_html = '';
		} else {

			$social_link_html = '<div class="team-social-share clearfix">
                                            <a class="fa fa-facebook rectangle" href="' . kdesk_addhttp( $team_facebook ) . '" title="Facebook" target="_blank"></a>
                                            <a class="fa fa-twitter rectangle" href="' . kdesk_addhttp( $team_twitter ) . '" title="Twitter" target="_blank"></a>
                                            <a class="fa fa-instagram rectangle" href="' . kdesk_addhttp( $team_instagram ) . '" title="Instagram" target="_blank"></a>
                                            <a class="fa fa-linkedin rectangle" href="' . kdesk_addhttp( $team_linkedin ) . '" title="Linkedin" target="_blank"></a>
                                        </div> <!-- end .author-social-box  -->';
		}

		$output = "<div class='{$column_class}'>
                                <div class='{$layout_class} text-center xs-margin'>       

                                    <figure class='team-member'>
                                        <a href='{$team_custom_url}' title='{$team_name}'  {$team_custom_url_target}>
                                            {$feat_image_url_string}
                                        </a>
                                    </figure>
                                    
                                    <div class='team-meta'>
                                        <h3>{$team_name}</h3>                                   
                                        <p>{$team_info}</p> 
                                    </div>

                                    {$social_link_html}

                                </div> 
                         </div>";

		return $output;
	}
}
