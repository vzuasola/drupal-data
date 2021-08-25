<?php

/**
 * @file
 * Containsdesktop_slider.page.inc. *
 * Page callback forDesktop slider entities. */use Drupal\Core\Render\Element;/**
 * Prepares variables forDesktop slider templates.
 *
 * Default template:desktop_slider.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
 
function template_preprocess_desktop_slider(array &$variables) {
  // FetchDesktopSlider Entity Object.
  $desktop_slider = $variables['elements']['#desktop_slider'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}