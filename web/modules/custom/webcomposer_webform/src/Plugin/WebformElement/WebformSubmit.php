<?php

namespace Drupal\webcomposer_webform\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\WebformActions;

/**
 * Provides a 'webform_submit' element.
 *
 * @WebformElement(
 *   id = "webform_submit",
 *   label = @Translation("Submit button"),
 *   description = @Translation("Provides an element that contains a Webform's submit button."),
 *   category = @Translation("Submit"),
 * )
 */
class WebformSubmit extends WebformActions {
  /**
   * {@inheritdoc}
   */
  public function isRoot() {
   return FALSE;
  }
}
