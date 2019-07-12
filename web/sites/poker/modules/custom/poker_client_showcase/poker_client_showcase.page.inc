<?php

/**
 * @file
 * Contains poker_client_showcase.page.inc.
 *
 * Page callback for Poker client showcase entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Poker client showcase templates.
 *
 * Default template: poker_client_showcase.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_poker_client_showcase(array &$variables) {
  // Fetch PokerClientShowcase Entity Object.
  $poker_client_showcase = $variables['elements']['#poker_client_showcase'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
