<?php

namespace Drupal\mobile_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ForgotPasswordForm
 *
 * @WebcomposerForm(
 *   id = "forgot_password_form",
 *   name = "Forgot Password Form",
 * )
 */
class ForgotPasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {
  /**
   *
   */
  public function getSettings() {
    return [
      'footer' => [
        '#title' => 'Footer',
        '#type' => 'textarea',
        '#description' => 'Footer text for this form',
      ],
    ];
  }

  /**
   *
   */
  public function getFields() {
    return [
      
      'header_markup' => [
        'name' => 'Header Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Header Blurb',
            '#type' => 'text_format',
            '#default_value' => '<p class="blurb-summary">Please fill in the following details. 
An email will be sent to your registered email address.</p>',
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
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Email label',
            '#type' => 'textfield',
            '#description' => 'The Label for Email field',
            '#default_value' => 'Email',
          ],
          'placeholder' => [
            '#title' => 'Email placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Email field placeholder',
            '#default_value' => 'Email Address',
          ],
          'annotation' => [
            '#title' => 'Email Annotation text',
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
            '#default_value' => 'Submit',
          ],
        ],
      ],
      
      'footer_markup' => [
        'name' => 'Footer Markup',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Footer Blurb',
            '#type' => 'text_format',
            '#default_value' => '<img alt="invalid-black.svg" data-entity-type="" data-entity-uuid="" 
height="78" src="/images/svg/invalid-black.svg" width="78" /><p>For any question or concerns please contact 
<a href="#">Customer Support</a>.</p>',
          ],
        ],
      ],
    ];
  }
}
