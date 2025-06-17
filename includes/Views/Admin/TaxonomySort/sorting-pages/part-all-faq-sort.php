<ul id="bwl_faq_items">

    <?php
    $args = [
		'post_type'      => BAF_POST_TYPE,
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
    ];

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			?>

    <li id="<?php the_id(); ?>" class="menu-item">
    <dl class="menu-item-bar">
        <dt class="menu-item-handle">
        <span class="menu-item-title"><?php the_title(); ?></span>
        </dt>
    </dl>
    <ul class="menu-item-transport"></ul>
    </li>

			<?php
    endwhile;
    endif;
    wp_reset_postdata();
	?>

</ul> <!-- end #bwl_faq_items  -->
