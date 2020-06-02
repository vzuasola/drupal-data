<?php

namespace Drupal\mobile_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ResetPasswordForm
 *
 * @WebcomposerForm(
 *   id = "reset_password",
 *   name = "Reset Password Form",
 * )
 */
class ResetPasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {
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
            '#default_value' => '',
          ],
        ],
      ],

      'new_password' => [
        'name' => 'New Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'New Password Label',
            '#type' => 'textfield',
            '#description' => 'New password field label',
          ],
          'placeholder' => [
            '#title' => 'New password placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for new password field placeholder',
            '#default_value' => 'New Password',
          ],
          'annotation' => [
            '#title' => 'Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
          'annotation_weak' => [
            '#title' => 'Weak Annotation text',
            '#type' => 'textarea',
            '#description' => 'Message that will be displayed on lost focus',
          ],
          'annotation_average' => [
            '#title' => 'Average Annotation text',
            '#type' => 'textarea',
            '#description' => 'Message that will be displayed on lost focus',
          ]
        ]
      ],

      'password_meter' => [
        'name' => 'Password Meter',
        'type' => 'markup',
        'settings' => [
          'markup' => [
            '#title' => 'Password meter markup',
            '#type' => 'textarea',
            '#description' => 'HTML markup for password meter.',
            '#default_value' => '',
          ],
        ]
      ],

      'confirm_new_password' => [
        'name' => 'Confirm New Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Confirm New Password Label',
            '#type' => 'textfield',
            '#description' => 'Confirm New password field label',
          ],
          'placeholder' => [
            '#title' => 'Confirm New password placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for confirm new password field placeholder',
            '#default_value' => 'Confirm New Password',
          ],
          'annotation' => [
            '#title' => 'Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
          'enable' => [
            '#title' => 'Enable Field',
            '#type' => 'checkbox',
            '#description' => 'Check to enable field',
            '#default_value' => TRUE,
          ],
        ]
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
            '#default_value' => '',
          ],
        ],
      ],

    ];
  }
}
