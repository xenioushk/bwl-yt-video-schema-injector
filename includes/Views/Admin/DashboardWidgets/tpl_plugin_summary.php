<?php
use BwlFaqManager\Helpers\Common;

$is_license_activated = $license_info['status'] ?? 0;

if ( $is_license_activated ) {
	$license_status = [
        'class' => 'activated bwl-text-bold bwl-text-success',
        'text'  => esc_attr__( 'Activated', 'bwl-adv-faq' ),
	];

		$support_renewal_info = Common::get_renewal_days_left( $license_info['info']['supported_until'] );
		$days_left            = $support_renewal_info['days_left'];
    $support_btn_class        = 'bwl-text-bold bwl-text-success';
	if ( $days_left > 0 ) {
		$support_msg      = '🕒 ' . sprintf( esc_html__( 'Remaining %s days of support.', 'bwl-adv-faq' ), $days_left );
		$support_url      = BAF_PRODUCT_SUPPORT;
		$support_btn_text = 'Request Support';
	} else {
		$support_msg       = '⚠️ ' . esc_html__( 'Support period expired! ', 'bwl-adv-faq' );
		$support_url       = BAF_PRODUCT_URL;
		$support_btn_text  = 'Renew Support';
		$support_btn_class = 'bwl-text-bold bwl-text-error';
	}
} else {
	$license_status = [
        'class' => 'bwl-text-error bwl-text-bold',
        'text'  => esc_attr__( 'Verify Now', 'bwl-adv-faq' ),
	];
}
?>
<div class="baf-plugin-summary-dash-widget">

    <ul class="items-container">
    <li class="item bwl-text-center">
        <span class="dashicons">📝</span>
        <span class="count"><?php echo $faqs_count; ?></span>
        <span class="title">FAQ Posts</span>
    </li>

    <li class="item bwl-text-center">
        <span class="dashicons">❤️</span>
        <span class="count"><?php echo $likes_count['totalLikes']; ?></span>
        <span class="title">FAQ Likes</span>
    </li>

    <li class="item bwl-text-center">
        <span class="dashicons">🤩</span>
        <span class="count"><?php echo $views_count['totalViews']; ?></span>
        <span class="title">FAQ Views</span>
    </li>

    <li class="item bwl-text-center">
        <span class="title text text-primary">🔐 License Status</span>
        <span>

        <?php
		printf(
            '<a class="%s" href="%s">%s</a>',
            $license_status['class'],
            admin_url( 'edit.php?post_type=' . BAF_POST_TYPE . '&page=baf-license' ),
            $license_status['text'],
		);
		?>

        </span>
    </li>

    <?php

    if ( $is_license_activated ) :

		?>

    <li class="item bwl-text-center">
        <span class="title">

        <?php echo $support_msg;  //phpcs:ignore?>

        </span>
		<?php
		printf(
            '<a class="%s" href="%s" target="_blank">%s</a>',
            $support_btn_class,
            $support_url,
            $support_btn_text,
		);

    endif;

	if ( $plugin_usage_info['status'] ) :

		?>

    <li class="item bwl-text-center">
        <span class="title text-center">🌟 Like the plugin?</span>
        <a href="<?php echo BAF_PRODUCT_URL; ?>" class="bwl-text-bold" target="_blank">
        Review Plugin
        </a>
    </li>
    <?php endif; ?>
    </ul>

    <?php
    if ( $plugin_usage_info['status'] ) {
		printf( '<h4 class="bwl-text-center">%s</h4>', $plugin_usage_info['msg'] );
    }
    ?>

    <div class="baf-dash-widget-footer">

    <?php foreach ( $footer_links as $key => $link ) : ?>
    <a href="<?php echo esc_url( $link['url'] ); ?>" <?php echo isset( $link['nt'] ) ? 'target="_blank"' : ''; ?>>
		<?php echo esc_html( $link['title'] ); ?>
    </a>
		<?php
		echo $key < count( $footer_links ) - 1 ? ' | ' : '';
		?>

    <?php endforeach; ?>
    </div>


    <?php
    if ( $offer_info['status'] ) {
		printf( '<div class="bwl-dash-discount-notice"><h4 class="bwl-text-center">%s</h4></div>', $offer_info['msg'] );
    }
    ?>

</div>
