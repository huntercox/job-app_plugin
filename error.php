<?php
global $tli_error;
$tli_error = '';

/**
 * Set the error
 *
 * @param [string] $error the reason for the error.
 * @param [string] $key the key of the field that caused the error.
 *
 * @return void
 */
function tli_set_error($error, $key) {
  global $tli_error;

  if ( $key ) {
    $tli_error = $key.': '.$error;
  } else {
    $tli_error = $error;
  }
}


/**
 * Get the error
 *
 * @return void
 */
function tli_get_error() {
  global $tli_error;
  return $tli_error;
}


/**
 * Check if an error is set
 *
 * @return boolean
 */
function tli_is_error() {
  $error = tli_get_error();

  if ( ! $error  || $error == '' || empty($error) || !isset($error) ) {
    return false;
  }
  return true;
}


/**
 * Prints the error
 *
 * @return [string] $tli_error
 */
function tli_print_error() {
  global $tli_error;

  if ( ! $tli_error ) {
    return false;
  } else {
    echo 'ERROR: ' . $tli_error;
  }
}