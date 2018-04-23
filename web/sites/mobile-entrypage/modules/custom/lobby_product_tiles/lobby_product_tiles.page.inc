<?php

/**
 * @file
 * Contains lobby_product_tiles.page.inc.
 *
 * Page callback for Lobby Product Tiles entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lobby Product Tiles templates.
 *
 * Default template: lobby_product_tiles.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lobby_product_tiles(array &$variables) {
  // Fetch LobbyProductTiles Entity Object.
  $lobby_product_tiles = $variables['elements']['#lobby_product_tiles'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
