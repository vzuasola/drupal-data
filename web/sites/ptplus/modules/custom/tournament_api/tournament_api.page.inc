<?php

/**
 * @file
 * Containstournament_api.page.inc. *
 * Page callback forTournament Api entities. */use Drupal\Core\Render\Element;/**
 * Prepares variables forTournament Api templates.
 *
 * Default template:tournament_api.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
 
function template_preprocess_tournament_api(array &$variables) {
  // FetchTournamentApi Entity Object.
  $tournament_api = $variables['elements']['#tournament_api'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}