<?php

/**
 * @file
 * Contains mobile_sponsor_list_v2.page.inc.
 *
 * Page callback for Mobile Sponsor List version 2.0 entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile Sponsor List version 2.0 templates.
 *
 * Default template: mobile_sponsor_list_v2.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_sponsor_list_v2(array &$variables) {
  // Fetch DefaultEntity Entity Object.
  $mobile_sponsor_list_v2 = $variables['elements']['#mobile_sponsor_list_v2'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
