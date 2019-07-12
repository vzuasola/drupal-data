<?php

/**
 * @file
 * Contains left_floating_banner_entity.page.inc.
 *
 * Page callback for Left floating banner entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Left floating banner entity templates.
 *
 * Default template: left_floating_banner_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_left_floating_banner_entity(array &$variables) {
  // Fetch LeftFloatingBannerEntity Entity Object.
  $left_floating_banner_entity = $variables['elements']['#left_floating_banner_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
