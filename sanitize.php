<?php
/**
 * ==============================================================
 * SANITIZE
 * ==============================================================
 */

/**
 * Sanitize all fields
 *
 * @param [array] $post_data
 * @return $post_data
 */
function tli_sanitize_text_fields( $post_data ) {
  foreach ( $post_data as $key => &$value ) {
      if ( is_array( $value ) ) {
          $value = tli_sanitize_text_fields( $value );
      } else {
          $value = sanitize_text_field( $value );
      }
  }
  return $post_data;
}