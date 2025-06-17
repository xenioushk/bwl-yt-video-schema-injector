<?php
namespace BWLYTVSI\Callbacks\Actions\Frontend;

/**
 * Class for registering all the schedulers.
 *
 * @package BWLYTVSI
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class YtSchemaInjectorCb {

	/**
	 * Register actions.
	 */
	public function generate_video_schema() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		global $post;
		$content = $post->post_content;

		// Match YouTube URLs
		preg_match_all( '#https?://(?:www\.)?(?:youtube\.com/watch\?v=|youtu\.be/)([\w\-]{11})#', $content, $matches );

		if ( empty( $matches[1] ) ) { return;
		}

		$videos = [];

		foreach ( $matches[1] as $video_id ) {
			$videos[] = [
				'@type'        => 'VideoObject',
				'name'         => 'YouTube Video', // You can replace with fetched title if using oEmbed/API
				'description'  => get_the_excerpt( $post ),
				'thumbnailUrl' => "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg",
				'uploadDate'   => get_the_date( DATE_W3C, $post ),
				'embedUrl'     => "https://www.youtube.com/embed/{$video_id}",
				'duration'     => 'PT3M', // Optional: Estimate or fetch via YouTube API
			];
		}

		// Output the JSON-LD
		$schema = [
			'@context' => 'https://schema.org',
			'@graph'   => $videos,
		];

		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
	}
}
