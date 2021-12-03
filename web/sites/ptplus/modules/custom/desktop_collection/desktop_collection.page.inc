<?php

/**
 * @file
 * Contains desktop_collection.page.inc. 
 *
 * Page callback forDesktop collection entities. 
 */
 
 use Drupal\Core\Render\Element;
 
 /**
 * Prepares variables forDesktop collection templates.
 *
 * Default template:desktop_collection.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_desktop_collection(array &$variables) {
  // FetchDesktopCollection Entity Object.
  $desktop_collection = $variables['elements']['#desktop_collection'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
