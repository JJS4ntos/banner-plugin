<?php
/**
 * Install and update database structure.
 */

global $wpdb;

$charset = $wpdb->get_charset_collate();
$prefix = "{$wpdb->prefix}sd_";

/**
 * Structure of tables that will be created.
 */
$tables = array();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

foreach( $tables as $table ) {
    dbDelta( $table );
}
