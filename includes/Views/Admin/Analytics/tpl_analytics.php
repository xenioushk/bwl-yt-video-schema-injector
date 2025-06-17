<div class="wrap baf-analytics-page-wrap">

  <h2><?php echo BAF_PLUGIN_TITLE; ?> <?php esc_html_e( 'Analytics', 'bwl-adv-faq' ); ?></h2>

  <div class="bwl-plugin-grid bwl-plugin-grid--cols-4">

    <!-- Include All The Cards -->
    <?php

    foreach ( $analytics_cards as $card ) {
		require_once BAF_VIEWS_DIR . "Admin/Analytics/analytics-cards/{$card}.php";
    }

    ?>


    <!-- Recent Published FAQs -->

    <div class="baf-analytics-list__card">

      <h3><span class="dashicons dashicons-edit"></span><?php esc_html_e( 'Recent Published', 'bwl-adv-faq' ); ?>
      </h3>
      <ul class="with-count">

        <?php

        if ( $latestFAQPosts['postData']->have_posts() ) {
			while ( $latestFAQPosts['postData']->have_posts() ) {
				$latestFAQPosts['postData']->the_post();

				$title     = get_the_title();
				$permalink = get_the_permalink();

				echo "<li><a href='{$permalink}' target='_blank'>$title</a> </li>";
			}
			wp_reset_postdata();
        } else {
			echo '<li>' . esc_attr__( 'There is no data available.', 'bwl-adv-faq' ) . '</li>';
        }
        ?>

      </ul>

    </div>

    <?php if ( ! empty( $pluginSupportKB ) ) : ?>

    <div class="baf-analytics-list__card">

      <h3><span class="dashicons dashicons-sos"></span><?php esc_html_e( 'Docs & Support', 'bwl-adv-faq' ); ?>
      </h3>
      <ul class="with-count">
        <?php
		foreach ( $pluginSupportKB as $post ) :
            echo "<li><a href='" . $post['permalink'] . "' target='_blank'>" . $post['title'] . '</a></li>';
            endforeach;
		?>
      </ul>

    </div>

    <?php endif; ?>

    <?php if ( ! empty( $bwlBlogPosts ) ) : ?>

    <div class="baf-analytics-list__card">

      <h3><?php esc_html_e( 'Latest Blogs', 'bwl-adv-faq' ); ?></h3>
      <ul class="with-count">
        <?php
		foreach ( $bwlBlogPosts as $post ) :
            echo "<li><a href='" . $post['permalink'] . "' target='_blank'>" . $post['title'] . '</a></li>';
            endforeach;
		?>
      </ul>

    </div>
    <?php endif; ?>

  </div>

</div>
