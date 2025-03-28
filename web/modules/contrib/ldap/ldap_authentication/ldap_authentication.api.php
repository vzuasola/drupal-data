<?php

/**
 * @file
 * Summary of hooks and other developer related functions.
 */

/**
 * Allow a custom module to examine the user's ldap details
 * and refuse authentication.  See also: http://drupal.org/node/1634930.
 *
 * @param array $ldap_user
 *    See README.developers.txt for structure.
 * @param string $name
 *    The drupal account name or proposed drupal account name if none exists yet.
 * @param bool $hook_result
 *    TRUE for allow, FALSE for deny.
 *    If set to TRUE or FALSE, another module has already set this and function should
 *    be careful about overriding this.
 *
 * @return boolean &$hook_result passed by reference
 */
function hook_ldap_authentication_allowuser_results_alter($ldap_user, $name, &$hook_result) {

  // Other module has denied user, should not override.
  if ($hook_result === FALSE) {
    return;
  }
  // Other module has allowed, maybe override.
  elseif ($hook_result === TRUE) {
    if (mymodule_dissapproves($ldap_user, $name)) {
      $hook_result = FALSE;
    }
  }

}
