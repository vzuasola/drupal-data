<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "unsupported_page",
 *   route = {
 *     "title" = "Unsupported Page",
 *     "path" = "/admin/config/owsports/unsupported-page",
 *   },
 *   menu = {
 *     "title" = "Unsupported Page",
 *     "description" = "Provides Unsupported Page and Currency Page configuration",
 *     "parent" = "owsports_config.list",
 *     "weight" = 31
 *   },
 * )
 */

class UnsupportedPageForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['owsports_config.unsupported_page'];
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form['unsupported_settings_tab'] = [
          '#title' => t('Unsupported Page Settings'),
          '#type' => 'vertical_tabs',
        ];

        $this->sectionUnsupportedCountry($form);
        $this->sectionUnsupportedCurrency($form);
        return $form;
    }

  /**
   *
   */
    private function sectionUnsupportedCountry(array &$form)
    {
        $form['country'] = [
          '#type' => 'details',
          '#title' => t('Country Page Content'),
          '#group' => 'unsupported_settings_tab',
        ];

        $form['country']['blocking_country_not_found_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $this->get('blocking_country_not_found_title'),
          '#required' => false,
          '#translatable' => true,
        ];

        $form['country']['blocking_country_not_found_image'] = [
          '#type' => 'managed_file',
          '#title' => $this->t('Image'),
          '#default_value' => $this->get('blocking_country_not_found_image'),
          '#upload_location' => 'public://',
          '#required' => false,
          '#translatable' => true,
          '#upload_validators' => [
            'file_validate_extensions' => ['gif png jpg jpeg'],
          ],
        ];

        $form['country']['blocking_country_not_found_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Content'),
          '#description' => $this->t('Content'),
          '#default_value' => $this->get('blocking_country_not_found_content')['value'],
          '#required' => false,
          '#translatable' => true,
        ];

        $form['country_list'] = [
          '#type' => 'details',
          '#title' => t('Unsupported Country List'),
          '#group' => 'unsupported_settings_tab',
        ];

        $form['country_list']['country'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Country List'),
          '#description' => $this->t('Define the unsupported countries for OW Sports, one per line.'),
          '#default_value' => $this->get('country'),
          '#required' => false,
          '#translatable' => true,
        ];
    }


    /**
     *
     */
    private function sectionUnsupportedCurrency(array &$form)
    {
        $form['currency'] = [
          '#type' => 'details',
          '#title' => t('Currency Page Content'),
          '#group' => 'unsupported_settings_tab',
        ];

        $form['currency']['blocking_currency_not_found_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $this->get('blocking_currency_not_found_title'),
          '#required' => false,
          '#translatable' => true,
        ];

        $form['currency']['blocking_currency_not_found_image'] = [
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

        $form['currency']['blocking_currency_not_found_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Content'),
          '#description' => $this->t('Content'),
          '#default_value' => $this->get('blocking_currency_not_found_content')['value'],
          '#required' => false,
          '#translatable' => true,
        ];

        $form['currency_list'] = [
          '#type' => 'details',
          '#title' => t('Unsupported Currencies'),
          '#group' => 'unsupported_settings_tab',
        ];

        $form['currency_list']['currency'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Currency List'),
          '#description' => $this->t('Define the unsupported currencies for OW Sports, one per line.'),
          '#default_value' => $this->get('currency'),
          '#required' => false,
          '#translatable' => true,
        ];
    }
}
