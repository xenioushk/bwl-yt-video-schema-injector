<!-- Likes Count -->

<div class="baf-analytics-list__card">

    <!-- Top Liked -->

    <h3><span class="dashicons dashicons-thumbs-up"></span><?php esc_html_e( 'Top Liked', 'bwl-adv-faq' ); ?>
    <small>Last 7 days</small>
    </h3>
    <ul class="with-count">
    <?php

	if ( $popularFAQPosts['postData']->have_posts() ) {
		while ( $popularFAQPosts['postData']->have_posts() ) {
			$popularFAQPosts['postData']->the_post();

			$totalLikes = get_post_meta( get_the_ID(), 'baf_votes_count', true );

			$title     = get_the_title();
			$permalink = get_the_permalink();

			echo "<li><a href='$permalink' target='_blank'>$title</a><span class='count'>$totalLikes </span></li>";
		}
		wp_reset_postdata();
	} else {
		echo '<li>' . esc_attr__( 'There is no data available.', 'bwl-adv-faq' ) . '</li>';
	}
	?>
    </ul>


    <!-- Recently Liked -->

    <h3><span class="dashicons dashicons-thumbs-up"></span><?php esc_html_e( 'Recently Liked', 'bwl-adv-faq' ); ?>
    <small>Last 7 days</small>
    </h3>
    <ul class="with-count">
    <?php

	if ( count( $recentlyLikedFAQPosts ) > 0 ) {
		foreach ( $recentlyLikedFAQPosts as $post ) {

			$post_id = $post['post_id']; // Replace with the actual post ID

			$postInfo = get_post( $post_id );

			echo "<li><a href='" . get_permalink( $post_id ) . "' target='_blank'>$postInfo->post_title</a><span class='count'>" . $post['tv'] . '</span></li>';
		}
		wp_reset_postdata();
	} else {
		echo '<li>' . esc_attr__( 'There is no data available.' ) . '</li>';
	}
	?>
    </ul>

</div>
