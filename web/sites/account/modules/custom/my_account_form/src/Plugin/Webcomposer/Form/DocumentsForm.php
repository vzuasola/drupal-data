<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * DocumentsForm.
 *
 * @WebcomposerForm(
 *   id = "documents_form",
 *   name = "Documents Form",
 * )
 */
class DocumentsForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Documents Form Alias',
        '#type' => 'textfield',
        '#description' => 'Documents Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {

    $fields = [];

    $fields['comment_markup'] = [
      'name' => 'Comment Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Comment Label Markup',
          '#type' => 'textarea',
          '#description' => 'A Markup text the comment text area',
          '#default_value' => 'Comment<hr>',
        ],
      ],
    ];

    $fields['comment'] = [
      'name' => 'Comment',
      'type' => 'textarea',
      'settings' => [
        'label' => [
          '#title' => 'Comment Label',
          '#type' => 'textfield',
          '#description' => 'The Label for Comment field',
          '#default_value' => 'Comment',
        ],
        'placeholder' => [
          '#title' => 'Comment placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for Comment field placeholder',
          '#default_value' => 'Comment',
        ],
      ],
    ];

    $fields['purpose_markup'] = [
      'name' => 'Purpose Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Purpose Label Markup',
          '#type' => 'textarea',
          '#description' => 'A Markup text the purpose select field',
          '#default_value' => 'Purpose<hr>',
        ],
      ],
    ];

    $fields['purpose'] = [
      'name' => 'Purpose',
      'type' => 'select',
      'settings' => [
        'label' => [
          '#title' => 'Purpose',
          '#type' => 'textfield',
          '#description' => 'The Label for the Purpose field',
        ],
        'choices' => [
          '#title' => '- Select One -',
          '#type' => 'textarea',
          '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
          '#default_value' => implode(PHP_EOL, [
            'verify|Account Verification',
            'bonus|Bonus Requirement',
            'change|Change Information',
            'deposit|Deposit Requirement',
            'withdraw|Withdrawal Requirement',
            'others|Others',
          ]),
        ],
      ],
    ];

    $fields['submit'] = [
      'name' => 'Save',
      'type' => 'submit',
      'settings' => [
        'label' => [
          '#title' => 'Save Label',
          '#type' => 'textfield',
          '#description' => 'Label for the Save button',
          '#default_value' => 'Save Changes',
        ],
      ],
    ];

    return $fields;
  }

}
