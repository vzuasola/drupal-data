<?php

namespace Drupal\registration_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * RegistrationForm
 *
 * @WebcomposerForm(
 *   id = "registration",
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
                'options' => [
                  'default_value' => 'Leandrew',
                ],
                'settings' => [
                    'alias' => [
                        '#title' => 'Username alias',
                        '#type' => 'textfield',
                        '#description' => 'Default name for Username field',
                    ],
                ],
            ],

            'password' => [
                'name' => 'Password',
                'type' => 'textfield',
                'settings' => [
                    'alias' => [
                        '#title' => 'Password alias',
                        '#type' => 'textfield',
                        '#description' => 'Default name for Password field',
                    ],
                ],
            ],

            'email' => [
                'name' => 'Email',
                'type' => 'textfield',
                'settings' => [
                    'alias' => [
                        '#title' => 'Email alias',
                        '#type' => 'textfield',
                        '#description' => 'Default Name for Email field',
                    ],
                ],
            ],

            'mobile_number' => [
                'name' => 'Mobile Number',
                'type' => 'textfield',
                'settings' => [
                    'name' => [
                        '#title' => 'Mobile Number',
                        '#type' => 'textfield',
                        '#description' => 'The default name for the Mobile Number field',
                    ],
                ],
            ],

            'first_name' => [
                'name' => 'First Name',
                'type' => 'textfield',
                'settings' => [
                    'name' => [
                        '#title' => 'First Name',
                        '#type' => 'textfield',
                        '#description' => 'The default name for the First Name field',
                    ],
                ],
            ],

            'last_name' => [
                'name' => 'Last Name',
                'type' => 'textfield',
                'settings' => [
                    'name' => [
                        '#title' => 'Last Name',
                        '#type' => 'textfield',
                        '#description' => 'The default name for the Last Name field',
                    ],
                ],
            ],

            'currency' => [
                'name' => 'Currency',
                'type' => 'select',
                'settings' => [
                    'name' => [
                        '#title' => 'Currency',
                        '#type' => 'textfield',
                        '#description' => 'The default name for the Currency field',
                    ],
                    'default_name' => [
                        '#title' => 'Default Name',
                        '#type' => 'textfield',
                        '#description' => 'The Empty value name for the Currency dropdown field',
                    ],
                ],
            ],

           'country' => [
                'name' => 'Country',
                'type' => 'select',
                'settings' => [
                    'name' => [
                        '#title' => 'Country',
                        '#type' => 'textfield',
                        '#description' => 'The default name for the Country field',
                    ],
                    'default_name' => [
                        '#title' => 'Default Name',
                        '#type' => 'textfield',
                        '#description' => 'The Empty value name for the Country dropdown field',
                    ],
                ],
            ],
        ];
    }
}
