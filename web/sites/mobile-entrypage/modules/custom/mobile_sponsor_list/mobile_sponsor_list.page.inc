<?php

/**
 * @file
 * Contains mobile_sponsor_list.page.inc.
 *
 * Page callback for Mobile sponsor list entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile sponsor list templates.
 *
 * Default template: mobile_sponsor_list.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_sponsor_list(array &$variables) {
  // Fetch MobileSponsorList Entity Object.
  $mobile_sponsor_list = $variables['elements']['#mobile_sponsor_list'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
