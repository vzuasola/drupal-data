<?php

namespace Drupal\zipang_registration\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * SigninForm
 *
 * @WebcomposerForm(
 *   id = "japan_sign_in_form",
 *   name = "Sign in Form",
 * )
 */
class SigninForm extends WebcomposerFormBase implements WebcomposerFormInterface {
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
      'signin_header_text' => [
        'name' => 'Header Text',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Sign in Header Text',
            '#type' => 'textarea',
            '#description' => 'A header text markup for Sign in',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">You need to register to play the game(free)</div>',
          ],
        ],
      ],
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
                  "#default_value" => "Password",
              ],
              'placeholder' => [
                '#title' => 'Password placeholder',
                '#type' => 'textfield',
                '#description' => 'Placeholder for password field',
                '#default_value' => 'Password placeholder',
              ],
          ],
      ],
      'remember_username' => [
        'name' => 'Remember Username',
        'type' => 'checkbox',
        'settings' => [
          'label' => [
            '#title' => 'Remember Username Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for Remember Username',
            '#default_value' => 'Remember Username',
          ],
        ],
      ],
      'login' => [
        'name' => 'Login',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Login Label',
            '#type' => 'textfield',
            '#description' => 'Label for the login button',
            '#default_value' => 'Login',
          ],
        ],
      ],
      'forgot_password_text' => [
        'name' => 'Forgot Password',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Forgot Password link Text',
            '#type' => 'textarea',
            '#description' => 'A Forgot Password link for Sign in',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">Forgot Password</div>',
          ],
        ],
      ],
      'register_button_text' => [
        'name' => 'Register Header Text',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Register button Text',
            '#type' => 'textarea',
            '#description' => 'Register button Text on Sign in',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">For new customer</div>',
          ],
        ],
      ],
      'create_account_text' => [
        'name' => 'Create Account',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Create Account',
            '#type' => 'textarea',
            '#description' => 'Create Account button on Sign in',
            '#default_value' => '<div class="fieldset-wrapper text-center display-text">Create an Account</div>',
          ],
        ],
      ]
    ];
  }
}
