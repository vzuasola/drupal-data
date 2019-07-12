<?php

/**
 * @file
 * Contains poker_client_promotions.page.inc.
 *
 * Page callback for Poker client promotions entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Poker client promotions templates.
 *
 * Default template: poker_client_promotions.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_poker_client_promotions(array &$variables) {
  // Fetch PokerClientPromotions Entity Object.
  $poker_client_promotions = $variables['elements']['#poker_client_promotions'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
