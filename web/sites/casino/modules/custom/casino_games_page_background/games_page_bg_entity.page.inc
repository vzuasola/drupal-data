<?php

/**
 * @file
 * Contains games_page_bg_entity.page.inc.
 *
 * Page callback for Casino Games Page Background entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Casino Games Page Background templates.
 *
 * Default template: games_page_bg_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_games_page_bg_entity(array &$variables) {
  // Fetch GamesPageBgEntity Entity Object.
  $games_page_bg_entity = $variables['elements']['#games_page_bg_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
