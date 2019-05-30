<?php

namespace Drupal\ghana_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * GhanaAccountForm.
 *
 * @WebcomposerForm(
 *   id = "ghana_account_form",
 *   name = "Ghana Account Form",
 * )
 */
class GhanaAccountForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Account Form',
        '#type' => 'textfield',
        '#description' => 'Account Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {
    return [

      'account_details_title' => [
        'name' => 'Account Details Title Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Account Details Title Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text for the Account details title.',
            '#default_value' => 'Account Details',
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
            '#title' => 'Last Name label',
            '#type' => 'textfield',
            '#description' => 'label for Last Name field',
            '#default_value' => 'Last Name',
          ],
          'placeholder' => [
            '#title' => 'Last Name placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Last Name field placeholder',
            '#default_value' => 'Last Name',
          ],
          'annotation' => [
            '#title' => 'Last Name Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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

      'email' => [
        'name' => 'Email',
        'type' => 'email',
        'settings' => [
          'label' => [
            '#title' => 'Email label',
            '#type' => 'textfield',
            '#description' => 'label for Email field',
            '#default_value' => 'Email',
          ],
          'placeholder' => [
            '#title' => 'Email placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Email field placeholder',
            '#default_value' => 'Email',
          ],
          'annotation' => [
            '#title' => 'Email Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'pin' => [
        'name' => 'PIN',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'PIN label',
            '#type' => 'textfield',
            '#description' => 'label for PIN field',
            '#default_value' => 'PIN',
          ],
          'placeholder' => [
            '#title' => 'PIN placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for PIN field placeholder',
            '#default_value' => 'PIN',
          ],
          'annotation' => [
            '#title' => 'PIN Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'country' => [
        'name' => 'Country',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Country label',
            '#type' => 'textfield',
            '#description' => 'label for Country field',
            '#default_value' => 'Country',
          ],
          'placeholder' => [
            '#title' => 'Country placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Country field placeholder',
            '#default_value' => 'Country',
          ],
          'annotation' => [
            '#title' => 'Country Annotation text',
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

      'breakline_1' => [
        'name' => 'Break Line Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text breakline for Security Question form',
            '#default_value' => '<hr>',
          ],
        ],
      ],

      'security_questions_title' => [
        'name' => 'Security Questions Title Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Security Questions Title Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text for the Security questions title.',
            '#default_value' => 'Security Questions',
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
            '#description' => 'The Label for the Currency field',
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

      'submit' => [
        'name' => 'Submit',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Submit Label',
            '#type' => 'textfield',
            '#description' => 'Label for the submit button',
            '#default_value' => 'Save Changes',
          ],
        ],
      ],
    ];
  }

}
