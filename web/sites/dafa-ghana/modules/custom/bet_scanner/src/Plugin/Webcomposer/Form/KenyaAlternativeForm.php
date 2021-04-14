<?php

namespace Drupal\bet_scanner\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * Kenya Alternative Form
 *
 * @WebcomposerForm(
 *   id = "kenya_alternative_form",
 *   name = "Kenya Alternative Form",
 * )
 */
class KenyaAlternativeForm extends WebcomposerFormBase implements WebcomposerFormInterface {

  /**
   * Get Settings.
   */
  public function getSettings() {
    return [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => TRUE,
      ],
      'alias' => [
        '#title' => 'Kenya Alternative Form Alias',
        '#type' => 'textfield',
        '#description' => 'Kenya Alternative Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {

    $fields = [];

    $fields['header_markup'] = [
      'name' => 'Header Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Header Blurb',
          '#type' => 'text_format',
          '#default_value' => '',
        ],
      ],
    ];

    $fields['receipt_number'] = [
      'name' => 'Bet Receipt Number',
      'type' => 'textfield',
      'settings' => [
        'label' => [
          '#title' => 'Bet Receipt Number',
          '#type' => 'textfield',
          '#description' => 'Label for Bet Receipt Number field',
        ],
        'placeholder' => [
          '#title' => 'Bet Receipt Number placeholder label',
          '#type' => 'textfield',
          '#description' => 'Label for Bet Receipt Number field placeholder',
        ],
        'annotation' => [
          '#title' => 'Annotation text',
          '#type' => 'textarea',
          '#description' => 'field annotation that will be displayed on focus',
        ],
      ],
    ];

    $fields['submit'] = [
      'name' => 'Submit',
      'type' => 'submit',
      'settings' => [
        'label' => [
          '#title' => 'Submit Label',
          '#type' => 'textfield',
          '#description' => 'Label for the Submit button',
          '#default_value' => 'Submit',
        ],
      ],
    ];

    $fields['clear'] = [
      'name' => 'Clear',
      'type' => 'button',
      'settings' => [
        'label' => [
          '#title' => 'Clear Label',
          '#type' => 'textfield',
          '#description' => 'Label for the Clear button',
          '#default_value' => 'Clear',
        ],
      ],
    ];

    return $fields;
  }

}
