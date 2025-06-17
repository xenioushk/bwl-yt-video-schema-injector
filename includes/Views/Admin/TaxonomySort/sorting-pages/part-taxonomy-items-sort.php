<?php

use BwlFaqManager\Base\Custom_Walker_CategoryDropdown;

$taxnomyType     = 'category';
$taxnomyTypeText = 'Category';

if ( $baf_filter_page === 'topics' ) {
    $taxnomyType     = 'topics';
	$taxnomyTypeText = 'Topics';
}

$bafTaxonomyArgs = [
    'taxonomy'          => 'advanced_faq_' . $taxnomyType,
    'hide_empty'        => 0,
    'orderby'           => apply_filters( 'baf_tax_orderby', BAF_SUB_CAT_ENABLE_STATUS ? 'term_order' : 'title' ),
    'order'             => 'ASC',
    'hierarchical'      => 1,
    'show_option_none'  => esc_html__( 'Select', 'bwl-adv-faq' ) . ' ' . $taxnomyTypeText,
    'option_none_value' => '', // Set the value for the "none" option.
    'name'              => 'baf_sort_faq_taxonomy',
    'id'                => 'baf_sort_faq_taxonomy',
    'class'             => 'postform', // WordPress-style dropdown class.
    'echo'              => true,      // Output the dropdown directly.
    'walker'            => new Custom_Walker_CategoryDropdown(),
];

?>

<label for="baf_sort_faq_<?php echo esc_html( $taxnomyType ); ?>">
    <?php echo esc_html__( 'FAQ', 'bwl-adv-faq' ) . ' ' . esc_html( $taxnomyTypeText ); ?>
</label>

<?php

wp_dropdown_categories( $bafTaxonomyArgs );

?>

<ul id="bwl_faq_items"></ul>
