<?php
namespace BwlFaqManager\Base;

/**
 * Class FaqInlineJs
 *
 * This class handles the inline JavaScript for the FAQ manager.
 *
 * @package BwlFaqManager
 */
class FaqInlineJs {

	/**
	 * FaqInlineJs constructor.
	 */
	public function register() {
		add_action( 'wp_head', [ $this, 'setInlineJs' ] );
	}

	function setInlineJs() {
		ob_start();
		?>
<script type="text/javascript">

</script>

		<?php
		echo ob_get_clean();
	}
}
