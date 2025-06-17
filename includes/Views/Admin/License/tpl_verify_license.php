<?php
/**
 * The template for plugin license form and data.
 *
 * @package KDESKADDON
 * @since 1.0.0
 */
use KDESKADDON\Helpers\Common;

?>
<div class="wrap" id="bwl-theme-product-license">

  <h2><?php echo $pluginLicenseData['title'] . ' License Page'; ?></h2>

  <div id="loader"></div>

  <?php if ( $pluginLicenseData['status'] == 2 ) { ?>

  <p class="developer-info">

    No license activation is required.

  </p>

  <?php } elseif ( $pluginLicenseData['status'] == 0 ) { ?>

  <div class="license_form_container">
    <h4>
      To unlock premium options
      and support of <?php echo $pluginLicenseData['title']; ?>, you need to activate your copy of the theme.
    </h4>

    <?php

		if ( isset( $_GET['bwlverify'] ) && $_GET['bwlverify'] == 'offline' ) {

			require_once KDESKADDON_VIEWS_DIR . 'Admin/License/tpl_verify_offline.php';
		} else {
			?>

    <h3><?php esc_html_e( 'Add Purchase Code', 'kdesk_vc' ); ?></h3>
    <form action="#" id="verify_purchase">
      <input type="text" value="" name="purchase_code" id="purchase_code"
        placeholder="<?php esc_html_e( 'Purchase code', 'kdesk_vc' ); ?>">
      <input type="submit" value="<?php esc_html_e( 'Active License', 'kdesk_vc' ); ?>" id="verify"
        class="button button-primary">

    </form>

    <p>
      <strong>I have the </strong><a
        href="<?php echo admin_url( 'themes.php?page=kdesk-license-page&bwlverify=offline' ); ?>">offline
        verification code</a>.
    </p>

    <?php } ?>

    <p class="license_form_container__youtube_link" target="_blank">Check this <a href="https://youtu.be/H5TKfT-oWvc"
        title="Learn more about license activation."><span class="dashicons dashicons-youtube"></span>video tutorial</a>
      and learn more about license
      activation. </p>
    <p>
      <strong><?php esc_html_e( 'Do you need offline verification code or any help?', 'kdesk_vc' ); ?></strong> <a
        href="<?php echo $pluginLicenseData['supportLink']; ?>" target="_blank">
        <?php esc_html_e( 'Send a message', 'kdesk_vc' ); ?></a>.
    </p>

  </div>

  <?php } elseif ( $pluginLicenseData['status'] == 1 ) { ?>

  <div class="license_info_container">
    <h3><?php esc_html_e( 'License Information', 'kdesk_vc' ); ?></h3>

    <?php

		$purchaseInfo       = $pluginLicenseData['info'];
		$supportRenwalInfo  = Common::get_renewal_days_left( $purchaseInfo['supported_until'] );
		$supportRenwalClass = $supportRenwalInfo['status'] == 1 ? 'support-valid' : 'support-expired';

		?>

    <ul class="plugin_purchase_info">
      <li><strong><?php esc_html_e( 'License Type', 'kdesk_vc' ); ?>:</strong>
        <span><?php echo $purchaseInfo['license']; ?></span>
      </li>
      <li><strong><?php esc_html_e( 'Purchase Date', 'kdesk_vc' ); ?>:</strong>
        <span>
          <?php echo Common::beautify_date( $purchaseInfo['sold_at'] ); //phpcs:ignore ?>
        </span>
      </li>
      <li><strong><?php esc_html_e( 'Support Until', 'kdesk_vc' ); ?>:</strong>
        <span>
          <?php echo Common::beautify_date( $purchaseInfo['supported_until'] );  //phpcs:ignore?>
        </span>
        <span class="<?php echo $supportRenwalClass; ?>"><?php echo $supportRenwalInfo['msg']; ?></span>
      </li>
    </ul>

    <button id="remove_license" class="button button-primary"
      data-verify_hash="<?php echo $purchaseInfo['verify_hash']; ?>"><?php esc_html_e( 'Remove License', 'kdesk_vc' ); ?></button>

    <?php if ( common::get_renewal_days_left( $purchaseInfo['supported_until'] )['status'] == 0 ) : ?>
    <a href="<?php echo KDESKADDON_PRODUCT_URL; ?>" class="button button-primary"
      target="_blank"><?php esc_html_e( 'Renew License', 'kdesk_vc' ); ?></a>
    <?php endif; ?>

  </div>

  <?php

	} else {
			// Do Nothing
	}

	?>


  <div class="license_faq_container">
    <h3 class="license_faq_title">License F.A.Q</h3>
    <ul class="license_faqs">

      <?php foreach ( $licenseFaqs as $faq ) : ?>
      <li>
        <p class="question">
          <?php echo $faq['ques']; ?>
        </p>
        <p class="answer">
          <?php echo $faq['ans']; ?>
        </p>
      </li>
      <?php endforeach; ?>

    </ul>
  </div>

</div>
