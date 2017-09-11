<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormFieldEntity;

/**
 * 
 */
class WebcomposerForm {
  /**
   * 
   */
  public function getFormList() {
    return [
      'form_one' => [
          'name' => 'Form One',
      ],
      'form_sample' => [
          'name' => 'Form Sample',
      ],
    ];
  }

  /**
   * 
   */
  public function getFormById($id) {
    $formOneSettings = [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => true
      ],
      'alias' => [
        '#title' => 'Form alias',
        '#type' => 'textfield',
        '#description' => 'The alias for this form',
      ],
    ];

    $formOne = new WebcomposerFormEntity('form_one', 'Form One', $formOneSettings);

    $formOne->setField(
      new WebcomposerFormFieldEntity('firstname', 'First name', 'textfield', ['default_value' => 'Leo'])
    );

    $formOne->setField(
      new WebcomposerFormFieldEntity('lastname', 'Last name', 'textfield', ['default_value' => 'Drew'], [
        'alias' => [
          '#title' => 'Last name alias',
          '#type' => 'textfield',
          '#description' => 'The alias for this last name',
        ],
      ])
    );

    $forms = [
      'form_one' => $formOne,
    ];

    return $forms[$id] ?? NULL;
  }

  /**
   *
   */
  public function getValidations() {
    return [
      'alphanumeric' => [
        'parameters' => [
          'show' => [
            '#title' => 'Allow special characters',
            '#type' => 'checkbox',
            '#default_value' => true
          ],
        ],
      ],
    ];
  }
}
