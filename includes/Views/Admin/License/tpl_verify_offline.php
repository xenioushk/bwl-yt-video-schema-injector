<?php
/**
 * The template for plugin offline license verification.
 *
 * @package BwlFaqManager
 * @since 1.0.0
 */

if ( isset( $_GET['bwlverify'] ) && $_GET['bwlverify'] === 'offline' ) {

	$msg = '';

	if ( isset( $_POST['offline_verification'] ) && $_POST['offline_verification'] == 'offline_code' && ! empty( $_POST['bwlofflinecode'] ) ) {

		$decodeOfflineCode = base64_decode( trim( $_POST['bwlofflinecode'] ) );

		$explodePurchaseInfo = explode( '|', $decodeOfflineCode );

		$msg = esc_html__( 'Invalid offline code!', 'bwl-adv-faq' );

		if ( count( $explodePurchaseInfo ) > 1 ) {

			$purchaseData = [];

			foreach ( $explodePurchaseInfo as $data ) {

				list($tag, $value) = explode( '=', $data );

				$purchaseData[ $tag ] = $value;
			}
			if ( isset( $purchaseData['item'] ) && KDESKADDON_PRODUCT_ID == $purchaseData['item'] ) {
				delete_option( KDESKADDON_PURCHASE_VERIFIED_KEY );
				delete_option( KDESKADDON_PURCHASE_INFO_KEY );

				update_option( KDESKADDON_PURCHASE_VERIFIED_KEY, 1 );
				update_option( KDESKADDON_PURCHASE_INFO_KEY, $purchaseData );

				header( 'Location: ' . admin_url( 'themes.php?page=kdesk-license-page' ) );
				exit();
			}
		}
	} else {
		$msg = esc_html__( 'Please enter the offline code!', 'bwl-adv-faq' );
	}


	?>

<h3><?php esc_html_e( 'Offline Verification', 'bwl-adv-faq' ); ?>:</h3>
<?php echo ( $msg != '' ) ? "<p class='offline-msg'>$msg</p>" : ''; ?>
<form method="post" action="#"
  action="<?php echo get_admin_url(); ?>themes.php?page=kdesk-license-page&bwlverify=offline"
  id="offline_verify_purchase">
  <input type="hidden" name="offline_verification" value="offline_code"><textarea id="bwlofflinecode"
    name="bwlofflinecode" value=""
    placeholder="<?php esc_html_e( 'Enter offline verification code here.', 'bwl-adv-faq' ); ?>" cols="60"
    rows="4"></textarea>
  <input type="submit" value="<?php esc_html_e( 'Active License', 'bwl-adv-faq' ); ?>" class="button button-primary"
    id="offline_verify">
</form>

<p>
  <strong>I have the </strong><a href="<?php echo admin_url( 'themes.php?page=kdesk-license-page' ); ?>">
    purchase
    code</a>.
</p>

<?php
}

?>
