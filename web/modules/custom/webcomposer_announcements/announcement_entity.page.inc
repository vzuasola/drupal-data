<?php

/**
 * @file
 * Contains announcement_entity.page.inc.
 *
 * Page callback for Announcement entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Announcement templates.
 *
 * Default template: announcement_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_announcement_entity(array &$variables) {
  // Fetch AnnouncementEntity Entity Object.
  $announcement_entity = $variables['elements']['#announcement_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
