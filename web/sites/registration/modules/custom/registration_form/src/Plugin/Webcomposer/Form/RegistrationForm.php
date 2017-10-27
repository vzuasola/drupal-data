<?php

namespace Drupal\registration_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm
 *
 * @WebcomposerForm(
 *   id = "registration_form",
 *   name = "Registration Form",
 * )
 */
class RegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface {

  /**
   *
   */
    public function getSettings() {
        return [
                'show' => [
                '#title' => 'Show this form',
                '#type' => 'checkbox',
                '#default_value' => true
            ],
                'alias' => [
                '#title' => 'Registration Form',
                '#type' => 'textfield',
                '#description' => 'Registration Alias',
            ],
        ];
    }

    /**
    *
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
                ],
            ],

            'password' => [
                'name' => 'Password',
                'type' => 'textfield',
                'settings' => [
                    'label' => [
                        '#title' => 'Password label',
                        '#type' => 'textfield',
                        '#description' => 'The Label for Password field',
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
                        '#title' => 'Country Choices',
                        '#type' => 'textarea',
                        '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
                        '#default_value' => implode(PHP_EOL, [
                            'rmb|CNY (Chinese Yuan)',
                            'usd|US Dollars'
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
                            'ch|China',
                            'us|United States'
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
