<?php

namespace Drupal\ghana_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * GhanaChangePasswordForm.
 *
 * @WebcomposerForm(
 *   id = "ghana_change_password_form",
 *   name = "Ghana Change Password Form",
 * )
 */

 class GhanaChangePasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {

    /**
     * @{inheritdoc}
     */
    public function getSettings() {
        return [
            'show' => [
                '#title' => 'Show this form',
                '#type' => 'checkbox',
                '#default_value' => true
            ],
            'alias' => [
                '#title' => 'Change Password Form',
                '#type' => 'textfield',
                '#description' => 'Change Password Form Alias',
            ],
        ];
    }

    public function getFields()
    {
        return [
            "current_password" => [
                "name" => "Current User Password",
                "type" => "password",
                "settings" => [
                    "label" => [
                        "#title" => "Current Password Label",
                        "#type" => "textfield",
                        "#description" => "The label for the current password field",
                        "#default_value" => "Current Password",
                    ],
                    'placeholder' => [
                      '#title' => 'Current password placeholder',
                      '#type' => 'textfield',
                      '#description' => 'Label for current password field',
                      '#default_value' => 'Current password label',
                    ],
                ],
            ],

            "new_password" => [
                "name" => "New Password",
                "type" => "password",
                "settings" => [
                    "label" => [
                        "#title" => "New Password Label",
                        "#type" => "textfield",
                        "#description" => "The label for the current password field",
                        "#default_value" => "New Password",
                    ],
                    'placeholder' => [
                      '#title' => 'New password placeholder',
                      '#type' => 'textfield',
                      '#description' => 'Label for new password field',
                      '#default_value' => 'New password label',
                    ],
                ],
            ],

            "confirm_password" => [
                "name" => "Confirm Password",
                "type" => "password",
                "settings" => [
                    "label" => [
                        "#title" => "Confirm Password Label",
                        "#type" => "textfield",
                        "#description" => "The label for the current password field",
                        "#default_value" => "Confirm Password",
                    ],
                    'placeholder' => [
                      '#title' => 'Confirm password placeholder',
                      '#type' => 'textfield',
                      '#description' => 'Label for confirm password field',
                      '#default_value' => 'Confirm password label',
                    ],
                ],
            ],

            "submit" => [
                "name" => "Submit",
                "type" => "submit",
                "settings" => [
                    "label" => [
                        "#title" => "Submit Label",
                        "#type" => "textfield",
                        "#description" => "Label for the submit button",
                        "#default_value" => "Save Changes",
                    ]
                ]
            ]
        ];
    }
 }