<?php

namespace Drupal\webcomposer_form_sample\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * LoginForm
 *
 * @WebcomposerForm(
 *   id = "login",
 *   name = "Login Form",
 * )
 */
class LoginForm extends WebcomposerFormBase implements WebcomposerFormInterface {
  /**
   *
   */
  public function getSettings() {
    return [
      'footer' => [
        '#title' => 'Footer',
        '#type' => 'textarea',
        '#description' => 'Footer text for this form',
      ],
    ];
  }

  /**
   *
   */
  public function getFields() {
    return [
      'firstname' => [
        'name' => 'First name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'Leandrew',
          ],
        ],
      ],

      'lastname' => [
        'name' => 'Last name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'ViCarpio',
          ],
        ],
      ],

      'submit' => [
        'name' => 'Submit',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Submit Label',
            '#type' => 'textfield',
            '#description' => 'Label for the submit button',
            '#default_value' => 'Submit',
          ],
        ],
      ],
    ];
  }
}
