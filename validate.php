<?php
/**
 * ==============================================================
 * VALIDATE
 * ==============================================================
 */


/**
 * Pass $_POST data through validators
 *
 * @param [array] $posted_data
 * @return void
 */
  function tli_validate_form($posted_data) {

    // 1 - check if required fields are set
      $passed_required = tli_check_required($posted_data);

      if ( $passed_required === false ) {
        return false;
      }

    // 2 - validate strings
      $is_strings = tli_validate_strings($posted_data);

      if ( ! $is_strings ) {
        return false;
      }

    // 3 - alpha-numberic strings
      $is_alphanum_strings = tli_validate_alphanum($posted_data);

      if ( ! $is_alphanum_strings ) {
        return false;
      }


    // 4 - date strings
      $is_dates = tli_validate_dates($posted_data);

      if ( ! $is_dates ) {
        return false;
      }

    // 5 - phone numbers strings
      $is_phone_numbers = tli_validate_phonenum($posted_data);

      if ( ! $is_phone_numbers ) {
        return false;
      }

    // 6 - numbers strings
      $is_numbers = tli_validate_numbers($posted_data);

      if ( ! $is_numbers ) {
        return false;
      }

    // 7 - special strings
      $is_special = tli_validate_special($posted_data);

      if ( ! $is_special ) {
        return false;
      }



      return true;
  }// tli_validate_form()

/**
 * Take an array of keys and match them to the keys in $_POST array
 *
 * @param [array] $posted_data
 * @param [array] $keys_array
 * @return array
 */
  function tli_find_post_keys($posted_data, $keys_array) {
    return array_intersect_key($posted_data, array_flip($keys_array));
  }


?>