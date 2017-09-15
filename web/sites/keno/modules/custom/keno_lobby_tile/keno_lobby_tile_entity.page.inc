<?php

/**
 * @file
 * Contains keno_lobby_tile_entity.page.inc.
 *
 * Page callback for Keno lobby tile entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Keno lobby tile entity templates.
 *
 * Default template: keno_lobby_tile_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_keno_lobby_tile_entity(array &$variables) {
  // Fetch KenoLobbyTileEntity Entity Object.
  $keno_lobby_tile_entity = $variables['elements']['#keno_lobby_tile_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
