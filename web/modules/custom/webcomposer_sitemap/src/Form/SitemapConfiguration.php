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
      '#title' => $this->t('Enable Sitemap'),
      '#default_value' => $config->get('enable_sitemap'),
      '#description' => 'When checked, sitemap page will be accessible',
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

    // form elements for the deprecated static links, to be removed
    $this->generateStaticLinks($form, $form_state);

    $form['dynamic_links'] = [
      '#type' => 'details',
      '#title' => 'Custom Links',
      '#open' => true,
    ];

    $form['dynamic_links']['sitemap_links'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Sitemap Links'),
      '#default_value' => $config->get('sitemap_links'),
      '#description' => "Provide a pipe separated key value pair of links. Slash can be ommited
        for relative paths
        <br><br>
        Example:
        <br>
        <strong>Home|/</strong>
        <br>
        <strong>Promotions|promotions</strong>
        <br>
        <strong>Promo|promotions/promo</strong>
      ",
    ];

    $this->generateContentTypeForm($form, $form_state);

    return parent::buildForm($form, $form_state);
  }

  /**
   *
   */
  private function generateStaticLinks(array &$form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.sitemap_configuration');

    $form['static_links'] = [
      '#type' => 'details',
      '#title' => 'Deprecated Links',
      '#description' => 'Links used for the old sitemap implementation. On newer products,
        this are not used anymore.',
    ];

    $form['static_links']['sitemap_home_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Title'),
      '#default_value' => $config->get('sitemap_home_label'),
    ];

    $form['static_links']['sitemap_home_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Link'),
      '#default_value' => $config->get('sitemap_home_link'),
    ];

    $form['static_links']['sitemap_promotions_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Label'),
      '#default_value' => $config->get('sitemap_promotions_label'),
    ];

    $form['static_links']['sitemap_promotions_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Link'),
      '#default_value' => $config->get('sitemap_promotions_link'),
    ];

    $form['static_links']['sitemap_mobile_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Label'),
      '#default_value' => $config->get('sitemap_mobile_label'),
    ];

    $form['static_links']['sitemap_mobile_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Link'),
      '#default_value' => $config->get('sitemap_mobile_link'),
    ];

    $form['static_links']['sitemap_basic_pages_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic Page Label'),
      '#default_value' => $config->get('sitemap_basic_pages_label'),
    ];
  }

  /**
   *
   */
  private function generateContentTypeForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.sitemap_configuration')->get('content_types');

    $form['content_types_wrapper'] = [
      '#type' => 'vertical_tabs',
      '#title' => 'Configure content types to show on site map',
      '#tree' => TRUE,
    ];

    $contentTypes = \Drupal::service('entity.manager')->getStorage('node_type')->loadMultiple();

    foreach ($contentTypes as $contentType) {
      $key = $contentType->id();
      $label = $contentType->label();

      $form["content_types_$key"] = [
        '#type' => 'details',
        '#title' => $contentType->label(),
        '#group' => 'content_types_wrapper',
        '#tree' => TRUE,
      ];

      $form["content_types_$key"]['enable'] = [
        '#type' => 'checkbox',
        '#title' => "Enable",
        '#description' => 'If enabled, the content type will show up on the sitemap page',
        '#parents' => ['content_types', $key, 'enable'],
        '#default_value' => isset($config[$key]['enable']) ? $config[$key]['enable'] : NULL,
      ];

      $form["content_types_$key"]['label'] = [
        '#type' => 'textfield',
        '#title' => "Label for $label",
        '#description' => 'The label of the parent tree for this content type',
        '#parents' => ['content_types', $key, 'label'],
        '#default_value' => isset($config[$key]['label']) ? $config[$key]['label'] : $label,
      ];
    }
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
      'sitemap_links',
    ];

    foreach ($sitemapConfig as $keys) {
        $this->config('webcomposer_config.sitemap_configuration')->set($keys, $form_state->getValue($keys))->save();
    }

    // save content type values
    $this->config('webcomposer_config.sitemap_configuration')->set('content_types', $form_state->getValue('content_types'))->save();

    parent::submitForm($form, $form_state);
  }
}
