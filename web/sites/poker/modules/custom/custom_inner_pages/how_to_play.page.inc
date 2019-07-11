<?php

/**
 * @file
 * Contains how_to_play.page.inc.
 *
 * Page callback for How to play entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for How to play templates.
 *
 * Default template: how_to_play.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_how_to_play(array &$variables) {
  // Fetch HowToPlay Entity Object.
  $how_to_play = $variables['elements']['#how_to_play'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
