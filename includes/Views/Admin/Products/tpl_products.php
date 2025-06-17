<?php
/**
 * The template for displaying plugin addons list.
 *
 * @package BwlFaqManager
 * @since 1.0.0
 */
?>

<div class="wrap baf-addon-page-wrap">

    <!-- Premium Plugins  -->
    <h2><?php echo esc_html( $page_title ); ?></h2>
    <h3>Premium WordPress Plugins</h3>
    <div class="bwl-plugin-grid bwl-plugin-grid--cols-4">

    <?php
    foreach ( $wp_plugins as $plugin ) :
        ?>

    <div class="bwl-product-card">

		<?php

		$title     = $plugin['title'] ?? '';
		$preview   = $plugin['preview'] ?? '';
		$btnurl    = $plugin['btnurl'] ?? '';
        $reg_price = $plugin['reg_price'] ?? 0; // Regular price
		$new_price = $plugin['new_price'] ?? 0; // New price

        if ( $reg_price !== 0 && $new_price !== 0 ) {
            // Discount percentage
			$discount_percent = floor( ( $reg_price - $new_price ) / $reg_price * 100 );

			// Price badges
			echo '<div class="bwl-product-card__price-container">';
			printf( '<span class="bwl-product-card__price--reg">$%s</span>', esc_html( $reg_price ) );
			printf( '<span class="bwl-product-card__price--new">$%s</span>', esc_html( $new_price ) );
			printf( '<span class="bwl-product-card__price--badge">%s</span>', esc_html( $discount_percent ) . '% OFF' );
			echo '</div>';

		}

        if ( ! empty( $preview ) ) {
            printf( '<a href="%s" target="_blank"><img src="%s" alt="%s"></a>', esc_html( $btnurl ), esc_html( $preview ), esc_html( $title ) );
        }
        echo '<div class="bwl-product-card__btn-container">';
        printf('<a href="%s" target="_blank"
          class="bwl-product-card__button bwl-product-card__button--download">%s</a>', esc_html( $btnurl ), esc_html__( 'Download', 'kdesk_vc' ));
        echo '</div>';
		?>

    </div>
    <?php endforeach ?>

    </div>

    <!-- Premium Themes  -->

    <h3>Premium WordPress Themes</h3>
    <div class="bwl-plugin-grid bwl-plugin-grid--cols-4">

    <?php
    foreach ( $wp_themes as $theme ) :

        ?>

    <div class="bwl-product-card">

		<?php

		$title     = $theme['title'] ?? '';
		$preview   = $theme['preview'] ?? '';
		$btnurl    = $theme['btnurl'] ?? '';
        $reg_price = $theme['reg_price'] ?? 0; // Regular price
		$new_price = $theme['new_price'] ?? 0; // New price

        if ( $reg_price !== 0 && $new_price !== 0 ) {
            // Discount percentage
			$discount_percent = floor( ( $reg_price - $new_price ) / $reg_price * 100 );

			// Price badges
			echo '<div class="bwl-product-card__price-container">';
			printf( '<span class="bwl-product-card__price--reg">$%s</span>', esc_html( $reg_price ) );
			printf( '<span class="bwl-product-card__price--new">$%s</span>', esc_html( $new_price ) );
			printf( '<span class="bwl-product-card__price--badge">%s</span>', esc_html( $discount_percent ) . '% OFF' );
			echo '</div>';

		}

        if ( ! empty( $preview ) ) {
            printf( '<a href="%s" target="_blank"><img src="%s" alt="%s"></a>', esc_html( $btnurl ), esc_html( $preview ), esc_html( $title ) );
        }
        echo '<div class="bwl-product-card__btn-container">';
        printf('<a href="%s" target="_blank"
          class="button button-primary">%s</a>', esc_html( $btnurl ), esc_html__( 'Download', 'kdesk_vc' ));
            echo '</div>';
		?>

    </div>
    <?php endforeach ?>

    </div>


</div>
