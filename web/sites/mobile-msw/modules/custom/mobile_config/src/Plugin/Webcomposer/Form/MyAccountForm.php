<?php

namespace Drupal\mobile_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MyAccountForm.
 *
 * @WebcomposerForm(
 *   id = "my_account_form",
 *   name = "My Account Form",
 * )
 */
class MyAccountForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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

  private function questions() {
    return implode(PHP_EOL, [
        '1|What is your mother’s maiden name?',
        '2|What is your father’s first name?',
        '3|What is the model of your first car??',
        '4|What is the name of your first school??',
        '5|What is the name of your first pet?',
        '6|Place of Birth?',
        '7|Favorite celebrity?',
        '8|Favorite food?',
        '9|Favorite sport team?',
        '10|Place of work?',
        '11|Ask for security answer?',
        '13|What is your favorite color?',
        '14|What is your date of birth?',
      ]);
  }

  /**
   * Set Fields.
   */
  public function getFields() {
    $questions = $this->questions();

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

      'middle_name' => [
        'name' => 'middle Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'middle Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the middle Name field',
          ],
          'placeholder' => [
            '#title' => 'middle name placeholder label',
            '#type' => 'textfield',
            '#description' => 'middle name placeholder label',
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

      'telebet_pin' => [
        'name' => 'RFID PIN',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'RFID PIN Label',
            '#type' => 'textfield',
            '#description' => 'RFID PIN field label',
          ],
          'placeholder' => [
            '#title' => 'RFID PIN placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for RFID PIN field placeholder',
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
        'name' => 'Street / House number',
        'type' => 'textarea',
        'settings' => [
          'label' => [
            '#title' => 'Street / House number label',
            '#type' => 'textfield',
            '#description' => 'label for Street / House number field',
          ],
          'placeholder' => [
            '#title' => 'Street / House number placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Street / House number field placeholder',
          ],
        ],
      ],

      'province' => [
        'name' => 'Province',
        'type' => 'textarea',
        'settings' => [
          'label' => [
            '#title' => 'Province label',
            '#type' => 'textfield',
            '#description' => 'label for Province field',
          ],
          'placeholder' => [
            '#title' => 'Province placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for rovince field placeholder',
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

      'security_questions_markup' => [
        'name' => 'Security Questions Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Security Questions with Horizontal Line Markup',
            '#type' => 'textarea',
            '#description' => 'A Markup text my profile form',
            '#default_value' => 'Security Questions<hr>',
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
            '#default_value' => $questions,
          ],
        ],
      ],

      'security_answer_1' => [
        'name' => 'Security Answer 1',
        'type' => 'password',
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

      'password_icon_markup1' => [
        'name' => 'Password mask icon markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Password mask icon markup',
            '#type' => 'textarea',
            '#description' => 'A markup for password-mask-icon',
            '#default_value' => '<span class="password-mask-icon mask"></span>',
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
            '#default_value' => $questions,
          ],
        ],
      ],

      'security_answer_2' => [
        'name' => 'Security Answer 2',
        'type' => 'password',
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

      'contact_preference' => [
        'name' => 'Contact preference',
        'type' => 'checkbox',
        'settings' => [
          'label' => [
            '#title' => 'Contact preference',
            '#type' => 'textfield',
            '#description' => 'The label for contact preferences',
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
