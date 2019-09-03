<?php

/**
 * @file
 * Contains jamboree_withdraw_method_entity.page.inc.
 *
 * Page callback for Jamboree withdraw method entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree withdraw method entity templates.
 *
 * Default template: jamboree_withdraw_method_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_withdraw_method_entity(array &$variables) {
  // Fetch JamboreeWithdrawMethodEntity Entity Object.
  $jamboree_withdraw_method_entity = $variables['elements']['#jamboree_withdraw_method_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
