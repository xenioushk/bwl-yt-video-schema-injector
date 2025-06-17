<?php
namespace BwlFaqManager\Controllers\Database;

use Xenioushk\BwlPluginApi\Api\Database\TableManagerApi;
/**
 * Class for plugin tables.
 *
 * @since: 1.1.6
 * @package BwlFaqManager
 */
class Tables {

    /**
     *  Instance of the WPDB.
     *
     * @var object $wpdb
     */
    private $wpdb;

    /**
     *  Instance of the Table Manager API.
     *
     * @var object $table_manager_api
     */
    private $table_manager_api;

    /**
     * Constructor for the class.
     *
     * @param object $wpdb  Instance of the WPDB.
     */
    public function __construct( $wpdb ) {
        $this->wpdb = $wpdb;
    }

    /**
	 * Register shortcode.
	 */
    public function register() {

        // Initialize API.
        $this->table_manager_api = new TableManagerApi( $this->wpdb );

        $this->table_manager_api->register_tables_info( $this->get_the_tables_info() )->register();
    }

    /**
     * Get the tables info.
     *
     * @return array $tables_info
     */
    public function get_the_tables_info() {

        $tables_info = [
            [
                'table_name' => $this->wpdb->prefix . 'baf_views_data',
                'schema'     => 'ID bigint(20) NOT NULL AUTO_INCREMENT,
                                        post_id bigint(20) NOT NULL,
                                        page_id bigint(20) NOT NULL,
                                        views_date_time datetime NULL,
                                        ip varchar(42) NOT NULL,
                                        PRIMARY KEY (ID)',
            ],
            [
                'table_name' => $this->wpdb->prefix . 'baf_likes_data',
                'schema'     => 'ID bigint(20) NOT NULL AUTO_INCREMENT,
                                        post_id bigint(20) NOT NULL,
                                        like_date_time datetime NULL,
                                        ip varchar(42) NOT NULL,
                                        PRIMARY KEY (ID)',
            ],
            [
                'table_name' => $this->wpdb->prefix . 'baf_search_keywords_data',
                'schema'     => 'ID bigint(20) NOT NULL AUTO_INCREMENT,
                                        post_id bigint(20) NOT NULL,
                                        search_keywords varchar(200) NOT NULL,
                                        search_result_counts bigint(20) NOT NULL,
                                        search_date_time datetime NULL,
                                        ip varchar(42) NOT NULL,
                                        PRIMARY KEY (ID)',
            ],
        ];
        return $tables_info;
    }


    /**
     * Add term order column to the terms table.
     *
     * @return void
     */
    public function add_term_order_column() {

        $table_name = $this->wpdb->prefix . 'terms';
        $column     = $this->wpdb->get_results( "SHOW COLUMNS FROM $table_name LIKE 'term_order'" );

        if ( empty( $column ) ) {
            $this->wpdb->query( "ALTER TABLE $table_name ADD term_order INT(11) NOT NULL DEFAULT 0" );
        }
    }
}
