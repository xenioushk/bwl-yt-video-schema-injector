<ul id="categories-sortable" class="sortable-categories">

  <?php
	$terms = get_terms([
        'taxonomy'   => BAF_TAX_CAT,
        'hide_empty' => false,
        'orderby'    => 'term_order', // Important to respect order
        'parent'     => 0,
	]);

	function render_terms_hierarchy( $terms ) {
		foreach ( $terms as $term ) {

			echo '<li data-id="' . $term->term_id . '">' . esc_html( $term->name );

			$child_terms = get_terms([
                'taxonomy'   => BAF_TAX_CAT,
                'hide_empty' => false,
                'parent'     => $term->term_id,
                'orderby'    => 'term_order',
			]);

			if ( ! empty( $child_terms ) ) {
				echo '<ul>';
				render_terms_hierarchy( $child_terms );
				echo '</ul>';
			}

			echo '</li>';
		}
	}

	render_terms_hierarchy( $terms );

	?>
</ul>
