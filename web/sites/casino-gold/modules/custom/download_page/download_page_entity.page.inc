<?php

/**
 * @file
 * Contains download_page_entity.page.inc.
 *
 * Page callback for Download page entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Download page entity templates.
 *
 * Default template: download_page_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_download_page_entity(array &$variables) {
  // Fetch DownloadPageEntity Entity Object.
  $download_page_entity = $variables['elements']['#download_page_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
