<?php

/**
 * @file
 * Contains promotion_tiles.page.inc.
 *
 * Page callback for Promotion tiles entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Promotion tiles templates.
 *
 * Default template: promotion_tiles.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_promotion_tiles(array &$variables) {
  // Fetch PromotionTiles Entity Object.
  $promotion_tiles = $variables['elements']['#promotion_tiles'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
