<?php

namespace Drupal\contact_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ContactUsForm.
 *
 * @WebcomposerForm(
 *   id = "contact_form",
 *   name = "Contact Form",
 * )
 */
class ContactForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Contact Form',
        '#type' => 'textfield',
        '#description' => 'Contact Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {
    return [

      'first_name' => [
        'name' => 'First Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'First Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the First Name field',
            '#default_value' => 'First Name',
          ],
          'placeholder' => [
            '#title' => 'First name placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for First name field placeholder',
            '#default_value' => 'Enter First Name',
          ],
          'annotation' => [
            '#title' => 'First Name Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'last_name' => [
        'name' => 'Last Name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Last Name Label',
            '#type' => 'textfield',
            '#description' => 'The label for the Last Name field',
            '#default_value' => 'Last Name',
          ],
          'placeholder' => [
            '#title' => 'Last name placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Last name field placeholder',
            '#default_value' => 'Enter Last Name',
          ],
          'annotation' => [
            '#title' => 'Last Name Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
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
          ],
          'placeholder' => [
            '#title' => 'Username placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Username field placeholder',
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
            '#title' => 'Email Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Email field',
          ],
          'placeholder' => [
            '#title' => 'Email placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Email field placeholder',
          ],
          'annotation' => [
            '#title' => 'Email Annotation text',
            '#type' => 'textarea',
            '#description' => 'field annotation that will be displayed on focus',
          ],
        ],
      ],

      'product' => [
        'name' => 'Product',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Product Label',
            '#type' => 'textfield',
            '#description' => 'The dLabel for the Product field',
          ],
          'placeholder' => [
            '#title' => 'Product placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder value for this textfield',
            '#default_value' => '- Select -',
          ],
          'choices' => [
            '#title' => 'Product Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => '',
          ],
        ],
      ],

      'subject' => [
        'name' => 'Subject',
        'type' => 'select',
        'settings' => [
          'label' => [
            '#title' => 'Subject Label',
            '#type' => 'textfield',
            '#description' => 'The dLabel for the Product field',
          ],
          'placeholder' => [
            '#title' => 'Subject placeholder label',
            '#type' => 'textfield',
            '#description' => 'Placeholder value for this textfield',
            '#default_value' => '- Select -',
          ],
          'choices' => [
            '#title' => 'Subject Choices',
            '#type' => 'textarea',
            '#description' => 'Provide a pipe separated key value pair. <br> <small>Example key|My Value</small>',
            '#default_value' => '',
          ],
        ],
      ],

      'message' => [
        'name' => 'Message',
        'type' => 'textarea',
        'settings' => [
          'label' => [
            '#title' => 'Message Label',
            '#type' => 'textfield',
            '#description' => 'The Label for Message field',
            '#default_value' => 'Message',
          ],
          'placeholder' => [
            '#title' => 'Message placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for Message field placeholder',
            '#default_value' => 'Message',
          ],
          'annotation' => [
            '#title' => 'Message Annotation text',
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
    ];
  }

}
