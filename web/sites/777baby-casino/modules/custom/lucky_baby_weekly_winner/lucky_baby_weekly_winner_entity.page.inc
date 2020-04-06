<?php

/**
 * @file
 * Contains lucky_baby_weekly_winner_entity.page.inc.
 *
 * Page callback for Lucky baby weekly winner entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lucky baby weekly winner entity templates.
 *
 * Default template: lucky_baby_weekly_winner_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lucky_baby_weekly_winner_entity(array &$variables) {
  // Fetch LuckyBabyWeeklyWinnerEntity Entity Object.
  $lucky_baby_weekly_winner_entity = $variables['elements']['#lucky_baby_weekly_winner_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
