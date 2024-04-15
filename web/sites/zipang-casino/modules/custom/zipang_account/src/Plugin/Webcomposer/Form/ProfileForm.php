<?php

namespace Drupal\zipang_account\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ProfileForm.
 *
 * @WebcomposerForm(
 *   id = "profile_form",
 *   name = "Profile Form",
 * )
 */
class ProfileForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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

      'vip_level' => [
        'name' => 'VIP Level',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'VIP Level label',
            '#type' => 'textfield',
            '#description' => 'label for VIP Level field',
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
          'annotation' => [
            '#title' => 'Annotation text',
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
            '#description' => 'Last name placeholder label',
          ],
          'annotation' => [
            '#title' => 'Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'birth_year' => [
        'name' => 'Birth Year',
        'type' => 'select',
        'settings' => [
            'label' => [
                '#title' => 'Birth Year Label',
                '#type' => 'textfield',
                '#description' => 'The Label for the Birth Year field',
            ],
            'choices' => [
                '#title' => 'Birth Year Choices',
                '#type' => 'textarea',
                '#description' => 'Provide a pipe-separated key-value pair. <br> <small>Example key|My Value</small>',
                '#default_value' => implode(PHP_EOL, array_map(function($year) {
                    return $year . '|' . $year;
                }, range(date('Y') - 18, date('Y') - 100))), // Adjust the range as needed
            ],
        ],
      ],

      'birth_month' => [
        'name' => 'Birth Month',
        'type' => 'select',
        'settings' => [
            'label' => [
                '#title' => 'Birth Month Label',
                '#type' => 'textfield',
                '#description' => 'The Label for the Birth Month field',
            ],
            'choices' => [
                '#title' => 'Birth Month Choices',
                '#type' => 'textarea',
                '#description' => 'Provide a pipe-separated key-value pair. <br> <small>Example key|My Value</small>',
                '#default_value' => implode(PHP_EOL, [
                    '1|January',
                    '2|February',
                    '3|March',
                    '4|April',
                    '5|May',
                    '6|June',
                    '7|July',
                    '8|August',
                    '9|September',
                    '10|October',
                    '11|November',
                    '12|December',
                ]),
            ],
        ],
      ],

      'birth_day' => [
        'name' => 'Birth Day',
        'type' => 'select',
        'settings' => [
            'label' => [
                '#title' => 'Birth Day Label',
                '#type' => 'textfield',
                '#description' => 'The Label for the Birth Day field',
            ],
            'choices' => [
              '#title' => 'Birth Day Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe-separated key-value pair. <br> <small>Example key|My Value</small>',
              '#default_value' => implode(PHP_EOL, array_map(function($day) {
                  return $day . '|' . $day;
              }, range(1, 31))),
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
      
      'verify_email' => [
          'name' => 'verify_email',
          'type' => 'submit',
          'settings' => [
              'label' => [
                  '#title' => 'Verify',
                  '#type' => 'textfield',
                  '#description' => 'Label for the Verify Email',
                  '#default_value' => 'Verify',
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
          'choices' => [
            '#title' => 'Country Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              '109|Japan',
              '48|China',
              '153|Malaysia',
              '231|Vietnam',
              '208|Thailand',
            ]),
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
          'annotation' => [
            '#title' => 'Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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

      'verify_mobile' => [
        'name' => 'verify_mobile',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Verify',
            '#type' => 'textfield',
            '#description' => 'Label for the Verify Mobile',
            '#default_value' => 'Verify',
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
              'en-GB|English',
              'ja|Japanese (日本語)',
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

      'prefecture' => [
        'name' => 'Prefecture',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Prefecture Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Prefecture field',
          ],
          'placeholder' => [
            '#title' => 'Prefecture placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for prefecture field placeholder',
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

      'coupon_markup' => [
        'name' => 'Coupon Code Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Coupon Code details for with Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text my profile form',
            '#default_value' => 'Coupon Code<hr>',
          ],
        ],
      ],

      'coupon_code' => [
        'name' => 'Coupon Code',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Coupon Code Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Coupon Code field',
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
    ];
  }

}
