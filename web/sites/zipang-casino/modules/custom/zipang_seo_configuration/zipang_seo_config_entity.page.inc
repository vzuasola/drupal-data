<?php

/**
 * @file
 * Contains zipang_seo_config_entity.page.inc.
 *
 * Page callback for Zipang seo config entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang seo config entity templates.
 *
 * Default template: zipang_seo_config_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_seo_config_entity(array &$variables) {
  // Fetch ZipangSeoConfigEntity Entity Object.
  $zipang_seo_config_entity = $variables['elements']['#zipang_seo_config_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
