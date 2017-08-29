<?php

/**
 * @file
 * Contains downloadable_entity.page.inc.
 *
 * Page callback for Downloadable entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Downloadable entity templates.
 *
 * Default template: downloadable_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_downloadable_entity(array &$variables) {
  // Fetch DownloadableEntity Entity Object.
  $downloadable_entity = $variables['elements']['#downloadable_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
