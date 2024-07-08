<?php

/**
 * @file
 * Contains msw_legal_agreement.page.inc.
 *
 * Page callback for Registration Legal Agreement entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Registration Legal Agreement templates.
 *
 * Default template: msw_legal_agreement.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_msw_legal_agreement(array &$variables) {
  // Fetch Registration Legal Agreement Entity Object.
  $msw_legal_agreement = $variables['elements']['#msw_legal_agreement'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
