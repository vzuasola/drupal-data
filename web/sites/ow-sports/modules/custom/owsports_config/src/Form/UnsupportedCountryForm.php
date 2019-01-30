<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "unsupported_country_config",
 *   route = {
 *     "title" = "Unsupported Country Configuration",
 *     "path" = "/admin/config/webcomposer/config/unsupported_country_config",
 *   },
 *   menu = {
 *     "title" = "Unsupported Country Configuration",
 *     "description" = "Configure Unsupported Country Page",
 *     "parent" = "owsports_config.list",
 *     "weight" = 31
 *   },
 * )
 */

class UnsupportedCountryForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['owsports_config.unsupported_country_configuration'];
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form['advanced'] = [
          '#type' => 'vertical_tabs',
        ];

        $form['unsupported_country'] = [
          '#type' => 'details',
          '#title' => t('Page Content'),
          '#group' => 'advanced',
        ];

        $form['unsupported_country']['blocking_country_not_found_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $this->get('blocking_country_not_found_title'),
          '#required' => false,
          '#translatable' => true,
        ];

        $form['unsupported_country']['blocking_country_not_found_image'] = [
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

        $form['unsupported_country']['blocking_country_not_found_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Content'),
          '#description' => $this->t('Content'),
          '#default_value' => $this->get('blocking_country_not_found_content')['value'],
          '#required' => false,
          '#translatable' => true,
        ];

        $form['unsupported_countries'] = [
          '#type' => 'details',
          '#title' => t('Unsupported Countries'),
          '#group' => 'advanced',
        ];

        $form['unsupported_countries']['country'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Unsupported Countries'),
          '#description' => $this->t('Define the unsupported countries for OW Sports, one per line.'),
          '#default_value' => $this->get('country'),
          '#required' => false,
          '#translatable' => true,
        ];

        return $form;
    }
}
