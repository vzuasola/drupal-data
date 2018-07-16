<?php

/**
 * @file
 * Contains contact_tabs_entity.page.inc.
 *
 * Page callback for Contact tabs entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Contact tabs entity templates.
 *
 * Default template: contact_tabs_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_contact_tabs_entity(array &$variables) {
  // Fetch ContactTabsEntity Entity Object.
  $contact_tabs_entity = $variables['elements']['#contact_tabs_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
