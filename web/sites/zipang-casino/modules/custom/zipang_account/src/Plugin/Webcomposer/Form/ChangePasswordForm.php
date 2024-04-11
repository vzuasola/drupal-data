<?php

namespace Drupal\zipang_account\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ChangePasswordForm
 *
 * @WebcomposerForm(
 *   id = "japan_change_password_form",
 *   name = "Change Password Form",
 * )
 */
class ChangePasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {
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
      'current_password' => [
        'name' => 'Current Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Current Password Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Current Password field',
            "#default_value" => "Current Password",
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
                  "#description" => "The label for the password field",
                  "#default_value" => "New Password",
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
                  "#description" => "The label for the password field",
                  "#default_value" => "Confirm Password",
              ],
          ],
      ],
      'save_changes' => [
        'name' => 'Save Changes',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Save Changes Label',
            '#type' => 'textfield',
            '#description' => 'Label for the Save Changes button',
            '#default_value' => 'Save Changes',
          ],
        ],
      ]
    ];
  }
}
