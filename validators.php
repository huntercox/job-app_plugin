<?php
/**
 * Special strings
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_validate_special($posted_data) {
  $special = array(
    'email',                           // email
    'legal',                            // bool
    'accident1Spill',                   // bool
    'accident2Spill',                   // bool
    'accident3Spill',                   // bool
    'deniedLicense',                    // bool
    'suspendedLicense',                 // bool
    'applicantNamePrinted',       // name match
    'applicantSignature',         // name match
    'currentEmployerSafetyRegulations', // bool
    'currentEmployerDoT',               // bool
    'prev1EmployerSafetyRegulations',   // bool
    'prev1EmployerDoT',                 // bool
    'prev2EmployerSafetyRegulations',   // bool
    'prev2EmployerDoT',                 // bool
    'hsGraduated',                      // bool
    'collegeGraduated',                 // bool
    'otherGraduated'                    // bool
  );

  $special = tli_find_post_keys($posted_data, $special);

  foreach ($special as $key => $value) :

    // email
    if ( $key == 'email' && !is_email($value) ) {
      tli_set_error('Email string was not valid.', $key);
      return false;
    }

    // booleans
    if ( $key == 'legal' || $key == 'accident1Spill' || $key == 'accident2Spill' || $key == 'accident3Spill' || $key == 'deniedLicense' || $key == 'suspendedLicense' || $key == 'currentEmployerSafetyRegulations' || $key == 'currentEmployerDoT' || $key == 'prev1EmployerSafetyRegulations' || $key == 'prev1EmployerDoT' || $key == 'prev2EmployerSafetyRegulations' || $key == 'prev2EmployerDoT' || $key == 'hsGraduated' || $key == 'collegeGraduated' || $key == 'otherGraduated' ) :

      // validate boolean values... yes/no or 0/1 ???
      $value = strtolower(trim($value));

      if ( $value == 'yes' ) {
        $value = 1;
      } elseif ( $value == 'no' ) {
        $value = 0;
      } else {
        tli_set_error('Error validating strings with special characteristics...');
        return false;
      }
    endif;

  endforeach;

  return true;
}

/**
 * Check numbers
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_validate_numbers($posted_data) {
  $numbers = array(
    'currentZipcode',
    'mailingZipcode',
    'prev1Zipcode',
    'prev2Zipcode',
    'prev3Zipcode',
    'accident1Fatalities',
    'accident1Injuries',
    'accident2Fatalities',
    'accident2Injuries',
    'accident3Fatalities',
    'accident3Injuries',
  );

  $nums = tli_find_post_keys($posted_data, $numbers);

  foreach ($nums as $key => $value) :

    if ( $value !== '' && !is_numeric($value) ) :
      tli_set_error('Number String contains invalid characters.', $key);
      return false;
    endif;

  endforeach;

  return true;
}

/**
 * Check phone numbers
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_validate_phonenum($posted_data) {
  $phone_numbers = array(
    'phone',
    'currentEmployerPhone',
    'prev1EmployerPhone',
    'prev2EmployerPhone',
  );

  $phonenums = tli_find_post_keys($posted_data, $phone_numbers);

  foreach ($phonenums as $key => $value) :

    if ( $value !== '' && ! preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/', trim($value)) ) :
      tli_set_error('Phone Number String contains invalid characters', $key);
      return false;
    endif;

  endforeach;

  return true;
}

/**
 * Check strings for date formatting
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_validate_dates($posted_data) {
  $dates = array(
    'birthdate',
    'dateAvailable',
    'currentLicenseExpDate',
    'prev1LicenseExpDate',
    'prev2LicenseExpDate',
    'straightTruckDateFrom',
    'straightTruckDateTo',
    'tractorSemiDateFrom',
    'tractorSemiDateTo',
    'tractorTrailersDateFrom',
    'tractorTrailersDateTo',
    'tractorTankerDateFrom',
    'tractorTankerDateTo',
    'otherDateFrom',
    'otherDateTo',
    'accident1Date',
    'accident2Date',
    'accident3Date',
    'conviction1Date',
    'conviction2Date',
    'conviction3Date',
    'applicantSignatureDate',
    'currentEmployerDateFrom',
    'currentEmployerDateTo',
    'prev1EmployerDateFrom',
    'prev1EmployerDateTo',
    'prev2EmployerDateFrom',
    'prev2EmployerDateTo',
  );

  $dates = tli_find_post_keys($posted_data, $dates);

  foreach ($dates as $key => $value) :

    if ( $value !== '' && ! preg_match('/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))+$/', trim($value)) ) :
      tli_set_error('Date String contains invalid characters.', $key);
      return false;
    endif;

  endforeach;

  return true;
}

/**
 * Check strings against alphanumeric characters
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_validate_alphanum($posted_data) {
  $alphanum_strings = array(
    'currentStreet',        // 255
    'currentDuration',      // 255
    'mailingStreet',        // 255
    'mailingDuration',      // 255
    'prev1Street',          // 255
    'prev1Duration',        // 255
    'prev2Street',          // 255
    'prev2Duration',        // 255
    'prev3Street',          // 255
    'prev3Duration',        // 255
    'currentLicenseNumber',       // 20
    'currentLicenseType',         // 50
    'currentLicenseEndorsements', // 255
    'prev1LicenseNumber',         // 20
    'prev1LicenseType',           // 50
    'prev1LicenseEndorsements',   // 255
    'prev2LicenseNumber',         // 20
    'prev2LicenseType',           // 50
    'prev2LicenseEndorsements',   // 255
    'straightTruckType',   // textarea
    'tractorSemiType',     // textarea
    'tractorTrailersType', // textarea
    'tractorTankerType',   // textarea
    'otherType',           // textarea
    'accident1Description', // textarea
    'accident2Description', // textarea
    'accident3Description', // textarea
    'conviction1Description', // textarea
    'conviction1Penalty',     // 255
    'conviction2Description', // textarea
    'conviction2Penalty',     // 255
    'conviction3Description', // textarea
    'conviction3Penalty',     // 255
    'currentEmployerAddress',          // 255
    'currentEmployerReasonForLeaving', // 255
    'currentEmployerSalary',           // 255
    'currentEmployerGaps',             // textarea
    'prev1EmployerAddress',            // 255
    'prev1EmployerReasonForLeaving',   // 255
    'prev1EmployerSalary',             // 255
    'prev1EmployerGaps',               // textarea
    'prev2EmployerAddress',            // 255
    'prev2EmployerReasonForLeaving',   // 255
    'prev2EmployerSalary',             // 255
    'prev2EmployerGaps',               // textarea
  );
  $alphanum = tli_find_post_keys($posted_data, $alphanum_strings);

  foreach ($alphanum as $key => $value) :

    if ( $key == 'currentStreet' || $key == 'currentDuration' || $key == 'mailingStreet' || $key == 'mailingDuration' || $key == 'prev1Street' || $key == 'prev1Duration' || $key == 'prev2Street' || $key == 'prev2Duration' || $key == 'prev3Street' || $key == 'prev3Duration' || $key == 'currentLicenseEndorsements' || $key == 'prev1LicenseEndorsements' || $key == 'prev2LicenseEndorsements' || $key == 'conviction1Penalty' || $key == 'conviction2Penalty' || $key == 'conviction3Penalty' || $key == 'currentEmployerAddress' || $key == 'currentEmployerReasonForLeaving' || $key == 'currentEmployerSalary' || $key == 'prev1EmployerAddress' || $key == 'prev1EmployerReasonForLeaving' || $key == 'prev1EmployerSalary' || $key == 'prev2EmployerAddress' || $key == 'prev2EmployerReasonForLeaving' || $key == 'prev2EmployerSalary' ) {
      // < 255
      if ( 255 < strlen( trim($value) ) ) :
        tli_set_error('Alphanumeric String contains more than 255 characters.', $key);
        return false;
      endif;
    } elseif ( $key == 'currentLicenseType' || $key == 'prev1LicenseType' || $key == 'prev2LicenseType' ) {
      // < 50
      if ( 50 < strlen( trim($value) ) ) :
        tli_set_error('Alphanumeric String contains more than 50 characters.', $key);
        return false;
      endif;
    } elseif ( $key == 'currentLicenseNumber' || $key == 'prev1LicenseNumber' || $key == 'prev2LicenseNumber' ) {
      // < 20
      if ( 20 < strlen( trim($value) ) ) :
        tli_set_error('Alphanumeric String contains more than 20 characters.', $key);
        return false;
      endif;
    }

    # incorrect format
    if ( $value !== '' && ! preg_match('/^[A-Za-z0-9-.,:;&$*\'\/\\\s ]+$/', trim($value) ) ) {
      tli_set_error('Alphanumeric String contains invalid characters.', $key);
      return false;
    }
  endforeach;

  return true;
}


/**
 * Check strings against basic string characters
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_validate_strings($posted_data) {
  $basic_strings = array(
    'firstName',                   // 50
    'middleName',                  // 50
    'lastName',                    // 50
    'jobPosition',                 // 255
    'currentCity',                 // 100
    'currentState',                // 2
    'mailingCity',                 // 100
    'mailingState',                // 2
    'prev1City',                   // 100
    'prev1State',                  // 2
    'prev2City',                   // 100
    'prev2State',                  // 2
    'prev3City',                   // 100
    'prev3State',                  // 2
    'currentLicenseState',         // 2
    'prev1LicenseState',           // 2
    'prev2LicenseState',           // 2
    'conviction1State',            // 2
    'conviction2State',            // 2
    'conviction3State',            // 2
    'currentEmployerName',         // 100
    'currentEmployerPositionHeld', // 255
    'prev1EmployerName',           // 100
    'prev1EmployerPositionHeld',   // 255
    'prev2EmployerName',           // 100
    'prev2EmployerPositionHeld',   // 255
    'hsNameLocation',              // 100
    'hsCourseStudy',               // 255
    'hsDetails',                   // 255
    'collegeNameLocation',         // 100
    'collegeCourseStudy',          // 255
    'collegeDetails',              // 255
    'otherNameLocation',           // 100
    'otherCourseStudy',            // 255
    'otherDetails',                // 255
  );
  $strings = tli_find_post_keys($posted_data, $basic_strings);

  foreach ($strings as $key => $value) :

    if ( $key == 'currentState' || $key == 'mailingState' || $key == 'prev1State' || $key == 'prev2State' || $key == 'prev3State' || $key == 'currentLicenseState' || $key == 'prev1LicenseState' || $key == 'prev2LicenseState' || $key == 'conviction1State' || $key == 'conviction2State' || $key == 'conviction3State' ) {
      // < 2
    if ( 2 < strlen( trim($value) ) ) :
        tli_set_error('String contains more than 2 characters.', $key);
        return false;
      endif;
    } elseif ( $key == 'firstName' || $key == 'middleName' || $key == 'lastName' ) {
      // < 50
      if ( 50 < strlen( trim($value) ) ) :
        tli_set_error('String contains more than 50 characters.', $key);
        return false;
      endif;
    } elseif ( $key == 'currentCity' || $key == 'mailingCity' || $key == 'prev1City' || $key == 'prev2City' || $key == 'prev3City' || $key == 'currentEmployerName' || $key == 'prev1EmployerName' || $key == 'prev2EmployerName' || $key == 'hsNameLocation' || $key == 'collegeNameLocation' || $key == 'otherNameLocation' ) {
      // < 100
      if ( 100 < strlen( trim($value) ) ) :
        tli_set_error('String contains more than 100 characters.', $key);
        return false;
      endif;
    } elseif ( $key == 'jobPosition' || $key == 'currentEmployerPositionHeld' || $key == 'prev1EmployerPositionHeld' || $key == 'prev2EmployerPositionHeld' || $key == 'hsCourseStudy' || $key == 'hsDetails' || $key == 'collegeCourseStudy' || $key == 'collegeDetails' || $key == 'otherCourseStudy' || $key == 'otherDetails' ) {
      // < 255
      if ( 255 < strlen( trim($value) ) ) :
        tli_set_error('String contains more than 255 characters.', $key);
        return false;
      endif;
    }

    # incorrect format
    if ( $value !== '' && ! preg_match('/^[A-Za-z-.\'\s ]+$/', trim($value) ) ) {
      tli_set_error('String contains invalid characters.', $key);
      return false;
    }
  endforeach;

  return true;
}


/**
 * Check post data for all required fields and make sure they aren't empty
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_check_required($posted_data) {
  // list all required fields (29)
  $required = array(
    'firstName',
    'middleName',
    'lastName',
    'phone',
    'email',
    'birthdate',
    'jobPosition',
    'dateAvailable',
    'legal',
    'currentStreet',
    'currentCity',
    'currentState',
    'currentZipcode',
    'currentDuration',
    'mailingStreet',
    'mailingCity',
    'mailingState',
    'mailingZipcode',
    'mailingDuration',
    'currentLicenseState',
    'currentLicenseNumber',
    'currentLicenseType',
    'currentLicenseEndorsements',
    'currentLicenseExpDate',
    'deniedLicense',
    'suspendedLicense',
    'applicantNamePrinted',
    'applicantSignatureDate',
    'applicantSignature',
  );

  $required = tli_find_post_keys($posted_data, $required);

  $all_set = tli_check_empty_fields($required);

  if ( ! $all_set ) {
    return false;
  } else {
    return $all_set;
  }

}


/**
 * Check all form fields to see if they are empty
 *
 * @param [array] $posted_data
 * @return bool
 */
function tli_check_empty_fields($posted_data) {
    // check if exist and then set to a blank string
    foreach ($posted_data as $field) {
      if ( empty($field) ) {
        $error = 'a required field is empty...';
        tli_set_error($error);
        return false;
      }
      else {
        continue;
      }
    }

    return true;
}

?>