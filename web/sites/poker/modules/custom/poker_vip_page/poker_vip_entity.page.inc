<?php

/**
 * @file
 * Contains poker_vip_entity.page.inc.
 *
 * Page callback for Poker vip entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Poker vip entity templates.
 *
 * Default template: poker_vip_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_poker_vip_entity(array &$variables) {
  // Fetch PokerVipEntity Entity Object.
  $poker_vip_entity = $variables['elements']['#poker_vip_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
