<?php
namespace BwlFaqManager\Base;

use Walker_CategoryDropdown;

/**
 * Class Custom_Walker_CategoryDropdown
 *
 * Custom walker class for category dropdown.
 *
 * @package BwlFaqManager
 */
class Custom_Walker_CategoryDropdown extends Walker_CategoryDropdown {

    /**
     * Start the element output.
     *
     * @param string $output Output string.
     * @param object $category Category object.
     * @param int    $depth Depth of the category.
     * @param array  $args Arguments passed to the walker.
     * @param int    $id ID of the category.
     */
    public function start_el( &$output, $category, $depth = 0, $args = [], $id = 0 ) {
        $pad = str_repeat( '&nbsp;', $depth * 3 );

        $term_id = esc_attr( $category->term_id );
        $count   = esc_attr( $category->count );
        $name    = esc_html( $category->name );
        $output .= sprintf(
            '<option class="level-%1$s" value="%2$s" data-term_id="%3$s" data-count="%4$s">%5$s%6$s</option>',
            $depth,
            esc_attr( $category->slug ),
            $term_id,
            $count,
            $pad,
            $name
        );
    }
}