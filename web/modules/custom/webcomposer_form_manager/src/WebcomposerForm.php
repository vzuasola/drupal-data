<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;

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
    $one = new WebcomposerFormEntity(
      'form_one',
      'Form One',
      [
        'firstname' => [
          '#type' => 'textfield',
          '#title' => 'First Name',
          '#default_value' => 'Alex'
        ],
        'lastname' => [
          '#type' => 'textfield',
          '#title' => 'Last Name',
          '#default_value' => 'Alexander'
        ]
      ],
      [
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
      ]
    );

    $forms = [
      'form_one' => $one,
    ];

    return $forms[$id] ?? NULL;
  }
}
