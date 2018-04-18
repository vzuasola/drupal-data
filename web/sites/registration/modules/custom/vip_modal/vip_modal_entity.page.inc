<?php

/**
 * @file
 * Contains vip_modal_entity.page.inc.
 *
 * Page callback for Vip Modal Content Entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Vip Modal Content Entity templates.
 *
 * Default template: vip_modal_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_vip_modal_entity(array &$variables) {
  // Fetch VipModalContent Entity Object.
  $vip_modal_entity = $variables['elements']['#vip_modal_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
