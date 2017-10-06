<?php

namespace Drupal\webcomposer_sitemap\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for Sitemap Configuration.
 */
class SitemapConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.sitemap_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_sitemap_settings_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.sitemap_configuration');

    $form['enable_sitemap'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable /  Disable of Sitemap'),
      '#default_value' => $config->get('enable_sitemap'),
    ];

    $form['sitemap_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('sitemap_title'),
    ];

    $data = $config->get('sitemap_content');
    $form['sitemap_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Sitemap Blurb'),
      '#default_value' => $data['value'],
      '#format' => $data['format'],
    ];

    $form['sitemap_home_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Title'),
      '#default_value' => $config->get('sitemap_home_label'),
    ];

    $form['sitemap_home_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Link'),
      '#default_value' => $config->get('sitemap_home_link'),
    ];

    $form['sitemap_promotions_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Label'),
      '#default_value' => $config->get('sitemap_promotions_label'),
    ];

    $form['sitemap_promotions_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Link'),
      '#default_value' => $config->get('sitemap_promotions_link'),
    ];

    $form['sitemap_mobile_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Label'),
      '#default_value' => $config->get('sitemap_mobile_label'),
    ];

    $form['sitemap_mobile_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Link'),
      '#default_value' => $config->get('sitemap_mobile_link'),
    ];

    $form['sitemap_basic_pages_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic Page Label'),
      '#default_value' => $config->get('sitemap_basic_pages_label'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $sitemapConfig = [
      'enable_sitemap',
      'sitemap_title',
      'sitemap_content',
      'sitemap_home_label',
      'sitemap_home_link',
      'sitemap_promotions_label',
      'sitemap_promotions_link',
      'sitemap_mobile_label',
      'sitemap_mobile_link',
      'sitemap_basic_pages_label',
    ];
    foreach ($sitemapConfig as $keys) {
        $this->config('webcomposer_config.sitemap_configuration')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
