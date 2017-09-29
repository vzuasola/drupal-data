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
      'checkbox' => [
        '#title' => 'Checkbox',
        '#type' => 'checkbox',
        '#default_value' => true
      ],
      'textfield' => [
        '#title' => 'Textfield',
        '#type' => 'textfield',
        '#description' => 'A description for this field',
      ],
      'textarea' => [
        '#title' => 'Textarea',
        '#type' => 'textarea',
        '#description' => 'A description for this field',
      ],
      'checkboxes' => [
        '#title' => 'Checkboxes',
        '#type' => 'checkboxes',
        '#options' => ['A' => 'Choice A', 'B' => 'Choice B'],
        '#description' => 'A description for this field',
      ],
      'radios' => [
        '#title' => 'Radios',
        '#type' => 'radios',
        '#options' => ['A' => 'Choice A', 'B' => 'Choice B'],
        '#description' => 'A description for this field',
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
          'checkbox' => [
            '#title' => 'Field Checkbox',
            '#type' => 'checkbox',
            '#default_value' => true
          ],
          'textfield' => [
            '#title' => 'Field Textfield',
            '#type' => 'textfield',
            '#description' => 'A description for this field',
          ],
          'textarea' => [
            '#title' => 'Field Textarea',
            '#type' => 'textarea',
            '#description' => 'A description for this field',
          ],
          'checkboxes' => [
            '#title' => 'Field Checkboxes',
            '#type' => 'checkboxes',
            '#options' => ['A' => 'Choice A', 'B' => 'Choice B'],
            '#description' => 'A description for this field',
          ],
          'radios' => [
            '#title' => 'Field Radios',
            '#type' => 'radios',
            '#options' => ['A' => 'Choice A', 'B' => 'Choice B'],
            '#description' => 'A description for this field',
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
