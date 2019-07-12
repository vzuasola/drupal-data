<?php

/**
 * @file
 * Contains zipang_rightside_block_entity.page.inc.
 *
 * Page callback for Zipang rightside block entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang rightside block entity templates.
 *
 * Default template: zipang_rightside_block_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_rightside_block_entity(array &$variables) {
  // Fetch ZipangRightsideBlockEntity Entity Object.
  $zipang_rightside_block_entity = $variables['elements']['#zipang_rightside_block_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
