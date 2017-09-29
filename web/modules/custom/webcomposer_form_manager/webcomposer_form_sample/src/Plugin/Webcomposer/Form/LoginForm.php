<?php

namespace Drupal\webcomposer_form_sample\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm
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
  }

  /**
   *
   */
  public function getFields() {
    return [
      'username' => [
        'name' => 'Username',
        'type' => 'textfield',
        'options' => [
          'default_value' => 'Leandrew',
        ],
        'settings' => [
          'alias' => [
            '#title' => 'Username alias',
            '#type' => 'textfield',
            '#description' => 'The alias for this username',
          ],
        ],
      ],

      'password' => [
        'name' => 'Password',
        'type' => 'textfield',
      ],

      'email' => [
        'name' => 'Email',
        'type' => 'textfield',
      ],

      'comments' => [
        'name' => 'Comment',
        'type' => 'textfield',
        'settings' => [
          'name' => [
            '#title' => 'Default name',
            '#type' => 'textfield',
            '#description' => 'The default name for the comment',
          ],
        ],
      ],
    ];
  }
}
