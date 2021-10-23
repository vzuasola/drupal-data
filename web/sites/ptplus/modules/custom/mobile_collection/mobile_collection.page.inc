<?php

/**
 * @file
 * Contains mobile_collection.page.inc.
 *
 * Page callback for mobile collection entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for mobile collection templates.
 *
 * Default template: mobile_collection.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_collection(array &$variables) {
  // Fetch mobileCollection Entity Object.
  $mobile_collection = $variables['elements']['#mobile_collection'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
