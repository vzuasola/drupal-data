<?php

/**
 * @file
 * Contains marketing_script_entity.page.inc.
 *
 * Page callback for Marketing Script entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Marketing Script templates.
 *
 * Default template: marketing_script_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_marketing_script_entity(array &$variables) {
  // Fetch MarketingScriptEntity Entity Object.
  $marketing_script_entity = $variables['elements']['#marketing_script_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
