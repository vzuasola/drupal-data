<?php

/**
 * @file
 * Contains social_media_entity.page.inc.
 *
 * Page callback for Social Media entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Social Media templates.
 *
 * Default template: social_media_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_social_media_entity(array &$variables) {
  // Fetch SocialMediaEntity Entity Object.
  $social_media_entity = $variables['elements']['#social_media_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
