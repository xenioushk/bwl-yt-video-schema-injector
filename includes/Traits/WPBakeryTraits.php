<?php
namespace KDESKADDON\Traits;

trait WPBakeryTraits {
    /**
     * Get the wpbakery content tags
     *
     * @example h1, h2, h3, h4, h5, h6, p
     * @return array
     */
    public function get_content_tags() {

        $tags = [
            'Select' => '',
            'h1'     => 'h1',
            'h2'     => 'h2',
            'h3'     => 'h3',
            'h4'     => 'h4',
            'h5'     => 'h5',
            'h6'     => 'h6',
            'p'      => 'p',
        ];

        return $tags;
    }

    /**
     * Get the wpbakery boolean tags
     *
     * @example Yes, No
     * @return array
     */
    public function get_boolean_tags() {

        $tags = [
            'Select' => '',
			'Yes'    => '1',
			'No'     => '0',
        ];

        return $tags;
    }

    /**
     * Get the columns tags
     *
     * @example one column, two columns, three columns
     * @return array
     */
    public function get_columns_tags() {

        $tags = [
            esc_html__( 'Select', 'kdesk_vc' )        => '',
			esc_html__( 'One Column', 'kdesk_vc' )    => 1,
			esc_html__( 'Two Columns', 'kdesk_vc' )   => 2,
			esc_html__( 'Three Columns', 'kdesk_vc' ) => 3,
        ];

        return $tags;
    }

    /**
     * Get the wpbakery alignment tags
     *
     * @example Left, Center, Right, Justify
     * @return array
     */
    public function get_alignment_tags() {

        $tags = [
            'Select'  => '',
			'Left'    => 'left',
			'Center'  => 'center',
			'Right'   => 'right',
			'Justify' => 'justify',
        ];

        return $tags;
    }

    /**
     * Get the view tags
     *
     * @example list, box
     * @return array
     */
    public function get_view_tags() {

        $tags = [
            esc_html__( 'Select', 'kdesk_vc' )     => '',
            esc_html__( 'Lists View', 'kdesk_vc' ) => 0,
            esc_html__( 'Boxed View', 'kdesk_vc' ) => 1,
        ];

        return $tags;
    }

    /**
     * Get the list types tags
     *
     * @example rounded, rectangle, iconized, accordion, none
     * @return array
     */
    public function get_list_types_tags() {

        $tags = [
            esc_html__( 'Select', 'kdesk_vc' )    => '',
            esc_html__( 'Rounded', 'kdesk_vc' )   => 'rounded',
            esc_html__( 'Rectangle', 'kdesk_vc' ) => 'rectangle',
            esc_html__( 'Iconized', 'kdesk_vc' )  => 'iconized',
            esc_html__( 'Accordion', 'kdesk_vc' ) => 'accordion',
            esc_html__( 'None', 'kdesk_vc' )      => 'none',
        ];

        return $tags;
    }

    /**
     * Get the layouts for the wpbakery.
     *
     * @return array
     */
    public function get_layouts() {

        $layout = [
            'Select'                              => '',
			esc_html__( 'Layout 01', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 02', 'kdesk_vc' ) => 'layout_2',
        ];
        return $layout;
    }

    /**
     * Get the counter delay time
     *
     * @return array
     */
    public function get_counter_delay() {

        $delay = [
            '5'   => '5',
            '10'  => '10',
            '15'  => '15',
            '20'  => '20',
            '25'  => '25',
            '30'  => '30',
            '35'  => '35',
            '40'  => '40',
            '45'  => '45',
            '50'  => '50',
            '60'  => '60',
            '100' => '100',
        ];
        return $delay;
    }

    /**
     * Get the counter delay interval
     *
     * @return array
     */
    public function get_delay_interval() {

        $interval = [
            '1 Second'   => '1000',
            '2 Seconds'  => '2000',
            '3 Seconds'  => '3000',
            '5 Seconds'  => '5000',
            '10 Seconds' => '10000',
            '20 Seconds' => '20000',
            '30 Seconds' => '30000',
        ];
        return $interval;
    }


    /**
     * Get the orderby tags
     *
     * @return array
     */
    public function get_orderby_tags() {

        $tags = [
            esc_html__( 'ID', 'kdesk_vc' )              => 'ID',
            esc_html__( 'Title', 'kdesk_vc' )           => 'title',
            esc_html__( 'Date', 'kdesk_vc' )            => 'date',
            esc_html__( 'Recent Modified', 'kdesk_vc' ) => 'modified',
            esc_html__( 'Random', 'kdesk_vc' )          => 'rand',
            esc_html__( 'Custom Sort', 'kdesk_vc' )     => 'custom_order',
        ];
        return $tags;
    }

    /**
     * Get the order tags
     *
     * @return array
     */
    public function get_order_tags() {

        $tags = [
            esc_html__( 'Ascending', 'kdesk_vc' )  => 'ASC',
            esc_html__( 'Descending', 'kdesk_vc' ) => 'DESC',
        ];
        return $tags;
    }
}
