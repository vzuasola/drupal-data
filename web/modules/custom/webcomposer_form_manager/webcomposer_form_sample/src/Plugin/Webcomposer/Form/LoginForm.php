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
        'type' => 'textarea',
        'settings' => [
          'name' => [
            '#title' => 'Default name',
            '#type' => 'textfield',
            '#description' => 'The default name for the comment',
          ],
        ],
      ],

      'gender' => [
        'name' => 'Gender',
        'type' => 'radio',
        'settings' => [
          'options' => [
            '#title' => 'Options',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example male|Male</small>',
            '#default_value' => implode(PHP_EOL, ['male|Male', 'female|Female']),
          ],
        ],
      ],

      'preference' => [
        'name' => 'Preference',
        'type' => 'select',
        'settings' => [
          'options' => [
            '#title' => 'Options',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|value</small>',
            '#default_value' => implode(PHP_EOL, ['1|Chicken', '2|Beef']),
          ],
        ],
      ],

      'age' => [
        'name' => 'Valid Age',
        'type' => 'checkbox',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'The label for this checkbox',
            '#default_value' => 'I am above 18 years old',
          ],
        ],
      ],
    ];
  }
}
