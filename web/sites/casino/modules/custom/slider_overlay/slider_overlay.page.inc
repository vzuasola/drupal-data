<?php

/**
 * @file
 * Contains slider_overlay_entity.page.inc.
 *
 * Page callback for Slider Overlay entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Slider Overlay templates.
 *
 * Default template: slider_overlay_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_slider_overlay_entity(array &$variables) {
  // Fetch SliderOverlayEntity Entity Object.
  $slider_overlay_entity = $variables['elements']['#slider_overlay_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
