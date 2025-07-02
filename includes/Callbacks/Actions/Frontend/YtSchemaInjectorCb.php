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
	 * YouTube API key.
	 *
	 * @var string
	 */
	private $api_key = '';


	/**
	 * YouTube API key.
	 *
	 * @var string
	 */
	private $post_id;

	/**
     * Get supported post types for YouTube schema injection.
     *
     * @return array
     */
	private function get_supported_post_types() {

		$allowed_cpts = [
			'post',
			'page',
			'product',
			'portfolio',
			'testimonial',
			'bwl_kb',
		];

		$current_cpt = get_post_type() ?? '';

		$status = in_array( $current_cpt, $allowed_cpts,true );

		return intval( $status );

	}

	/**
	 * Set the YouTube API key from the options.
	 */
	private function set_the_youtube_api_key() {
		$this->api_key = get_option( 'bwlytvsi_api_key', '' );
	}

	/**
	 * Get the YouTube API key from the options.
     *
	 * @param string $video_id YouTube video ID.
	 * @return array
	 */
	public function get_youtube_video_data( $video_id ) {

		$api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id={$video_id}&key={$this->api_key}";

		$response = wp_remote_get( $api_url );

		if ( is_wp_error( $response ) ) {
			return null;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $data['error'] ) ) {
			return [
				'error'   => true,
				'code'    => $data['error']['code'] ?? 0,
				'message' => $data['error']['message'] ?? '',
			];
		}

		if ( empty( $data['items'][0] ) ) {
			return [];
		}

		$video = $data['items'][0];

		$video_data = [
			'name'         => $video['snippet']['title'] ?? 'YouTube Video',
			'description'  => $video['snippet']['description'] ?? '',
			'thumbnailUrl' => [
				$video['snippet']['thumbnails']['high']['url'],
				$video['snippet']['thumbnails']['medium']['url'] ?? '',
				$video['snippet']['thumbnails']['default']['url'] ?? '',
			],
			'uploadDate'   => $video['snippet']['publishedAt'] ?? '',
			'duration'     => $video['contentDetails']['duration'] ?? 'PT0S', // Default to 0 seconds if not available
			'embedUrl'     => get_the_permalink( $this->post_id ),
			'contentUrl'   => "https://www.youtube.com/watch?v={$video_id}",
			'embedType'    => 'VideoObject',
			'videoId'      => $video_id,
		];
			return $video_data;
	}

	/**
	 * Register actions.
	 */
	public function generate_video_schema() {

		$supported_post_types = $this->get_supported_post_types();

		if ( ! is_singular( $supported_post_types ) ) {
			return;
		}

		// Set the YouTube API key.
		$this->set_the_youtube_api_key();

		if ( empty( $this->api_key ) ) {
			return;
		}

		global $post;
		$this->post_id = $post->ID;
		$content       = $post->post_content;

		// Match YouTube URLs
		preg_match_all( '#https?://(?:www\.)?(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([\w\-]{11})#', $content, $matches );

		if ( empty( $matches[1] ) ) {
			return;
		}

		$videos = [];

		foreach ( array_unique( $matches[1] ) as $video_id ) {

			$video_data = [];

			$cache_key  = 'bytvsi_data_' . $video_id;
			$video_data = get_transient( $cache_key );

			if ( empty( $video_data ) ) {
				$video_data = $this->get_youtube_video_data( $video_id );
				if ( isset( $video_data['name'] ) && ! empty( $video_data['name'] ) ) {
					set_transient( $cache_key, $video_data, MONTH_IN_SECONDS );
				} else {
					$video_data = [];
				}
			}

			// echo "<pre style='background-color: #f9f9f9; padding: 10px; border: 1px solid #ddd;'>";
			// print_r( $video_data );
			// echo '</pre>';

			if ( ! empty( $video_data ) ) {
				$videos[] = array_merge([
					'@type' => 'VideoObject',
				], $video_data);

			}
		}

		if ( empty( $videos ) ) {
			return;
		}

		// Output the JSON-LD
		$schema = [
			'@context' => 'https://schema.org',
			'@graph'   => $videos,
		];

		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
	}
}
