<?php
use BwlFaqManager\Base\BafAdminHelpers;

?>
<div class="wrap" id="baf_faq_sorting_container">

    <h2><?php echo esc_html( $page_title ); ?></h2>
    <ul class="baf-sort-menu">

    <?php
	foreach ( $sort_menu_items as $item ) {
		printf(
			'<li><a href="%s" class="%s">%s</a></li>',
			esc_html( $item['link'] ),
			esc_html( $item['active_class'] ),
			esc_html( $item['title'] )
		);
	}

    $page_data    = $this->page_data ?? [];
    $content_show = 1;
    if ( ! empty( $page_data ) ) {
        $content_show = $page_data['content_show'] ?? 1;
        $content_msg  = $page_data['content_msg'] ?? '';
    }


	?>
    </ul>

    <?php

	if ( $content_show ) :

		?>

    <p id="sort-status" data-sort_subtitle="<?php echo esc_html( $page_subtitle ); ?>">
		<?php
		echo esc_html( $page_subtitle );
		echo BafAdminHelpers::set_youtube_url( 'https://youtu.be/Ms4eDclYeps' ); //phpcs:ignore
		?>
    </p>

    <div class="faq-sort-container">

		<?php
		require_once $tpl_partial;

		?>

    </div> <!-- end .faq-sort-container  -->


    <input type="button" value="<?php esc_html_e( 'Save', 'bwl-adv-faq' ); ?>" class="button button-primary button-large"
    id="baf_save_sorting" name="baf_save_sorting" data-sort_filter="<?php echo esc_html( $baf_filter_page ); ?>">
    <?php else : ?>
    <p><?php echo $content_msg; ?></p>
    <?php endif; ?>
</div> <!--  end .wrap  -->
