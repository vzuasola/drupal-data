<?php

namespace Drupal\webcomposer_form_manager\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm
 *
 * @WebcomposerForm(
 *   id = "registration",
 *   name = "RegistrationForm",
 * )
 */
class RegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {
    /**
   *
   */
  public function getSettings() {
    return [
      'teaser' => [
        '#title' => 'Form teaser',
        '#type' => 'textarea',
        '#description' => 'Teaser for this form',
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
          'placeholder' => [
            '#title' => 'Placeholder',
            '#type' => 'textfield',
            '#description' => 'Placeholder for the fistname',
            '#default_value' => 'Leandrew',
          ],
        ],
      ],

      'lastname' => [
        'name' => 'Last name',
        'type' => 'textfield',
        'settings' => [
          'placeholder' => [
            '#title' => 'Placeholder',
            '#type' => 'textfield',
            '#description' => 'Placeholder for the lastname',
            '#default_value' => 'ViCarpio',
          ],
        ],
      ],
    ];
  }
}
