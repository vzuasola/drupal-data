<?php

namespace Drupal\msw_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MSWRegistrationFOrmOnline.
 *
 * @WebcomposerForm(
 *   id = "msw_registration_form_online",
 *   name = "MSW Registration Form Online",
 * )
 */

 class MSWRegistrationFormOnline extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        'account_and_contact_details' => [
          'name' => 'Account and Contact Details',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Account and Contact Details',
              '#type' => 'textarea',
              '#description' => 'Account and Contact Details',
              '#default_value' => '<p class="msw-registration-online-contact-details">Account and Contact Details</p>',
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

        'mobile_phone' => [
          'name' => 'Mobile phone',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'Mobile phone Label',
              '#type' => 'textfield',
              '#description' => 'The label for the Mobile phone field',
              '#default_value' => 'Mobile phone',
            ],
            'placeholder' => [
              '#title' => 'Mobile phone placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for Mobile phone field placeholder',
              '#default_value' => 'Mobile phone',
            ],
            'annotation' => [
              '#title' => 'Mobile phone Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'contact_preference_select' => [
          'name' => 'Contact Preference Select',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Contact Preference Select',
              '#type' => 'textfield',
              '#description' => 'Contact Preference field',
              '#default_value' => 'Contact Preference',
            ],
            'placeholder' => [
              '#title' => 'Choose a Contact Preference',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Select your Contact Preference...',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Contact Preference',
              '#default_value' => 'contact-preference',
            ],
            'choices' => [
              '#title' => 'Contact Preference Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>facebook|Facebook| [username or number]</small>',
            ],
          ],
        ],

        'contact_preference' => [
          'name' => 'Contact Preference',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'Contact Preference label',
              '#type' => 'textfield',
              '#description' => 'label for Contact Preference field',
              '#default_value' => 'Contact Preference',
            ],
            'placeholder' => [
              '#title' => 'Contact Preference placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for Contact Preference field placeholder',
              '#default_value' => 'Contact Preference',
            ],
            'annotation' => [
              '#title' => 'Contact Preference Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'basic_information' => [
          'name' => 'Basic Information',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Basic Information',
              '#type' => 'textarea',
              '#description' => 'Basic Information',
              '#default_value' => '<p class="msw-registration-online-basic-information">Basic Information</p>',
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

        'middle_name' => [
          'name' => 'Middle Name',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'Middle Name Label',
              '#type' => 'textfield',
              '#description' => 'The label for the Middle Name field',
              '#default_value' => 'Middle Name',
            ],
            'placeholder' => [
              '#title' => 'Middle name placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for Middle name field placeholder',
              '#default_value' => 'Middle Name',
            ],
            'annotation' => [
              '#title' => 'Middle Name Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
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

        'nationality_select' => [
          'name' => 'Nationality Select',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Nationality Select',
              '#type' => 'textfield',
              '#description' => 'Nationality field',
              '#default_value' => 'Nationality',
            ],
            'placeholder' => [
              '#title' => 'Choose a Nationality',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Nationality',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Nationality',
              '#default_value' => 'nationality',
            ],
            'choices' => [
              '#title' => 'Nationality Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>nationality|Nationality</small>',
            ],
          ],
        ],

        'source_of_income_select' => [
          'name' => 'Source of Income Select',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Source of Income Select',
              '#type' => 'textfield',
              '#description' => 'Source of Income field',
              '#default_value' => 'Source of Income',
            ],
            'placeholder' => [
              '#title' => 'Choose a Source of Income',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Source of Income',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Source of Income',
              '#default_value' => 'source-of-income',
            ],
            'choices' => [
              '#title' => 'Source of Income Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>salary|Salary</small>',
            ],
          ],
        ],

        'source_of_income_others' => [
          'name' => 'Source of Income Others',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'Source of Income Label',
              '#type' => 'textfield',
              '#description' => 'The label for the Source of Income field',
              '#default_value' => '(Others) Source of Income',
            ],
            'placeholder' => [
              '#title' => 'Source of Income placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for Source of Income field placeholder',
              '#default_value' => '(Others) Source of Income',
            ],
            'annotation' => [
              '#title' => 'Source of Income Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'address_and_home_outlet' => [
          'name' => 'Address and Home Outlet',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Address and Home Outlet',
              '#type' => 'textarea',
              '#description' => 'Address and Home Outlet',
              '#default_value' => '<p class="msw-registration-online-address-and-home-outlet">Address and Home Outlet</p>',
            ],
          ],
        ],

        'province' => [
          'name' => 'Province',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Province Label',
              '#type' => 'textfield',
              '#description' => 'The Label for the province field',
              '#default_value' => 'Province',
            ],
            'placeholder' => [
              '#title' => 'Choose a Province',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Province',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Province',
              '#default_value' => 'province',
            ],
            'choices' => [
              '#title' => 'Province Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>province|Province</small>',
            ],
          ],
        ],

        'city' => [
          'name' => 'City',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'City Label',
              '#type' => 'textfield',
              '#description' => 'The Label for the Currency field',
              '#default_value' => 'City',
            ],
            'placeholder' => [
              '#title' => 'Choose a City',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'City',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Security Answer 1',
              '#default_value' => 'city',
            ],
            'choices' => [
              '#title' => 'City Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>province|City</small>',
            ],
          ],
        ],

        'address' => [
          'name' => 'Address',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'Address Label',
              '#type' => 'textfield',
              '#description' => 'The label for the Address field',
              '#default_value' => 'House Number',
            ],
            'placeholder' => [
              '#title' => 'Address placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for Address field placeholder',
              '#default_value' => 'House Number',
            ],
            'annotation' => [
              '#title' => 'Address Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'home_outlet_select' => [
          'name' => 'Home Outlet Select',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Home Outlet Select',
              '#type' => 'textfield',
              '#description' => 'Home Outlet field',
              '#default_value' => 'Home Outlet',
            ],
            'placeholder' => [
              '#title' => 'Choose a Home Outlet',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Home Outlet',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Home Outlet',
              '#default_value' => 'home-outlet',
            ],
            'choices' => [
              '#title' => 'Home Outlet Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>key|My Value</small>',
            ],
          ],
        ],

        'security_questions' => [
          'name' => 'Security Questions',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Security Questions',
              '#type' => 'textarea',
              '#description' => 'Security Questions',
              '#default_value' => '<p class="msw-registration-online-security-questions">Security Questions</p>',
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

        'rfidpin' => [
          'name' => 'RFID Pin',
          'type' => 'password',
          'settings' => [
            'label' => [
              '#title' => 'RFID Pin label',
              '#type' => 'textfield',
              '#description' => 'label for RFID Pin field',
              '#default_value' => 'RFID Pin',
            ],
            'placeholder' => [
              '#title' => 'RFID Pin placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for RFID Pin field placeholder',
              '#default_value' => 'RFID Pin',
            ],
            'annotation' => [
              '#title' => 'RFID Pin Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'photos_ID' => [
          'name' => 'Photos and ID',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Photos and ID',
              '#type' => 'textarea',
              '#description' => 'Photos and ID',
              '#default_value' => '<p class="msw-registration-online-photos_id">Photos and ID</p>',
            ],
          ],
        ],

        'id1' => [
          'name' => 'Select ID 1',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Select ID 1 Label',
              '#type' => 'textfield',
              '#description' => 'The Label for the Currency field',
              '#default_value' => 'Select ID 1',
            ],
            'placeholder' => [
              '#title' => 'Select ID 1',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Select ID 1',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Security Answer 1',
              '#default_value' => 'Select ID 1',
            ],
            'choices' => [
              '#title' => 'Select ID 1 Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>key|value</small>',
              '#default_value' => $id1,
            ],
          ],
        ],

        'id_number1' => [
          'name' => 'ID Number',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'ID Number Label',
              '#type' => 'textfield',
              '#description' => 'The label for the ID Number field',
              '#default_value' => 'ID Number',
            ],
            'placeholder' => [
              '#title' => 'ID Number placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for ID Number field placeholder',
              '#default_value' => 'ID Number',
            ],
            'annotation' => [
              '#title' => 'ID Number Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'upload_id_1' => [
          'name' => 'UPLOAD ID',
          'type' => 'file',
          'settings' => [
            'label' => [
              '#title' => 'Upload ID',
              '#type' => 'textfield',
              '#description' => 'Upload ID',
              '#default_value' => 'Upload ID',
            ],
            'accept-format' => [
              '#title' => 'Accepted Format',
              '#type' => 'textfield',
              '#description' => 'Format files to accept',
              '#default_value' => '.pdf,.doc,.jpg,.docx,.png,jpeg,.tif,.gif,.tiff,.xps',
            ],
            'accept-size' => [
              '#title' => 'Accepted file size',
              '#type' => 'textfield',
              '#description' => 'File size to accept in kb, 10mb = 10240kb',
              '#default_value' => '10240',
            ],
          ],
        ],

        'btn_upload_id_1' => [
          'name' => 'Button UPLOAD ID',
          'type' => 'button',
          'settings' => [
            'label' => [
              '#title' => 'UPLOAD ID label',
              '#type' => 'textfield',
              '#description' => 'Label for the UPLOAD ID button',
              '#default_value' => 'UPLOAD ID',
            ],
          ],
        ],

        'id2' => [
          'name' => 'Select ID 2',
          'type' => 'select',
          'settings' => [
            'label' => [
              '#title' => 'Select ID 2 Label',
              '#type' => 'textfield',
              '#description' => 'The Label for the Currency field',
              '#default_value' => 'Select ID 2',
            ],
            'placeholder' => [
              '#title' => 'Select ID 2',
              '#type' => 'textfield',
              '#description' => 'Placeholder value for this textfield',
              '#default_value' => 'Select ID 2',
            ],
            'groups' => [
              '#title' => 'Group Name',
              '#type' => 'textfield',
              '#description' => 'Group name for Security Answer 1',
              '#default_value' => 'Select ID 2',
            ],
            'choices' => [
              '#title' => 'Select ID 2 Choices',
              '#type' => 'textarea',
              '#description' => 'Provide a pipe separated key value pair. <br> <small>key|value</small>',
              '#default_value' => $id2,
            ],
          ],
        ],

        'id_number2' => [
          'name' => 'ID Number 2',
          'type' => 'textfield',
          'settings' => [
            'label' => [
              '#title' => 'ID Number 2 Label',
              '#type' => 'textfield',
              '#description' => 'The label for the ID Number 2 field',
              '#default_value' => 'ID Number 2',
            ],
            'placeholder' => [
              '#title' => 'ID Number 2 placeholder label',
              '#type' => 'textfield',
              '#description' => 'label for ID Number 2 field placeholder',
              '#default_value' => 'ID Number 2',
            ],
            'annotation' => [
              '#title' => 'ID Number 2 Annotation text',
              '#type' => 'textarea',
              '#description' => 'field annotation that will be displayed on focus',
            ],
          ],
        ],

        'upload_id_2' => [
          'name' => 'UPLOAD ID 2',
          'type' => 'file',
          'settings' => [
            'label' => [
              '#title' => 'Upload ID',
              '#type' => 'textfield',
              '#description' => 'Upload ID',
              '#default_value' => 'Upload ID',
            ],
            'accept-format' => [
              '#title' => 'Accepted Format',
              '#type' => 'textfield',
              '#description' => 'Format files to accept',
              '#default_value' => '.pdf,.doc,.jpg,.docx,.png,jpeg,.tif,.gif,.tiff,.xps',
            ],
            'accept-size' => [
              '#title' => 'Accepted file size',
              '#type' => 'textfield',
              '#description' => 'File size to accept in kb, 10mb = 10240kb',
              '#default_value' => '10240',
            ],
          ],
        ],

        'btn_upload_id_2' => [
          'name' => 'Button UPLOAD ID 2',
          'type' => 'button',
          'settings' => [
            'label' => [
              '#title' => 'UPLOAD ID 2 label',
              '#type' => 'textfield',
              '#description' => 'Label for the UPLOAD ID 2 button',
              '#default_value' => 'UPLOAD ID 2',
            ],
          ],
        ],

        'legal_agreements' => [
          'name' => 'Legal Agreements',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Legal Agreements',
              '#type' => 'textarea',
              '#description' => 'Legal Agreements',
              '#default_value' => 'Legal Agreements',
            ],
          ],
        ],

        'terms_and_conditions' => [
          'name' => 'Terms and Conditions',
          'title' => 'Terms and Conditions Title',
          'type' => 'checkbox',
          'settings' => [
            'label' => [
              '#title' => 'Terms and Conditions Markup',
              '#type' => 'textarea',
              '#description' => 'Terms and Conditions',
              '#default_value' => 'I am at least 21 years old and have read and accepted the Terms and Conditions.',
            ],
          ],
        ],

        'terms_and_conditions_markup' => [
          'name' => 'Terms and Conditions Markup',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Terms and Conditions Markup',
              '#type' => 'textarea',
              '#description' => 'Terms and Conditions',
              '#default_value' => 'I am at least 21 years old and have read and accepted the Terms and Conditions.',
            ],
          ],
        ],

        'citizenship' => [
          'name' => 'Citizenship',
          'title' => 'Citizenship Title',
          'type' => 'checkbox',
          'settings' => [
            'label' => [
              '#title' => 'Citizenship Markup',
              '#type' => 'textarea',
              '#description' => 'Citizenship',
              '#default_value' => 'I confirm I am NOT a Philippine Government Employee.',
            ],
          ],
        ],

        'citizenship_markup' => [
          'name' => 'Citizenship Markup',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Citizenship Markup',
              '#type' => 'textarea',
              '#description' => 'Citizenship',
              '#default_value' => 'I confirm I am NOT a Philippine Government Employee.',
            ],
          ],
        ],

        'awareness' => [
          'name' => 'Awareness',
          'title' => 'Awareness Title',
          'type' => 'checkbox',
          'settings' => [
            'label' => [
              '#title' => 'Awareness Markup',
              '#type' => 'textarea',
              '#description' => 'Awareness',
              '#default_value' => 'I am aware that this site uses cookies. By continuing to use this site, I agree to the use of cookies and its Privacy Policy.',
            ],
          ],
        ],
        
        'awareness_markup' => [
          'name' => 'Awareness Markup',
          'type' => 'markup',
          'settings' => [
            'markup' => [
              '#title' => 'Awareness Markup',
              '#type' => 'textarea',
              '#description' => 'Awareness',
              '#default_value' => 'I am aware that this site uses cookies. By continuing to use this site, I agree to the use of cookies and its Privacy Policy.',
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
