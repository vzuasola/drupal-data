<?php

/**
 * @file
 * Contains zipang_game_promotions_entity.page.inc. *
 * Page callback for Zipang game promotions entity entities. */

 use Drupal\Core\Render\Element;

 /**
 * Prepares variables for Zipang game promotions entity templates.
 *
 * Default template:zipang_game_promotions_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_game_promotions_entity(array &$variables) {
  // FetchZipangGamePromotionsEntity Entity Object.
  $zipang_game_promotions_entity = $variables['elements']['#zipang_game_promotions_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}