<?php

/**
 * @file
 * Contains mobile_infobar.page.inc.
 *
 * Page callback for Mobile info bar entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile info bar templates.
 *
 * Default template: mobile_infobar.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_infobar(array &$variables) {
  // Fetch MobileInfoBar Entity Object.
  $mobile_infobar = $variables['elements']['#mobile_infobar'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
