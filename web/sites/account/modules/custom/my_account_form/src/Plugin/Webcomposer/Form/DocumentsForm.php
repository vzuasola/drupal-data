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
          '#description' => 'Tab Title',
          '#default_value' => 'Verification',
          '#translatable' => true,
        ],
      ],
    ];

    $descriptionBlurbDefault = <<<END
Please submit your document/s with the corresponding purpose and ensure the following:
<ul>
<li>Upload a clear and whole front copy of your document/s</li>
<li>Registered information in the account such as Full Name and Date of Birth, must fully match the details on your document/s</li>
</ul>
END;

    $fields['description_blurb_markup'] = [
      'name' => 'Description Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Description',
          '#type' => 'textarea',
          '#description' => 'Instructions area',
          '#default_value' => $descriptionBlurbDefault,
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
          '#description' => 'A small message above the file upload section',
          '#default_value' => 'Note: Maximum of 6MB per document (JPG, JPEG, PNG, BMP, TIFF, GIF, PDF)',
          '#translatable' => true,
        ],
      ],
    ];

    $fields['first_upload'] = [
      'name' => 'Upload File 1',
      'type' => 'file',
      'translatable' => true,
      'settings' => [
        'data-allowed_file_extensions' => [
          '#title' => 'Available extensions for image',
          '#type' => 'textarea',
          '#description' => 'Here you should specify available extensions for image that user is uploading',
          '#default_value' => 'jpg,jpeg,png,bmp,tiff,gif,pdf',
          '#required' => true,
        ],
        'data-error_extension' => [
          '#title' => 'Add error message for file extension',
          '#type' => 'textfield',
          '#description' => 'Error message if the user selects a file type not explicitly allowed',
          '#default_value' => 'Invalid File Type. Allowed files: ',
          '#required' => true,
          '#translatable' => true,
        ],
        'data-placeholder' => [
          '#title' => 'Placeholder text',
          '#type' => 'textfield',
          '#description' => 'Placeholder for file upload label',
          '#required' => true,
          '#default_value' => 'Upload File',
          '#translatable' => true,
        ],
        'data-maximum-image-size' => [
          '#title' => 'Maximum File Size',
          '#type' => 'textfield',
          '#description' => 'Maximum uploaded image size in Megabytes',
          '#required' => true,
          '#default_value' => '6MB',
        ],
        'data-error_size' => [
          '#title' => 'Add error message for file size',
          '#type' => 'textfield',
          '#description' => 'Error shown if the file chosen is larger than the maximum.',
          '#default_value' => 'Invalid FIle Size. Max: ',
          '#required' => true,
          '#translatable' => true,
        ],
        'data-error_required' => [
          '#title' => 'Add error message for file not selected',
          '#type' => 'textfield',
          '#description' => 'This error will be shown if the user does not upload a file here',
          '#default_value' => 'Please select a file',
          '#required' => true,
          '#translatable' => true,
        ],
      ],
    ];
    $fields['second_upload'] = [
      'name' => 'Upload File 2',
      'type' => 'file',
      'translatable' => true,
      'settings' => [
        'data-allowed_file_extensions' => [
          '#title' => 'Available extensions for image',
          '#type' => 'textarea',
          '#description' => 'Here you should specify available extensions for image that user is uploading',
          '#default_value' => 'jpg,jpeg,png,bmp,tiff,gif,pdf',
          '#required' => true,
        ],
        'data-error_extension' => [
          '#title' => 'Add error message for file extension',
          '#type' => 'textfield',
          '#description' => 'Error message if the user selects a file type not explicitly allowed',
          '#default_value' => 'Invalid File Type. Allowed files: ',
          '#required' => true,
          '#translatable' => true,
        ],
        'data-placeholder' => [
          '#title' => 'Placeholder text',
          '#type' => 'textfield',
          '#description' => 'Placeholder for file upload label',
          '#required' => true,
          '#default_value' => 'Upload File',
          '#translatable' => true,
        ],
        'data-maximum-image-size' => [
          '#title' => 'Maximum File Size',
          '#type' => 'textfield',
          '#description' => 'Maximum uploaded image size in Megabytes',
          '#required' => true,
          '#default_value' => '6MB',
        ],
        'data-error_size' => [
          '#title' => 'Add error message for file size',
          '#type' => 'textfield',
          '#description' => 'Error shown if the file chosen is larger than the maximum.',
          '#default_value' => 'Invalid FIle Size. Max: ',
          '#required' => true,
          '#translatable' => true,
        ],
      ],
    ];
    $fields['third_upload'] = [
      'name' => 'Upload File 3',
      'type' => 'file',
      'translatable' => true,
      'settings' => [
        'data-allowed_file_extensions' => [
          '#title' => 'Available extensions for image',
          '#type' => 'textarea',
          '#description' => 'Here you should specify available extensions for image that user is uploading',
          '#default_value' => 'jpg,jpeg,png,bmp,tiff,gif,pdf',
          '#required' => true,
        ],
        'data-error_extension' => [
          '#title' => 'Add error message for file extension',
          '#type' => 'textfield',
          '#description' => 'Error message if the user selects a file type not explicitly allowed',
          '#default_value' => 'Invalid File Type. Allowed files: ',
          '#required' => true,
          '#translatable' => true,
        ],
        'data-placeholder' => [
          '#title' => 'Placeholder text',
          '#type' => 'textfield',
          '#description' => 'Placeholder for file upload label',
          '#required' => true,
          '#default_value' => 'Upload File',
          '#translatable' => true,
        ],
        'data-maximum-image-size' => [
          '#title' => 'Maximum File Size',
          '#type' => 'textfield',
          '#description' => 'Maximum uploaded image size in Megabytes',
          '#required' => true,
          '#default_value' => '6MB',
        ],
        'data-error_size' => [
          '#title' => 'Add error message for file size',
          '#type' => 'textfield',
          '#description' => 'Error shown if the file chosen is larger than the maximum.',
          '#default_value' => 'Invalid FIle Size. Max: ',
          '#required' => true,
          '#translatable' => true,
        ],
      ],
    ];
    
    $fields['purpose_markup'] = [
      'name' => 'Purpose Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Purpose Section Title',
          '#type' => 'textarea',
          '#description' => 'Title of the purpose section',
          '#default_value' => 'Purpose',
          '#translatable' => true,
        ],
      ],
    ];

    $fields['purpose'] = [
      'name' => 'Purpose',
      'type' => 'custom_select',
      'settings' => [
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
          '#translatable' => true,
        ],
        'placeholder' => [
          '#title' => 'Placeholder',
          '#type' => 'textfield',
          '#description' => 'Placeholder for the document type selection dropdown',
          '#default_value' => '- Select One -',
          '#translatable' => true,
        ],
        'data-required_error' => [
          '#title' => 'Error if no selection',
          '#type' => 'textfield',
          '#description' => 'Error to be shown if the user didn\'t select a valid option',
          '#default_value' => 'Please select an option',
          '#translatable' => true,
        ],
      ],
    ];
    $fields['comment_markup'] = [
      'name' => 'Comment Title',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Comment Title',
          '#type' => 'textarea',
          '#description' => 'Title for the comment section',
          '#default_value' => 'Comment',
          '#translatable' => true,
        ],
      ],
    ];

    $fields['comment'] = [
      'name' => 'Comment',
      'type' => 'textarea',
      'settings' => [
        'data-blurb' => [
          '#title' => 'Blurb',
          '#type' => 'textfield',
          '#description' => 'Blurb next to title',
          '#default_value' => 'English Characters Only',
          '#translatable' => true,
        ],
        'data-placeholder' => [
          '#title' => 'Comment placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for Comment field placeholder',
          '#default_value' => 'Type the information to be changed here and the reason for the request',
          '#translatable' => true,
        ],
        'data-required_error' => [
          '#title' => 'Error if field required',
          '#type' => 'textfield',
          '#description' => 'Error to be shown if user selected "Change Information" and didn\'t enter a comment',
          '#default_value' => 'Please enter a comment describing the change',
          '#translatable' => true,
        ],
        'data-character_count_limit' => [
          '#title' => 'Character count limit',
          '#type' => 'textfield',
          '#description' => 'Number of characters allowed',
          '#default_value' => '250',
          '#translatable' => true,
        ],
        'data-character_count_text' => [
          '#title' => 'Character count text',
          '#type' => 'textfield',
          '#description' => 'Message shown under the comment field showing number of characters left',
          '#default_value' => 'Characters left:',
          '#translatable' => true,
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
          '#translatable' => true,
        ],
      ],
    ];
    $footerBlurbDefault = <<<END
If you were not able to upload documents, please send it to <a href="#">dafabet.com</a> by mentioning your username and purpose in the subject line.
END;
    
    $fields['footer_instructions_markup'] = [
      'name' => 'Footer Instructions Markup',
      'type' => 'markup',
      'settings' => [
        'show_footer_markup' => [
          '#title' => 'Show footer instructions markup',
          '#type' => 'checkbox',
          '#default_value' => true,
          '#translatable' => true,
        ],
        'markup' => [
          '#title' => 'Footer Instructions',
          '#type' => 'textarea',
          '#description' => 'Footer Area Instructions',
          '#default_value' => $footerBlurbDefault,
          '#translatable' => true,
        ],
      ],
    ];
        

    return $fields;
  }

}
