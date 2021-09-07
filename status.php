<?php
global $tli_status;
$tli_status = '';

/**
 * Set the status
 *
 * @param [string] $status the reason for the status
 *
 * @return void
 */
function tli_set_status($status) {
  global $tli_status;
  $tli_status = $status;
}


/**
 * Get the status
 *
 * @return void
 */
function tli_get_status() {
  global $tli_status;
  return $tli_status;
}


/**
 * Check if an status is set
 *
 * @return boolean
 */
function tli_is_status() {
  $status = tli_get_status();

  if ( ! $status  || $status == '' || empty($status) || !isset($status) ) {
    return false;
  }
  return true;
}


/**
 * Prints the status
 *
 * @return [string] $tli_status
 */
function tli_print_status() {
  global $tli_status;

  if ( ! $tli_status ) {
    return false;
  } else {
    echo 'ERROR: ' . $tli_status;
  }
}


function tli_print_status_update($update) {
  echo $update;
}