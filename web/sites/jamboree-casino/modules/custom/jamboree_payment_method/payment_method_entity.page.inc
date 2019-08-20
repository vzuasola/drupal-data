<?php

/**
 * @file
 * Contains payment_method_entity.page.inc.
 *
 * Page callback for Payment method entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Payment method entity templates.
 *
 * Default template: payment_method_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_payment_method_entity(array &$variables) {
  // Fetch PaymentMethodEntity Entity Object.
  $payment_method_entity = $variables['elements']['#payment_method_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
