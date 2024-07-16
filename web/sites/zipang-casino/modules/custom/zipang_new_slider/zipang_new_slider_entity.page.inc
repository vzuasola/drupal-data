<?php/**
 * @file
 * Contains zipang_new_slider_entity.page.inc. *
 * Page callback for Zipang new slider entity entities. */

 use Drupal\Core\Render\Element;

 /**
 * Prepares variables for Zipang new slider entity templates.
 *
 * Default template:zipang_new_slider_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_new_slider_entity(array &$variables) {
  // Fetch ZipangNewSliderEntity Entity Object.
  $zipang_new_slider_entity = $variables['elements']['#zipang_new_slider_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}