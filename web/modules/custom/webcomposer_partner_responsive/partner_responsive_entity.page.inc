<?php

/**
 * @file
 * Contains partner_responsive_entity.page.inc.
 *
 * Page callback for Partner responsive entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Partner templates.
 *
 * Default template: partner_responsive_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_partner_responsive_entity(array &$variables) {
  // Fetch PartnerResponsiveEntity Entity Object.
  $partner_responsive_entity = $variables['elements']['#partner_responsive_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
