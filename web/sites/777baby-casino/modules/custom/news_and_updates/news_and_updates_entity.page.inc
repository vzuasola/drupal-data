<?php

/**
 * @file
 * Contains news_and_updates_entity.page.inc.
 *
 * Page callback for News and updates entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for News and updates entity templates.
 *
 * Default template: news_and_updates_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_news_and_updates_entity(array &$variables) {
  // Fetch NewsAndUpdatesEntity Entity Object.
  $news_and_updates_entity = $variables['elements']['#news_and_updates_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
