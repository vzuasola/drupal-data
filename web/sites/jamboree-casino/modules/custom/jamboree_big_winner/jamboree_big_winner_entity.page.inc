<?php

/**
 * @file
 * Contains jamboree_big_winner_entity.page.inc.
 *
 * Page callback for Jamboree big winner entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree big winner entity templates.
 *
 * Default template: jamboree_big_winner_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_big_winner_entity(array &$variables) {
  // Fetch JamboreeBigWinnerEntity Entity Object.
  $jamboree_big_winner_entity = $variables['elements']['#jamboree_big_winner_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
