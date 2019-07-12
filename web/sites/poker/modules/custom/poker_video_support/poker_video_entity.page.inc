<?php

/**
 * @file
 * Contains poker_video_entity.page.inc.
 *
 * Page callback for Video entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Video entity templates.
 *
 * Default template: poker_video_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_poker_video_entity(array &$variables) {
  // Fetch VideoEntity Entity Object.
  $poker_video_entity = $variables['elements']['#poker_video_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
