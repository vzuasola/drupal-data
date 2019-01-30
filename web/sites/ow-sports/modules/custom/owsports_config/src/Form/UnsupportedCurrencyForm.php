<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "unsupported_currency_config",
 *   route = {
 *     "title" = "Unsupported Currency Configuration",
 *     "path" = "/admin/config/webcomposer/config/unsupported_currency_config",
 *   },
 *   menu = {
 *     "title" = "Unsupported Currency Configuration",
 *     "description" = "Configure Unsupported Currency Page",
 *     "parent" = "owsports_config.list",
 *     "weight" = 31
 *   },
 * )
 */

class UnsupportedCurrencyForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['owsports_config.unsupported_currency_configuration'];
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state)
    {

        $form['advanced'] = [
          '#type' => 'vertical_tabs',
        ];

        $form['unsupported_currency'] = [
          '#type' => 'details',
          '#title' => t('Page Content'),
          '#group' => 'advanced',
        ];

        $form['unsupported_currency']['blocking_currency_not_found_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $this->get('blocking_currency_not_found_title'),
          '#required' => false,
          '#translatable' => true,
        ];

        $form['unsupported_currency']['blocking_currency_not_found_image'] = [
          '#type' => 'managed_file',
          '#title' => $this->t('Image'),
          '#default_value' => $this->get('blocking_currency_not_found_image'),
          '#upload_location' => 'public://',
          '#required' => false,
          '#translatable' => true,
          '#upload_validators' => [
            'file_validate_extensions' => ['gif png jpg jpeg'],
          ],
        ];

        $form['unsupported_currency']['blocking_currency_not_found_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Content'),
          '#description' => $this->t('Content'),
          '#default_value' => $this->get('blocking_currency_not_found_content')['value'],
          '#required' => false,
          '#translatable' => true,
        ];
        
        $form['unsupported_currencies'] = [
          '#type' => 'details',
          '#title' => t('Unsupported Currencies'),
          '#group' => 'advanced',
        ];

        $form['unsupported_currencies']['currency'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Unsupported Currencies'),
          '#description' => $this->t('Define the unsupported currencies for OW Sports, one per line.'),
          '#default_value' => $this->get('currency'),
          '#required' => false,
          '#translatable' => true,
        ];
        return $form;
    }
}
