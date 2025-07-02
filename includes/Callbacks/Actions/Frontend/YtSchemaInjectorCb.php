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

		if ( empty( $data['items'][0] ) ) {
			return [];
		}

		$video = $data['items'][0];
		return [
			'title'       => $video['snippet']['title'],
			'description' => $video['snippet']['description'],
			'thumbnail'   => $video['snippet']['thumbnails']['high']['url'],
			'uploadDate'  => $video['snippet']['publishedAt'],
			'duration'    => $video['contentDetails']['duration'], // ISO 8601 format
		];
	}

	/**
	 * Register actions.
	 */
	public function generate_video_schema() {

		if ( ! is_singular( 'post' ) ) {
			return;
		}

		// Set the YouTube API key.
		$this->set_the_youtube_api_key();

		if ( empty( $this->api_key ) ) {
			return [];
		}

		global $post;
		$content = $post->post_content;

		// Match YouTube URLs
		preg_match_all( '#https?://(?:www\.)?(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([\w\-]{11})#', $content, $matches );

		if ( empty( $matches[1] ) ) { return;
		}

		$videos = [];

		foreach ( array_unique( $matches[1] ) as $video_id ) {

			$video_data = [];

			if ( ! empty( $this->api_key ) ) {

				$cache_key  = 'bwlytvsi_' . $video_id;
				$video_data = get_transient( $cache_key );

				if ( empty( $video_data ) ) {
					$video_data = $this->get_youtube_video_data( $video_id );
					set_transient( $cache_key, $video_data, MONTH_IN_SECONDS );
				}
			} else {

				$response = wp_remote_get( "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v={$video_id}&format=json" );
				$data     = json_decode( wp_remote_retrieve_body( $response ) );

				$title      = $data->title ?? 'YouTube Video';
				$video_data = [
					'title'       => $title,
					'description' => $data->description ?? '',
					'thumbnail'   => $data->thumbnail_url ?? '',
					'uploadDate'  => $data->upload_date ?? '',
					'duration'    => $data->duration ?? 'PT0S', // Default to 0 seconds if not available
				];

			}

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
