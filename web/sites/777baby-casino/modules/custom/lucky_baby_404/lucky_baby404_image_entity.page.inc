<?php

/**
 * @file
 * Contains lucky_baby404_image_entity.page.inc.
 *
 * Page callback for Lucky Baby 404 Image Entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lucky Baby 404 Image Entity templates.
 *
 * Default template: lucky_baby404_image_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lucky_baby404_image_entity(array &$variables) {
  // Fetch LuckyBaby404ImageEntity Entity Object.
  $lucky_baby404_image_entity = $variables['elements']['#lucky_baby404_image_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
