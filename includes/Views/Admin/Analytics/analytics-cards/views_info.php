<!-- Recent Viewed FAQs -->

<div class="baf-analytics-list__card">

    <!-- Top Viewed FAQs -->
    <h3><span class="dashicons dashicons-visibility"></span><?php esc_html_e( 'Top Viewed', 'bwl-adv-faq' ); ?><small>Last
        7 days</small>
    </h3>
    <ul class="with-count">
    <?php

    if ( $topViewedFAQPosts['postData']->have_posts() ) {
		while ( $topViewedFAQPosts['postData']->have_posts() ) {
			$topViewedFAQPosts['postData']->the_post();

			$totalViews = get_post_meta( get_the_ID(), 'baf_views_count', true );

			$title     = get_the_title();
			$permalink = get_the_permalink();

			echo "<li><a href='$permalink' target='_blank'>$title</a><span class='count'>$totalViews </span></li>";
		}
		wp_reset_postdata();
    } else {
		echo '<li>' . esc_attr__( 'There is no data available.', 'bwl-adv-faq' ) . '</li>';
    }
    ?>
    </ul>

    <h3><span
        class="dashicons dashicons-visibility"></span><?php esc_html_e( 'Recent Viewed', 'bwl-adv-faq' ); ?><small>Last
        7 days</small>
    </h3>
    <ul class="with-count">

    <?php

    if ( count( $recentViewedFAQPosts ) > 0 ) {
		foreach ( $recentViewedFAQPosts as $post ) {

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
