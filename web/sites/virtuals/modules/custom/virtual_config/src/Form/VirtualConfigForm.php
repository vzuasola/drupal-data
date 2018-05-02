<?php

namespace Drupal\virtual_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Configuration Form for virtual Configuration.
 */
class VirtualConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['virtual_config.virtual_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'virtual_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('virtual_config.virtual_configuration');

    $form['virtual'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['virtual_configuration_mobile'] = [
      '#type' => 'details',
      '#title' => ' Mobile Site Url',
      '#group' => 'virtual',
    ];

    $form['virtual_configuration_mobile']['base_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Site Url'),
      '#default_value' => $config->get('base_url') ?? 'N/A',
      '#required' => true,
    ];

    $form['virtual_configuration_mobile']['product_name_seo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Name in Canonical'),
      '#default_value' => $config->get('product_name_seo') ?? 'N/A',
      '#required' => true,
    ];

    $form['basic_page'] = [
      '#type' => 'details',
      '#title' => t('Basic Page'),
      '#group' => 'virtual',
    ];

    $form['basic_page']['virtuals_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Virtuals Background'),
      '#default_value' => $config->get('virtuals_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
      '#description' => $this->t('Lobby tiles background')
    ];

    $form['basic_page']['basic_page_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Basic Page Background Image'),
      '#default_value' => $config->get('basic_page_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $pageListSortUrl = Url::fromUri('internal:/admin/structure/sort-page-list', []);
    $pageListSortLink = Link::fromTextAndUrl(t('this link'), $pageListSortUrl);

    $form['basic_page']['basic_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic Page Titles'),
      '#default_value' => $config->get('basic_page_title'),
      '#description' => $this->t('For sorting Basic Pages in a Page List go to '. $pageListSortLink->toString() . '.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'base_url',
      'product_name_seo',
      'virtuals_background',
      'basic_page_background',
      'basic_page_title'
    ];

    foreach ($keys as $key) {
        if ($key == 'virtuals_background') {
            $fid = $form_state->getValue('virtuals_background');
            if ($fid) {
                $file = File::load($fid[0]);
                $file->setPermanent();
                $file->save();

                $file_usage = \Drupal::service('file.usage');
                $file_usage->add($file, 'virtual_config', 'image', $fid[0]);

                $virtualConfig = $this->config('virtual_config.virtual_configuration');

                $virtualConfig->set("virtuals_background_image_url", file_create_url($file->getFileUri()))->save();
            } else {
                $this->config('virtual_config.virtual_configuration')->set("virtuals_background_image_url", null);
            }
        }

        if ($key == 'basic_page_background') {
            $fid = $form_state->getValue('basic_page_background');
            if ($fid) {
                $file = File::load($fid[0]);
                $file->setPermanent();
                $file->save();

                $file_usage = \Drupal::service('file.usage');
                $file_usage->add($file, 'virtual_config', 'image', $fid[0]);

                $virtualConfig = $this->config('virtual_config.virtual_configuration');

                $virtualConfig->set("basic_page_background_image_url", file_create_url($file->getFileUri()))->save();
            } else {
                $this->config('virtual_config.virtual_configuration')->set("basic_page_background_image_url", null);
            }
        }
        $this->config('virtual_config.virtual_configuration')
            ->set($key, $form_state->getValue($key))
            ->save();
    }
    parent::submitForm($form, $form_state);

  }

}
