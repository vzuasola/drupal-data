<?php

/**
 * @file
 * Contains webcomposer_slider_entity.page.inc.
 *
 * Page callback for Webcomposer slider entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Webcomposer slider entity templates.
 *
 * Default template: webcomposer_slider_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_webcomposer_slider_entity(array &$variables) {
  // Fetch WebcomposerSliderEntity Entity Object.
  $webcomposer_slider_entity = $variables['elements']['#webcomposer_slider_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
