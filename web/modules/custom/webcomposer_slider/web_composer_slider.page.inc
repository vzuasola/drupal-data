<?php

/**
 * @file
 * Contains web_composer_slider.page.inc.
 *
 * Page callback for Web Composer Slider entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Web Composer Slider templates.
 *
 * Default template: web_composer_slider.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_web_composer_slider(array &$variables) {
  // Fetch WebComposerSlider Entity Object.
  $web_composer_slider = $variables['elements']['#web_composer_slider'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
