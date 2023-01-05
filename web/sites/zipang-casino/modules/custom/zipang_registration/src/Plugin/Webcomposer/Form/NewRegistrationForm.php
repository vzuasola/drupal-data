<?php

namespace Drupal\zipang_registration\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * NewRegistrationForm
 *
 * @WebcomposerForm(
 *   id = "new_zipang_registration_form",
 *   name = "New Zipang Registration Form",
 * )
 */
class NewRegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {
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
      // step 1
      'wrapper_step_1_start' => [
        'name' => 'Wrapper Start Step 1',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Opening Wrapper',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<div class ="fieldset-wrapper-step-1">',
          ],
        ],
      ],
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
            '#title' => 'User Name placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for User Name field',
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
            '#description' => 'The label for the First Name field',
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
            '#description' => 'Placeholder label for Password field',
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
            '#description' => 'Placeholder label for Confirm Password field',
          ],
        ],
      ],
      'wrapper_step_1_end' => [
        'name' => 'Wrapper End Step 1',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Wrapper End Step1',
            '#type' => 'textarea',
            '#description' => 'Closing wrapper',
            '#default_value' => '</div>',
          ],
        ],
      ],
      // step 2
      'wrapper_step_2_start' => [
        'name' => 'Wrapper Start Step 2',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Opening Wrapper',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<div class ="fieldset-wrapper-step-2 hidden">',
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
            '#title' => 'Email Address placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Email Address field',
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
            '#title' => 'Confirm Email placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Confirm Email field',
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
            '#title' => 'Date of Birth placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Date of Birth field',
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
            '#description' => 'Placeholder label for Contact Number field',
          ],
        ],
      ],
      'wrapper_step_2_end' => [
        'name' => 'Wrapper End Step 2',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Wrapper End Step 2',
            '#type' => 'textarea',
            '#description' => 'Closing wrapper',
            '#default_value' => '</div>',
          ],
        ],
      ],
      // step 3
      'wrapper_step_3_start' => [
        'name' => 'Wrapper Start Step 3',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Opening Wrapper',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<div class ="fieldset-wrapper-step-3 hidden">',
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
            '#description' => 'Placeholder label for Currency field',
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
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Prefecture Label',
            '#type' => 'textfield',
            '#description' => 'The Label for the Prefecture field',
          ],
          'placeholder' => [
            '#title' => 'Prefecture placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Prefecture field',
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
            '#description' => 'Placeholder label for State field',
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
            '#description' => 'Placeholder label for Password field',
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
            '#title' => 'Zip Code/Postal Code placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Zip Code/Postal Code field',
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
            '#description' => 'Placeholder label for Address field',
          ],
        ],
      ],
      'wrapper_step_3_end' => [
        'name' => 'Wrapper End Step 3',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Wrapper End Step 3',
            '#type' => 'textarea',
            '#description' => 'Closing wrapper',
            '#default_value' => '</div>',
          ],
        ],
      ],
      // step 4
      'wrapper_step_4_start' => [
        'name' => 'Wrapper Start Step 4',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Opening Wrapper',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<div class ="fieldset-wrapper-step-4 hidden">',
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
            '#default_value' => '',
          ],
        ],
      ],
      'term_conditions_help_text' => [
        'name' => 'Accept Terms Help Text',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Accept Terms Help Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for Accept Terms',
            '#default_value' => '<div class="term_conditions_help_text">I am at least 18 years old and have read and accept the Terms and Condition</div>',
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
      'coupon_code_help_text' => [
        'name' => 'Coupon Help Text',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Coupon Help Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for Coupon Field',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">You can use this [zipang] coupon if you don\'t have</div>',
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
            '#description' => 'The Label for Coupon Code field',
          ],
          'placeholder' => [
            '#title' => 'Coupon Code placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder label for Coupon Code field',
          ],
        ],
      ],
      'captcha_help_text' => [
        'name' => 'Captcha Help Text',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Captcha Help Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for Captcha Field',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">Enter the authentication code shown in the image.</div>',
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
      'wrapper_step_4_end' => [
        'name' => 'Wrapper End Step 4',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Wrapper End Step 4',
            '#type' => 'textarea',
            '#description' => 'Closing wrapper',
            '#default_value' => '</div>',
          ],
        ],
      ],
      'wrapper_start_button' => [
        'name' => 'Wrapper Start Button',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Opening Wrapper',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for registration form',
            '#default_value' => '<div class ="fieldset-wrapper-buttons">',
          ],
        ],
      ],
      'submit' => [
        'name' => 'Create an Account',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Submit Label',
            '#type' => 'textfield',
            '#description' => 'Label for the submit button',
            '#default_value' => 'Create an Account',
          ],
        ],
      ],
      'back' => [
        'name' => 'Back',
        'type' => 'button',
        'settings' => [
          'label' => [
            '#title' => 'Back Button Label',
            '#type' => 'textfield',
            '#description' => 'Label for the back button',
            '#default_value' => 'Back',
          ],
        ],
      ],
      'wrapper_end_button' => [
        'name' => 'Wrapper End Button',
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
    ];
  }
}
