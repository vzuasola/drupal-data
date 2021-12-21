<?php

/**
 * @file
 * Contains mobile_product_menu.page.inc.
 *
 * Page callback for Mobile Product Menu entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile Product Menu templates.
 *
 * Default template: mobile_product_menu.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_product_menu(array &$variables) {
  // Fetch MobileProductMenu Entity Object.
  $mobile_product_menu = $variables['elements']['#mobile_product_menu'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
