<?php

namespace Drupal\zipang_registration\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * SignupForm
 *
 * @WebcomposerForm(
 *   id = "japan_sign_up_form",
 *   name = "Sign up Form",
 * )
 */
class SignupForm extends WebcomposerFormBase implements WebcomposerFormInterface {
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
            '#title' => 'Username Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Username field',
          ],
          'placeholder' => [
            '#title' => 'Username placeholder',
            '#type' => 'textfield',
            '#description' => 'Username for password field',
            '#default_value' => 'Username placeholder',
          ],
          'annotation' => [
            '#title' => 'Annotation text',
            '#type' => 'textarea',
            '#description' => 'Field annotation that will be displayed on focus',
          ],
        ],
      ],
      "password" => [
          "name" => "Password",
          "type" => "password",
          "settings" => [
              "label" => [
                  "#title" => "Password Label",
                  "#type" => "textfield",
                  "#description" => "The label for the password field",
                  "#default_value" => "Current Password",
              ],
              'placeholder' => [
                '#title' => 'Password placeholder',
                '#type' => 'textfield',
                '#description' => 'Placeholder for password field',
                '#default_value' => 'Password placeholder',
              ],
              'annotation' => [
                '#title' => 'Annotation text',
                '#type' => 'textarea',
                '#description' => 'Field annotation that will be displayed on focus',
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
            '#description' => 'The label for the Email field',
          ],
          'placeholder' => [
            '#title' => 'Email placeholder',
            '#type' => 'textfield',
            '#description' => 'Email for password field',
            '#default_value' => 'Email placeholder',
          ],
          'annotation' => [
            '#title' => 'Annotation text',
            '#type' => 'textarea',
            '#description' => 'Field annotation that will be displayed on focus',
          ],
        ],
      ],
      'terms_condition_text' => [
        'name' => 'Terms Conditions',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Terms Condition Text',
            '#type' => 'textarea',
            '#description' => 'A Forgot Password Link on Sign in',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">I am atlease 18 years old and have read and accepted the Terms and Condition</div>',
          ],
        ],
      ],
      'signup' => [
        'name' => 'Signup',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Signup Label',
            '#type' => 'textfield',
            '#description' => 'Label for the Signup button',
            '#default_value' => 'Signup',
          ],
        ],
      ]
    ];
  }
}
