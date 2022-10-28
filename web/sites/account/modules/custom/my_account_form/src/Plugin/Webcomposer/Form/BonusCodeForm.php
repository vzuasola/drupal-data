<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * Bonus Code Form.
 *
 * @WebcomposerForm(
 *   id = "bonus_code_form",
 *   name = "Bonus Code Form",
 * )
 */

class BonusCodeForm extends WebcomposerFormBase implements WebcomposerFormInterface
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
                '#title' => 'Bonus Code  Form Alias',
                '#type' => 'textfield',
                '#description' => 'Bonus Code Form Alias',
            ],
        ];
    }

    /**
     * Set Fields.
     */
    public function getFields()
    {
        $fields = [];

        $fields['BonusCode'] = [
            'name' => 'BonusCode',
            'type' => 'textfield',
            'settings' => [
                'label' => [
                    '#title' => 'Bonus Code Label',
                    '#type' => 'textfield',
                    '#description' => 'The Label for Bonus Code field',
                ],
            ],
        ];
        $fields['submit'] = [
            'name' => 'Submit',
            'type' => 'submit',
            'settings' => [
                'label' => [
                    '#title' => 'Submit Label',
                    '#type' => 'textfield',
                    '#description' => 'Label for the Submit button',
                    '#default_value' => 'Submit',
                ],
            ],
        ];

        return $fields;
    }
}
