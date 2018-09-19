<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MyProfileForm.
 *
 * @WebcomposerForm(
 *   id = "my_profile_form",
 *   name = "My Profile Form",
 * )
 */
class MyProfileForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'My Profile Form',
        '#type' => 'textfield',
        '#description' => 'My Profile Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {
    return [
      'account_markup' => [
        'name' => 'Account Details Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Account details with Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text my profile form',
            '#default_value' => 'Account Details<hr>',
          ],
        ],
      ],

      'username' => [
        'name' => 'Username',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Username label',
            '#type' => 'textfield',
            '#description' => 'label for Username field',
          ],
        ],
      ],

      'currency' => [
        'name' => 'Currency',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Currency label',
            '#type' => 'textfield',
            '#description' => 'label for Currency field',
          ],
        ],
      ],

      'first_name' => [
        'name' => 'First Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'First Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the First Name field',
          ],
          'placeholder' => [
            '#title' => 'First name placeholder label',
            '#type' => 'textfield',
            '#description' => 'First name placeholder label',
          ],
        ],
      ],

      'last_name' => [
        'name' => 'Last Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Last Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Last Name field',
          ],
          'placeholder' => [
            '#title' => 'Last name placeholder label',
            '#type' => 'textfield',
            '#description' => 'Last name placeholder label',
          ],
        ],
      ],

      'birthdate' => [
        'name' => 'Date of birth',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Date of Birth Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Birthdate field',
          ],
          'date-format' => [
            '#title' => 'Birthdate format',
            '#type' => 'textfield',
            '#description' => 'Date Format for Birthdate',
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
        ],
      ],

      'country' => [
        'name' => 'Country',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Country Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Country field',
          ],
        ],
      ],

      'gender' => [
        'name' => 'Gender',
        'type' => 'radios',
        'settings' => [
          'label' => [
            '#title' => 'Gender Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Gender field',
          ],
          'choices' => [
            '#title' => 'Gender Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              'M|Male',
              'F|Female',
            ]),
          ],
        ],
      ],

      'communication_markup' => [
        'name' => 'Communication Details Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Communication details for with Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text my profile form',
            '#default_value' => 'Communication Details<hr>',
          ],
        ],
      ],

      'mobile_number_1' => [
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
          'tooltip-content' => [
            '#title' => 'Tooltip text',
            '#type' => 'textarea',
            '#description' => 'Tooltip text that will be displayed on focus of info icon',
          ],
          'country_area_code_validation' => [
            '#title' => 'Country Area Code Custom Validation',
            '#type' => 'textarea',
            '#description' => 'List of country codes that will be validated upon submission in which it had' .
            ' different min and max character allowed per country code and custom message validation for it',
          ],
        ],
      ],

      'primary_number' => [
        'name' => 'Primary Mobile Number checkbox',
        'type' => 'checkboxes',
        'settings' => [
          'label' => [
            '#title' => 'primary Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the primary number field',
          ],
          'choices' => [
            '#title' => 'Primary Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              'p|Primary',
            ]),
          ],
        ],
      ],

      'mobile_number_2' => [
        'name' => 'Mobile Number 2',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Mobile Number 2 Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Mobile Number 2 field',
          ],
        ],
      ],

      'language' => [
        'name' => 'Language',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Langauge Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Language field',
          ],
          'choices' => [
            '#title' => 'Currency Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              'en-GB|English (Europe)',
              'zh-TW|Traditional Chinese (繁體)',
              'zh-CN|Simplified Chinese (简体)',
              'en-US|English',
              'el|Greek (Ελληνικά)',
              'hi|English (India)',
              'id|Bahasa Indonesia',
              'ja|Japanese (日本語)',
              'ko-KR|Korean (한국어)',
              'pl|Polish (Polski)',
              'th|Thai (ภาษาไทย)',
              'vi|Vietnamese (Tiếng Việt)',
            ]),
          ],
        ],
      ],

      'address_markup' => [
        'name' => 'Home Address Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Address details for with Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text my profile form',
            '#default_value' => 'Home Address<hr>',
          ],
        ],
      ],

      'address' => [
        'name' => 'Address',
        'type' => 'textarea',
        'settings' => [
          'label' => [
            '#title' => 'Address label',
            '#type' => 'textfield',
            '#description' => 'label for Address field',
          ],
          'placeholder' => [
            '#title' => 'Address placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for address field placeholder',
          ],
        ],
      ],

      'city' => [
        'name' => 'City',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'City Label',
            '#type' => 'textfield',
            '#description' => 'The label for the City field',
          ],
          'placeholder' => [
            '#title' => 'City placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for city field placeholder',
          ],
        ],
      ],

      'postal_code' => [
        'name' => 'Postal Code',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Postal Code Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Postal Code field',
          ],
          'placeholder' => [
            '#title' => 'Postal Code placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for postal code field placeholder',
          ],
        ],
      ],

      'preference_markup' => [
        'name' => 'Contact Preference Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Preference details for with Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text my profile form',
            '#default_value' => 'Contact Preference<hr>',
          ],
        ],
      ],

      'submit' => [
        'name' => 'Save',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Save Label',
            '#type' => 'textfield',
            '#description' => 'Label for the Save button',
            '#default_value' => 'Save Changes',
          ],
        ],
      ],

      'button_cancel' => [
        'name' => 'Button Cancel',
        'type' => 'button',
        'settings' => [
          'label' => [
            '#title' => 'Cancel Label',
            '#type' => 'textfield',
            '#description' => 'Label for the Cancel button',
            '#default_value' => 'Cancel',
          ],
        ],
      ],
    ];
  }

}
