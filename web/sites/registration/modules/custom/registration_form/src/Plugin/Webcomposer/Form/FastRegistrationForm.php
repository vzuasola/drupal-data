<?php

namespace Drupal\registration_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm.
 *
 * @WebcomposerForm(
 *   id = "fast_registration_form",
 *   name = "Fast Registration Form",
 * )
 */
class FastRegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Registration Form',
        '#type' => 'textfield',
        '#description' => 'Registration Alias',
      ],
      'form_name' => [
        '#title' => 'Form Name',
        '#type' => 'textfield',
        '#description' => 'Form name',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {
    return [
      'username' => [
        'name' => 'Username',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Username label',
            '#type' => 'textfield',
            '#description' => 'label for Username field',
          ],
          'placeholder' => [
            '#title' => 'Username placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Username field placeholder',
          ],
          'annotation' => [
            '#title' => 'Username Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'password' => [
        'name' => 'Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Password label',
            '#type' => 'textfield',
            '#description' => 'The Label for Password field',
          ],
          'placeholder' => [
            '#title' => 'Password placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Password field placeholder',
          ],
          'annotation' => [
            '#title' => 'Password Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'password_meter' => [
        'name' => 'Password Meter',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Password meter markup',
            '#type' => 'textarea',
            '#description' => 'HTML markup for password meter.',
            '#default_value' => '<div class="password_meter_wrapper password-meter-hidden grid mb-0"></div>',
          ],
        ],
      ],

      'email' => [
        'name' => 'Email',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Email Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Email field',
          ],
          'placeholder' => [
            '#title' => 'Email placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Email field placeholder',
          ],
          'annotation' => [
            '#title' => 'Email Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'mobile_number' => [
        'name' => 'Mobile Number',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Mobile Number Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Mobile Number field',
          ],
          'placeholder' => [
            '#title' => 'Mobile Number placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Mobile number field placeholder',
          ],
          'annotation' => [
            '#title' => 'Mobile Number Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
          'country_area_code' => [
            '#title' => 'Country Area Codes',
            '#type' => 'textarea',
            '#description' => 'List of area codes that will appear beside the mobile number ' .
            '(take note: must be a valid area code or the image will not appear beside the are code)',
          ],
          'country_area_code_validation' => [
            '#title' => 'Country Area Code Custom Validation',
            '#type' => 'textarea',
            '#description' => 'List of area codes that will be validated upon submission in which it had' .
            ' different min and max character allowed per country code and custom message validation for it',
          ],
        ],
      ],

      'currency' => [
        'name' => 'Currency',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Currency Label',
            '#type' => 'textfield',
            '#description' => 'The dLabel for the Currency field',
          ],
          'placeholder' => [
            '#title' => 'Choose a currency',
            '#type' => 'textfield',
            '#description' => 'Placeholder value for this textfield',
            '#default_value' => 'Select your currency...',
          ],
          'choices' => [
            '#title' => 'Currency Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              '117|RMB/CNY',
              '2|USD',
              '1|EUR',
            ]),
          ],
          'portal_id_to_currency_mapping' => [
            '#title' => 'Mapping of portal IDs to list of currencies',
            '#type' => 'textarea',
            '#description' => 'Mapping of icore portal IDs to the list of currencies, e.g 2|117,2,1 where 2 is the' .
            'entrypage portal ID and 117,2,1 are the list of currencies that will appear on it',
            '#default_value' => implode(PHP_EOL, [
              '2|117,2,1',
              '3|117,2,1',
            ]),
          ],
        ],
      ],

      'country' => [
        'name' => 'Country',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Country Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Country field',
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
            '#default_value' => implode(PHP_EOL, [
              '48|China',
              '208|Thailand',
            ]),
          ],
          'top_choices' => [
            '#title' => 'Top Country Choices',
            '#type' => 'textarea',
            '#description' => 'Top Countries that will appear at dropdown',
            '#default_value' => implode(PHP_EOL, [
              '48',
            ]),
          ],
        ],
      ],

      'breakline' => [
        'name' => 'Break Line Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '',
          ],
        ],
      ],

      'accept_terms' => [
        'name' => 'Accept Terms Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Accept Terms Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for accept terms and conditions beside the submit button',
            '#default_value' => 'I am at least 18 years old and have read and accept the Terms and Condition',
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
