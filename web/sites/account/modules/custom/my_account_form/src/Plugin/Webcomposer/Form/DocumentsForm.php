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

    $fields['title_markup'] = [
      'name' => 'Title Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Document Upload Title',
          '#type' => 'textarea',
          '#description' => 'A Markup text the title area',
          '#default_value' => 'Verification',
          '#translatable' => true,
        ],
      ],
    ];

    $fields['description_blurb_markup'] = [
      'name' => 'Description Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Description',
          '#type' => 'textarea',
          '#description' => 'A Markup text for the blurb area',
          '#default_value' => 'Please submit your document/s with the correspodning purpose and ensure the following:',
          '#translatable' => true,
        ],
      ],
    ];
    
    $fields['upload_reminder_markup'] = [
      'name' => 'File Upload Reminder tetxt',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Description',
          '#type' => 'textarea',
          '#description' => 'A Markup text the upload reminder area',
          '#default_value' => 'Note: Maximum of 10MB per document (PNG, JPEG, PDF)',
          '#translatable' => true,
        ],
      ],
    ];

    $fields['first_upload'] = [
      'name' => 'Upload File 1',
      'type' => 'file',
      'translatable' => true,
      'settings' => [
        'allowed_file_extensions' => [
          '#title' => 'Available extensions for image',
          '#type' => 'textarea',
          '#description' => 'Here you should specify available extensions for image that user is uploading',
          '#default_value' => 'png,jpeg,pdf',
          '#required' => true,
        ],
        'error_extension' => [
          '#title' => 'Add error message for file extension',
          '#type' => 'textfield',
          '#description' => 'Here we can specify error message that will appear in FE.',
          '#default_value' => 'File type not allowed',
          '#required' => true,
        ],
        'upload_btn_text' => [
          '#title' => 'Upload Button Text',
          '#type' => 'markup',
          '#description' => 'field for upload button text',
        ],
        'placeholder' => [
          '#title' => 'Placeholder text',
          '#type' => 'textfield',
          '#description' => 'Placeholder for file upload',
          '#default_value' => 'Upload File',
        ],
      ],
    ];
    $fields['second_upload'] = [
      'name' => 'Upload File 2',
      'type' => 'file',
      'translatable' => true,
      'settings' => [
        'allowed_file_extensions' => [
          '#title' => 'Available extensions for image',
          '#type' => 'textarea',
          '#description' => 'Here you should specify available extensions for image that user is uploading',
          '#default_value' => 'png,jpeg,pdf',
          '#required' => true,
        ],
        'error_extension' => [
          '#title' => 'Add error message for file extension',
          '#type' => 'textfield',
          '#description' => 'Here we can specify error message that will appear in FE.',
          '#default_value' => 'File type not allowed',
          '#required' => true,
        ],
        'upload_btn_text' => [
          '#title' => 'Upload Button Text',
          '#type' => 'markup',
          '#description' => 'field for upload button text',
        ],
        'placeholder' => [
          '#title' => 'Placeholder text',
          '#type' => 'textfield',
          '#description' => 'Placeholder for file upload',
          '#default_value' => 'Upload File',
        ],
      ],
    ];
    $fields['third_upload'] = [
      'name' => 'Upload File 3',
      'type' => 'file',
      'translatable' => true,
      'settings' => [
        'allowed_file_extensions' => [
          '#title' => 'Available extensions for image',
          '#type' => 'textarea',
          '#description' => 'Here you should specify available extensions for image that user is uploading',
          '#default_value' => 'png,jpeg,pdf',
          '#required' => true,
        ],
        'error_extension' => [
          '#title' => 'Add error message for file extension',
          '#type' => 'textfield',
          '#description' => 'Here we can specify error message that will appear in FE.',
          '#default_value' => 'File type not allowed',
          '#required' => true,
        ],
        'upload_btn_text' => [
          '#title' => 'Upload Button Text',
          '#type' => 'markup',
          '#description' => 'field for upload button text',
        ],
        'placeholder' => [
          '#title' => 'Placeholder text',
          '#type' => 'textfield',
          '#description' => 'Placeholder for file upload',
          '#default_value' => 'Upload File',
        ],
      ],
    ];

    $fields['purpose'] = [
      'name' => 'Purpose',
      'type' => 'select',
      'settings' => [
        'label' => [
          '#title' => 'Purpose Label',
          '#type' => 'textfield',
          '#description' => 'The label for the purpose field',
          '#default_value' => 'Purpose',
        ],
        'placeholder' => [
          '#title' => 'Choose a purpose',
          '#type' => 'textfield',
          '#description' => 'Placeholder value for this textfield',
          '#default_value' => '-Select One-',
        ],
        'choices' => [
          '#title' => 'Purpose Choices',
          '#type' => 'textarea',
          '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
          '#default_value' => implode(PHP_EOL, [
            '0|-Select One-',
            '1|Account Verification',
            '2|Bonus Requirement',
            '3|Change Information',
            '4|Deposit Requirement',
            '5|Withdrawal Requirement',
            '6|Others',
          ]),
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
          '#default_value' => 'Purpose',
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
            'select'|'-Select One-',
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
    $fields['comment_markup'] = [
      'name' => 'Comment Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Comment Label Markup',
          '#type' => 'textarea',
          '#description' => 'A Markup text for the comment text field',
          '#default_value' => 'Comment',
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
        ],
        'placeholder' => [
          '#title' => 'Comment placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for Comment field placeholder',
          '#default_value' => 'Type the information to be changed here and the reason for the request',
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
          '#default_value' => 'Submit',
        ],
      ],
    ];

    return $fields;
  }

}
