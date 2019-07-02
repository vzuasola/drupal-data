<?php

/**
 * @file
 * Contains mobile_marketing_space.page.inc.
 *
 * Page callback for Mobile marketing space entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile marketing space templates.
 *
 * Default template: mobile_marketing_space.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_marketing_space(array &$variables) {
  // Fetch MobileMarketingSpace Entity Object.
  $mobile_marketing_space = $variables['elements']['#mobile_marketing_space'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
