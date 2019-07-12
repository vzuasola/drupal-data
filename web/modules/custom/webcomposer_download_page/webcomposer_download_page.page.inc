<?php

/**
 * @file
 * Contains webcomposer_download_page.page.inc.
 *
 * Page callback for Webcomposer download page entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Webcomposer download page templates.
 *
 * Default template: webcomposer_download_page.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_webcomposer_download_page(array &$variables) {
  // Fetch WebcomposerDownloadPage Entity Object.
  $webcomposer_download_page = $variables['elements']['#webcomposer_download_page'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
