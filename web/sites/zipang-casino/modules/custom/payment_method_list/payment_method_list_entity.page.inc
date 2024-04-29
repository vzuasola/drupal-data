<?php

/**
 * @file
 * Contains payment_method_list.page.inc.
 *
 * Page callback for Payment Method List entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Payment Method entity templates.
 *
 * Default template: payment_method_list.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_payment_method_list(array &$variables) {
  // Fetch PaymentMethodListEntity Entity Object.
  $payment_method_list = $variables['elements']['#payment_method_list'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
