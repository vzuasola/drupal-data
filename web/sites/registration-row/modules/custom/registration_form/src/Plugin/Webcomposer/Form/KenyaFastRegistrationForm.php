<?php

namespace Drupal\registration_form\Plugin\Webcomposer\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * Kenya Fast Registration Form.
 *
 *
 * @WebcomposerForm(
 *   id = "fast_registration_form_ke",
 *   name = "Kenya Fast Registration Form",
 * )
 */
class KenyaFastRegistrationForm extends WebcomposerFormBase implements WebcomposerFormInterface
{

  /**
   * Get Settings.
   */
  public function getSettings()
  {
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
  public function getFields()
  {
    return [
      'back_button' => [
        'name' => 'Back Button',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Back Button Markup',
            '#type' => 'textarea',
            '#description' => 'HTML markup for Back Button.',
            '#default_value' => '<span class="back-btn btn-small btn"' .
              ' style="float:right; margin:0 22px 10px; display:none">Back</span>',
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

      'accept_terms' => [
        'name' => 'Accept Terms Markup',
        'type' => 'checkbox',
        'settings' => [
          'markup' => [
            '#title' => 'Accept Terms Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for accept terms and conditions beside the submit button',
            '#default_value' => 'I have read and accept the Terms and Condition',
          ],
        ],
      ],

      'legal_age' => [
        'name' => 'Legal Age Markup',
        'type' => 'checkbox',
        'settings' => [
          'markup' => [
            '#title' => 'Legal Age Text',
            '#type' => 'textarea',
            '#description' => 'A Markup text for accept terms and conditions beside the submit button',
            '#default_value' => 'I am at least 18 years old',
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
