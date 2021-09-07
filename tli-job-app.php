<?php
/**
 * Plugin Name: TLI Job Application Storage
 */

include( plugin_dir_path( __FILE__ ) . '/database.php');
include( plugin_dir_path( __FILE__ ) . '/error.php');
include( plugin_dir_path( __FILE__ ) . '/status.php');
include( plugin_dir_path( __FILE__ ) . '/validate.php');
include( plugin_dir_path( __FILE__ ) . '/validators.php');
include( plugin_dir_path( __FILE__ ) . '/sanitize.php');


/**
 * Process form data: validate, sanitize and insert into database.
 *
 * @param [array] $posted_data
 * @return void
 */
  function tli_process_form( $posted_data ) {

    // Check form fields
    $validated = tli_validate_form($posted_data);
    if ( $validated === false ) {
      tli_set_error('...', 'TLI_VALIDATE_FORM()');
      return false;
    }

    // Sanitize form fields
    $sanitized = tli_sanitize_text_fields($posted_data);

    tli_add_form_to_db($sanitized);
  }



/**
 * Runs when the plugin is activated
 *
 * @return void
 */
function tli_activate_plugin() {
  tli_create_table();
}
register_activation_hook( __FILE__, 'tli_activate_plugin' );
