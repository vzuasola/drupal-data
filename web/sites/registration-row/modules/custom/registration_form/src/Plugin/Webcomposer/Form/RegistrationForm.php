<?php

namespace Drupal\registration_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm.
 *
 * @WebcomposerForm(
 *   id = "registration_form",
 *   name = "Registration Form",
 * )
 */
class RegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {
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
            '#default_value' => 'Username',
          ],
          'placeholder' => [
            '#title' => 'Username placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Username field placeholder',
            '#default_value' => 'Username',
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
            '#default_value' => 'Password',
          ],
          'placeholder' => [
            '#title' => 'Password placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Password field placeholder',
            '#default_value' => 'Password',
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

      'confirm_password' => [
        'name' => 'Confirm Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Confirm Password label',
            '#type' => 'textfield',
            '#description' => 'The Label for Password field',
            '#default_value' => 'Confirm Password',
          ],
          'placeholder' => [
            '#title' => 'Confirm Password placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Password field placeholder',
            '#default_value' => 'Confirm Password',
          ],
          'annotation' => [
            '#title' => 'Confirm Password Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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

      'first_name' => [
        'name' => 'First Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'First Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the First Name field',
            '#default_value' => 'First Name',
          ],
          'placeholder' => [
            '#title' => 'First name placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for First name field placeholder',
            '#default_value' => 'First Name',
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
            '#default_value' => 'Last Name',
          ],
          'placeholder' => [
            '#title' => 'Last name placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Last name field placeholder',
            '#default_value' => 'Last Name',
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
            '#default_value' => 'Date of Birth',
          ],
          'placeholder' => [
            '#title' => 'Birthdate placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Birthdate field placeholder',
            '#default_value' => 'DD/MM/YYYY',
          ],
          'date-format' => [
            '#title' => 'Birthdate format',
            '#type' => 'textfield',
            '#description' => 'Date Format for Birthdate',
            '#default_value' => 'DD/MM/YYYY',
          ],
          'annotation' => [
            '#title' => 'Birthdate Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'security_question_1' => [
        'name' => 'Security Question 1',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Security Question 1 Label',
            '#type' => 'textfield',
            '#description' => 'The dLabel for the Currency field',
            '#default_value' => 'Security Question 1',
          ],
          'placeholder' => [
            '#title' => 'Choose a Security Question 1',
            '#type' => 'textfield',
            '#description' => 'Placeholder value for this textfield',
            '#default_value' => 'Select your question...',
          ],
          'groups' => [
            '#title' => 'Group Name',
            '#type' => 'textfield',
            '#description' => 'Group name for Security Answer 1',
            '#default_value' => 'security-question',
          ],
          'choices' => [
            '#title' => 'Security Question 1 Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              '1|What is your mother’s maiden name?',
              '2|What is your father’s first name?',
              '3|What is the model of your first car?',
            ]),
          ],
        ],
      ],

      'security_answer_1' => [
        'name' => 'Security Answer 1',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Security Answer 1 label',
            '#type' => 'textfield',
            '#description' => 'label for Security Answer 1 field',
            '#default_value' => 'Security Answer 1',
          ],
          'placeholder' => [
            '#title' => 'Security Answer 1 placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Security Answer 1 field placeholder',
            '#default_value' => 'Security Answer 1',
          ],
          'annotation' => [
            '#title' => 'Security Answer 1 Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'security_question_2' => [
        'name' => 'Security Question 2',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Security Question 2 Label',
            '#type' => 'textfield',
            '#description' => 'The dLabel for the Currency field',
            '#default_value' => 'Security Question 2',
          ],
          'placeholder' => [
            '#title' => 'Choose a Security Question 2',
            '#type' => 'textfield',
            '#description' => 'Placeholder value for this textfield',
            '#default_value' => 'Select your question...',
          ],
          'groups' => [
            '#title' => 'Group Name',
            '#type' => 'textfield',
            '#description' => 'Group name for Security Answer 1',
            '#default_value' => 'security-question',
          ],
          'choices' => [
            '#title' => 'Security Question 2 Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => implode(PHP_EOL, [
              '1|What is your mother’s maiden name?',
              '2|What is your father’s first name?',
              '3|What is the model of your first car?',
            ]),
          ],
        ],
      ],

      'security_answer_2' => [
        'name' => 'Security Answer 2',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Security Answer 2 label',
            '#type' => 'textfield',
            '#description' => 'label for Security Answer 2 field',
            '#default_value' => 'Security Answer 2',
          ],
          'placeholder' => [
            '#title' => 'Security Answer 2 placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Security Answer 2 field placeholder',
            '#default_value' => 'Security Answer 2',
          ],
          'annotation' => [
            '#title' => 'Security Answer 2 Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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

      'accept_terms' => [
        'name' => 'Accept Terms Markup',
        'type' => 'checkbox',
        'settings' => [
          'markup' => [
            '#title' => 'Accept Terms Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for accept terms and conditions beside the submit button',
            '#default_value' => 'I have read and accept the Terms and Condition',
          ],
        ],
      ],

      'legal_age' => [
        'name' => 'Legal Age Markup',
        'type' => 'checkbox',
        'settings' => [
          'markup' => [
            '#title' => 'Legal Age Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for accept terms and conditions beside the submit button',
            '#default_value' => 'I am at least 18 years old',
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
