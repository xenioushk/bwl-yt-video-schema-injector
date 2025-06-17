<?php
/**
 * The template for displaying plugin addons list.
 *
 * @package BwlFaqManager
 * @since 1.0.0
 */
?>

<div class="wrap baf-addon-page-wrap">

    <h2><?php echo $page_title; ?></h2>

    <div class="bwl-plugin-grid bwl-plugin-grid--cols-3">

    <?php foreach ( $addons as $addon ) : ?>

    <div class="baf-addon-list__card">

        <h3><?php echo $addon['title']; ?></h3>

		<?php echo ( isset( $addon['preview'] ) ) ? "<img src={$addon['preview']}>" : ''; ?>

		<?php echo ( isset( $addon['info'] ) ) ? '<p>' . $addon['info'] . '</p>' : ''; ?>

        <div class="btn-container">

        <a href="<?php echo $addon['download']; ?>" target="_blank"
            class="btn btn--download"><?php esc_html_e( 'Download', 'bwl-adv-faq' ); ?></a>
        <a href="<?php echo $addon['doc']; ?>" target="_blank"
            class="btn btn--documentation"><?php esc_html_e( 'Documentation', 'bwl-adv-faq' ); ?>
        </a>

        </div>
    </div>
    <?php endforeach ?>

    </div>


    <p>
    If you need help with the plugin, give our <strong><?php echo BAF_PLUGIN_TITLE; ?></strong> documentation a
    read.
    If you have any questions that are beyond the scope of this help file, please feel free to email via my user page
    contact form <a href="<?php echo BAF_PRODUCT_AUTHOR_PROFILE; ?>">here</a>.
    </p>

</div>
