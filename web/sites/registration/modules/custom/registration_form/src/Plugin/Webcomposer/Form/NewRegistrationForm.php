<?php

namespace Drupal\registration_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * NewRegistrationForm.
 *
 * @WebcomposerForm(
 *   id = "new_registration_form",
 *   name = "New Registration Form",
 * )
 */
class NewRegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface
{

  /**
   * Get Settings.
   */
  public function getSettings()
  {
    return [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => TRUE,
      ],
      'alias' => [
        '#title' => 'New Registration Form',
        '#type' => 'textfield',
        '#description' => 'Registration Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields()
  {
    return [

      'back_button' => [
        'name' => 'Back Button',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Back Button Markup',
            '#type' => 'textarea',
            '#description' => 'HTML markup for Back Button.',
            '#default_value' => '<span class="back-btn btn-small btn"' .
              ' style="float:right; margin:0 22px 10px; display:none">Back</span>',
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

      'breakline_1' => [
        'name' => 'Break Line Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<hr>',
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
          'suggestion_message_domains' => [
            '#title' => 'Suggestion Message For PT and ES Languages',
            '#type' => 'textfield',
            '#description' => 'Suggestion Message',
          ],
          'list_accept_domains' => [
            '#title' => 'List Accepted Domains For PT and ES Languages',
            '#type' => 'textarea',
            '#description' => 'e.g.(gmail.com outlook.com ...) List of Accepted Domains For PT and ES Languages',
          ],
          'suggestion_message_is_enabled' => [
            '#title' => 'Toggle of Suggestion Message For PT and ES Languages',
            '#type' => 'checkbox',
            '#description' => 'Enable or Disable Suggestion Message Feature',
          ],
        ],
      ],

      'mobile_number_area_code' => [
        'name' => 'Mobile Number Area Code',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Mobile Number Area Code Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Mobile Number Area Code field',
          ],
          'placeholder' => [
            '#title' => 'Mobile Number Area Code placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Mobile number Area Code field placeholder',
          ],
          'annotation' => [
            '#title' => 'Mobile Number Area Code Annotation text',
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
          'additional_country_code_validation' => [
            '#title' => 'Additional Custom Validation for +55 Country Code',
            '#type' => 'textfield',
            '#description' => 'e.g.(55|9|0|error message) Area code that will be validated then the third number must be a 9 and the fourth number cannot be 0 and error message',
          ],
          'list_states_codes_accept' => [
            '#title' => 'List of states codes accept for +55 Country Code',
            '#type' => 'textarea',
            '#description' => 'e.g.(34,35,37,38) The first two numbers must be states code.',
          ],
          'additional_country_code_validation_list' => [
            '#title' => 'Additional Custom Validation for list Country Code',
            '#type' => 'textarea',
            '#description' => 'e.g.(62|8|error message) Area code that will be validated.',
          ],
        ],
      ],

      'breakline_2' => [
        'name' => 'Break Line Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<hr>',
          ],
        ],
      ],


      'pan_id_description_text' => [
        'name' => 'Upload Pan ID Description Text',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Pan ID Description Text',
            '#type' => 'textarea',
            '#description' => 'Here we can add description for file size file type etc for pan id upload.',
            '#default_value' => ' Maximum of 8MB(JPG, JPEG, PNG, TIFF, GIF) ',
          ]
        ],
      ],
      'upload_id_choose_type' => [
        'name' => 'ID Types',
        'type' => 'custom_select',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Placeholder for the document type selection dropdown',
            '#default_value' => '<span style="color:red; font-weight:bold">Optional:</span> <span style="font-style: italic;">Upload a clear front copy of your ID:</span>',
            '#translatable' => true,
            '#maxlength' => 255,
          ],
          'placeholder' => [
            '#title' => 'Placeholder',
            '#type' => 'textfield',
            '#description' => 'Placeholder for the document type selection dropdown',
            '#default_value' => '- Select One -',
            '#translatable' => true,
          ],
        ],
      ],
      'pan_id_upload' => [
        'name' => 'Upload Pan ID',
        'type' => 'file',
        'translatable' => true,
        'settings' => [
          'label' => [
            '#title' => 'Pan ID label',
            '#type' => 'textfield',
            '#description' => 'label for Pan ID field',
          ],
          'pan_id_url' => [
            '#title' => 'Insert PAN ID url',
            '#type' => 'textfield',
            '#description' => 'Insert PAN ID title so First name, Last Name and Birth of Date will be fetched from this url'
          ],
          'pan_id_values_mapping' => [
            '#title' => 'Insert Mapping for First Name, Last Name and Birth of Date',
            '#type' => 'textarea',
            '#description' => 'Here we should insert first name, last name and birth of date to be populated into form.',
            '#required' => true,
          ],
          'error_extension' => [
            '#title' => 'Add error message for file extension',
            '#type' => 'textfield',
            '#description' => 'Here we can specify error message that will appear in FE.',
            '#required' => true,
          ],
          'upload_btn_text' => [
            '#title' => 'Upload Button Text',
            '#type' => 'textarea',
            '#description' => 'field for uplaod button text',
          ],

          'is_enabled' => [
            '#title' => 'Enable Pan ID feature',
            '#type' => 'checkbox',
            '#description' => 'Enable or disable PAN ID feature',
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
            '#description' => 'label for First name field placeholder',
          ],
          'annotation' => [
            '#title' => 'First Name Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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
            '#description' => 'label for Last name field placeholder',
          ],
          'annotation' => [
            '#title' => 'Last Name Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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
          'placeholder' => [
            '#title' => 'Birthdate placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Birthdate field placeholder',
          ],
          'date-format' => [
            '#title' => 'Birthdate format',
            '#type' => 'textfield',
            '#description' => 'Date Format for Birthdate',
          ],
          'annotation' => [
            '#title' => 'Birthdate Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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
          'latam_currency_mapping_enabled' => [
            '#title' => 'Enable LATAM currencies filtering',
            '#type' => 'checkbox',
            '#description' => 'Filtering of LATAM currencies switch.',
            '#default_value' => false,
          ],
          'latam_currency_mapping' => [
            '#title' => 'Mapping of currencies for LATAM teritories',
            '#type' =>'textarea',
            '#description' => 'Mapping of currencies to be filtered out based on players GEO Location {COUNTRY_CODE|CURRENCIES}',
            '#default_value' => implode(PHP_EOL, [
              'BR|BRL,USD,USDT,BTC',
              'PE|PEN,USD,USDT,BTC',
              'MX|MXN,USD,USDT,BTC',
              'CH|CLP,USD,USDT,BTC',
              'AR|ARS,USD,USDT,BTC',
              'AW|USD,USDT,BTC',
              'BS|USD,USDT,BTC',
              'BB|USD,USDT,BTC',
              'KY|USD,USDT,BTC',
              'CU|USD,USDT,BTC',
              'DM|USD,USDT,BTC',
              'DO|USD,USDT,BTC',
              'GD|USD,USDT,BTC',
              'GP|USD,USDT,BTC',
              'HT|USD,USDT,BTC',
              'JM|USD,USDT,BTC',
              'MQ|USD,USDT,BTC',
              'BL|USD,USDT,BTC',
              'VG|USD,USDT,BTC',
              'BZ|USD,USDT,BTC',
              'CR|USD,USDT,BTC',
              'SV|USD,USDT,BTC',
              'GT|USD,USDT,BTC',
              'HN|USD,USDT,BTC',
              'NI|USD,USDT,BTC',
              'PA|USD,USDT,BTC',
              'BO|USD,USDT,BTC',
              'CO|USD,USDT,BTC',
              'EC|USD,USDT,BTC',
              'GF|USD,USDT,BTC',
              'GY|USD,USDT,BTC',
              'PY|USD,USDT,BTC',
              'SR|USD,USDT,BTC',
              'UY|USD,USDT,BTC',
              'VE|USD,USDT,BTC',
            ])
          ]
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

      'breakline_3' => [
        'name' => 'Break Line Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<hr>',
          ],
        ],
      ],

      'bonus_code' => [
        'name' => 'Bonus Code',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Bonus Code label',
            '#type' => 'textfield',
            '#description' => 'label for Bonus Code field',
          ],
          'placeholder' => [
            '#title' => 'Bonus code placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Bonus code field placeholder',
          ],
          'annotation' => [
            '#title' => 'Bonus code Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
          'is_hidden' => [
            '#title' => 'Hide Bonus Code',
            '#type' => 'checkbox',
            '#description' => 'Enable or disable bonus code',
          ],
        ],
      ],

      'captcha' => [
        'name' => 'Sliding Captcha',
        'type' => 'checkbox',
        'settings' => [
          'enabled' => [
            '#title' => 'Enable this field',
            '#type' => 'checkbox',
            '#description' => 'Captcha will show on the form when enabled.'
          ],
          'initial' => [
            '#title' => 'Initial State Text',
            '#type' => 'textfield',
            '#description' => 'Will show when user is not yet sliding the captcha'
          ],
          'sliding' => [
            '#title' => 'Sliding State Text',
            '#type' => 'textfield',
            '#description' => 'Will show when user is sliding the captcha'
          ],
          'failed' => [
            '#title' => 'Failed State Text',
            '#type' => 'textfield',
            '#description' => 'Will show when user left the captcha unfinished'
          ],
          'success' => [
            '#title' => 'Success State Text',
            '#type' => 'textfield',
            '#description' => 'Will show after sliding the captcha'
          ]
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

      'ioblackbox' => [
        'name' => 'Iovation Blackbox hidden field',
        'type' => 'hidden',
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
