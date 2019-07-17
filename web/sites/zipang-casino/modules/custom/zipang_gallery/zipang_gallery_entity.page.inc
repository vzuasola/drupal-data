<?php

/**
 * @file
 * Contains zipang_gallery_entity.page.inc.
 *
 * Page callback for Zipang gallery entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang gallery entity templates.
 *
 * Default template: zipang_gallery_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_gallery_entity(array &$variables) {
  // Fetch ZipangGalleryEntity Entity Object.
  $zipang_gallery_entity = $variables['elements']['#zipang_gallery_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
