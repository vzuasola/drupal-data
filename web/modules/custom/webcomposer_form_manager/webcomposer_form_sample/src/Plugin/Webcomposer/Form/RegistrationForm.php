<?php

namespace Drupal\webcomposer_form_sample\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm
 *
 * @WebcomposerForm(
 *   id = "registration",
 *   name = "Registration Form",
 * )
 */
class RegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {
  /**
   *
   */
  public function getSettings() {
    return [
      'header' => [
        '#title' => 'Form header',
        '#type' => 'textarea',
        '#description' => 'Header text for this form',
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
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'Username',
          ],
          'attr' => [
            'placeholder' => [
              '#title' => 'Username placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for username field placeholder',
              '#default_value' => '',
            ],
          ],
        ],
      ],

      'password' => [
        'name' => 'Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'Password',
          ],
        ],
      ],

      'email' => [
        'name' => 'Email',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'Email',
          ],
        ],
      ],

      'comments' => [
        'name' => 'Comment',
        'type' => 'textarea',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'Comments',
          ],
        ],
      ],

      'gender' => [
        'name' => 'Gender',
        'type' => 'radios',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'The label for this field',
            '#default_value' => 'Gender',
          ],
          'choices' => [
            '#title' => 'Gender Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, ['male|Male', 'female|Female']),
          ],
        ],
      ],

      'foods' => [
        'name' => 'Foods',
        'type' => 'checkboxes',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'The label for this field',
            '#default_value' => 'Foods',
          ],
          'choices' => [
            '#title' => 'Food Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, ['pizza|Pizza', 'donut|Donut']),
          ],
        ],
      ],

      'countries' => [
        'name' => 'Countries',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'The label for this field',
            '#default_value' => 'Country',
          ],
          'placeholder' => [
            '#title' => 'Choose a country',
            '#type' => 'textfield',
            '#description' => 'Placeholder value for this textfield',
            '#default_value' => 'Select your country...',
          ],
          'choices' => [
            '#title' => 'Country Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, ['ch|China', 'us|United States']),
          ],
        ],
      ],

      'age' => [
        'name' => 'Age',
        'type' => 'checkbox',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'The label for this checkbox',
            '#default_value' => 'I am sure that I am above 18 years old',
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
