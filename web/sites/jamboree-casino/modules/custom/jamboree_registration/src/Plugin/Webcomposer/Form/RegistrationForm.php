<?php

namespace Drupal\jamboree_registration\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm
 *
 * @WebcomposerForm(
 *   id = "jamboree_registration_form",
 *   name = "Jamboree Registration Form",
 * )
 */
class RegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {
    /**
     * @{inheritdoc}
     */
  public function getSettings() {
  }

    /**
     * @{inheritdoc}
     */
  public function getFields() {
    return [
      'username' => [
        'name' => 'User Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'User Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the User Name field',
          ],
          'placeholder' => [
            '#title' => 'Username placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Username field',
          ],
        ],
      ],
      'firstname' => [
        'name' => 'First Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'First Name Label',
            '#type' => 'textfield',
            '#description' => 'Label for the First Name field',
          ],
          'placeholder' => [
            '#title' => 'First Name placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for First Name field',
          ],
        ],
      ],
      'lastname' => [
        'name' => 'Last Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Last Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Last Name field',
          ],
          'placeholder' => [
            '#title' => 'Last Name placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Last Name field',
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
            '#description' => 'Placeholder label for password field',
          ],
        ],
      ],
      'confirm_password' => [
        'name' => 'Confirm Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Confirm Password label',
            '#type' => 'textfield',
            '#description' => 'The Label for Confirm Password field',
          ],
          'placeholder' => [
            '#title' => 'Confirm Password placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for confirm password field',
          ],
        ],
      ],
      'gender' => [
        'name' => 'Gender',
        'type' => 'radios',
        'settings' => [
          'label' => [
            '#title' => 'Gender label',
            '#type' => 'textfield',
            '#description' => 'The Label for Gender field',
          ],
          'choices' => [
            '#title' => 'Gender',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              'M|Male',
              'F|Female',
            ]),
          ],
          'data' => [
            '#title' => 'Gender',
            '#type' => 'textarea',
            '#description' => 'Default Value for Gender',
            '#default_value' => "M",
          ],
        ],
      ],
      'email' => [
        'name' => 'Email Address',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Email Address Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Email Address field',
          ],
          'placeholder' => [
            '#title' => 'Email placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for email field',
          ],
        ],
      ],
      'confirm_email' => [
        'name' => 'Confirm Email Address',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Confirm Email Address Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Confirm Email Address field',
          ],
          'placeholder' => [
            '#title' => 'Confirm email address placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for confirm email address field',
          ],
        ],
      ],
      'birthdate' => [
        'name' => 'Date of Birth',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Date of Birth Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Birthdate field',
          ],
          'placeholder' => [
            '#title' => 'Date of birth placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for date of birth field',
          ],
        ],
      ],
      'phone' => [
        'name' => 'Contact Number',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Contact Number Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Contact Number field',
          ],
          'placeholder' => [
            '#title' => 'Contact Number placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for contact number field',
          ],
        ],
      ],
      'currency' => [
        'name' => 'Currency',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Currency Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Currency field',
          ],
          'placeholder' => [
            '#title' => 'Currency placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for currency field',
          ],
          'data' => [
            '#title' => 'Currency Default Value',
            '#type' => 'textfield',
            '#description' => 'Currency Default Value',
            '#default_value' => 'USD'
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
            '#title' => 'Country placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for country field',
          ],
          'choices' => [
            '#title' => 'Country Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              'jp|Japan',
            ]),
          ],
        ],
      ],
      'prefecture' => [
        'name' => 'Prefecture',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Prefecture Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Prefecture field',
          ],
          'placeholder' => [
            '#title' => 'Prefecture placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for prefecture field',
          ],
          'choices' => [
            '#title' => 'Prefecture Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              'ho|Hokkaido',
            ]),
          ],
        ],
      ],
      'state' => [
        'name' => 'State',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'State Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the State field',
          ],
          'placeholder' => [
            '#title' => 'State placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for state field',
          ],
        ],
      ],
      'city' => [
        'name' => 'Town/City',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Town/City Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Town/City field',
          ],
          'placeholder' => [
            '#title' => 'Town/City placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for town/city field',
          ],
        ],
      ],
      'zipcode' => [
        'name' => 'Zip Code/Postal Code',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Zip Code/Postal Code Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Zip Code/Postal Code field',
          ],
          'placeholder' => [
            '#title' => 'Zip Code/Postal placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for zip code/postal field',
          ],
        ],
      ],
      'address' => [
        'name' => 'Address',
        'type' => 'textarea',
        'settings' => [
          'label' => [
            '#title' => 'Address Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Address field',
          ],
          'placeholder' => [
            '#title' => 'Address placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for address field',
          ],
        ],
      ],
      'wrapper_start' => [
        'name' => 'Wrapper Start',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Opening Wrapper',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<div class ="fieldset-wrapper">',
          ],
        ],
      ],
      'term_conditions' => [
        'name' => 'Accept Terms',
        'type' => 'checkbox',
        'settings' => [
          'label' => [
            '#title' => 'Accept Terms Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for accept terms and conditions',
            '#default_value' => 'I am at least 18 years old and have read and accept the Terms and Condition',
          ],
        ],
      ],
      'promotions' => [
        'name' => 'Promotions',
        'type' => 'checkbox',
        'settings' => [
          'label' => [
            '#title' => 'Promotions Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for Promotions',
            '#default_value' => 'I would like to receive information about promotions and updates.',
          ],
        ],
      ],
      'wrapper_end' => [
        'name' => 'Wrapper End',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Wrapper End',
            '#type' => 'textarea',
            '#description' => 'Closing wrapper',
            '#default_value' => '</div>',
          ],
        ],
      ],
      'captcha' => [
        'name' => 'Captcha',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Captcha Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Captcha field',
          ],
          'placeholder' => [
            '#title' => 'Captcha placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Captcha field',
          ],
        ],
      ],
      'ip' => [
        'name' => 'IP address',
        'type' => 'hidden',
      ],
      'creferer' => [
        'name' => 'Creferer',
        'type' => 'hidden',
      ],
      'advertiser' => [
        'name' => 'Advertiser',
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
