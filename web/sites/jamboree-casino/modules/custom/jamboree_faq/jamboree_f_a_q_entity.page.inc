<?php

/**
 * @file
 * Contains jamboree_f_a_q_entity.page.inc.
 *
 * Page callback for Jamboree FAQ Entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree FAQ Entity templates.
 *
 * Default template: jamboree_f_a_q_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_f_a_q_entity(array &$variables) {
  // Fetch JamboreeFAQEntity Entity Object.
  $jamboree_f_a_q_entity = $variables['elements']['#jamboree_f_a_q_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
