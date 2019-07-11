<?php

/**
 * @file
 * Contains deposit_and_withdrawal_entity.page.inc.
 *
 * Page callback for Deposit and withdrawal entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Deposit and withdrawal entity templates.
 *
 * Default template: deposit_and_withdrawal_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_deposit_and_withdrawal_entity(array &$variables) {
  // Fetch DepositAndWithdrawalEntity Entity Object.
  $deposit_and_withdrawal_entity = $variables['elements']['#deposit_and_withdrawal_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
