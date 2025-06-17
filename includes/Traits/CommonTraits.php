<?php
namespace KDESKADDON\Traits;

trait CommonTraits {

	/**
     * Get the translation data for JavaScript
     *
     * @return string
     * @example BafAdminData.baf_text_loading
     * @param string $link get the YouTube url.
     * @param string $title set custom title for the YouTube video.
     */
	public static function set_youtube_url( $link = '', $title = 'video tutorial' ): string {

		if ( empty( $link ) ) {
			return '';
		}

		$icon = "<span class='dashicons dashicons-youtube'></span>";
		$link = esc_url( $link );

		return "<a href={$link} title={$title} class='bwl_youtube_link' target='_blank'>{$icon}</a>";
	}
}
