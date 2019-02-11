<?php
namespace Drupal\webcomposer_sitemap\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Sitemap Configuration Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_sitemap_settings_form",
 *   route = {
 *     "title" = "Sitemap Configuration",
 *     "path" = "admin/config/webcomposer/sitemap",
 *   },
 *   menu = {
 *     "title" = "Sitemap Configuration",
 *     "description" = "Provides configuration for Sitemap Page.",
 *     "parent" = "webcomposer_sitemap.list",
 *     "weight" = 1
 *   },
 * )
 */
class SitemapConfiguration extends FormBase {
  /**
   * @inheritdoc
   */

  protected function getEditableConfigNames() {
    return ['webcomposer_config.sitemap_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['webcomposer_sitemap_settings_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['enable_sitemap'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Sitemap'),
      '#description' => $this->t('When checked, sitemap page will be accessible'),
      '#default_value' => $this->get('enable_sitemap'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['sitemap_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('sitemap_title'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

   $form['gen_config']['sitemap_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Sitemap Blurb'),
      '#default_value' => $this->get('sitemap_content')['value'],
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];
    // form elements for the deprecated static links, to be removed
    $this->generateStaticLinks($form);
    $this->generateDynamicLinks($form);
    $this->generateContentTypeForm($form);

  }
  /**
   *
   */
  private function generateStaticLinks(&$form) {
    
    $form['static_links'] = [
      '#type' => 'details',
      '#title' => 'Deprecated Links',
      '#description' => 'Links used for the old sitemap implementation. On newer products,
        this are not used anymore.',
    ];

    $form['static_links']['sitemap_home_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Title'),
      '#default_value' => $this->get('sitemap_home_label'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['static_links']['sitemap_home_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Link'),
      '#default_value' => $this->get('sitemap_home_link'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['static_links']['sitemap_promotions_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Label'),
      '#default_value' => $this->get('sitemap_promotions_label'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['static_links']['sitemap_promotions_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Link'),
      '#default_value' => $this->get('sitemap_promotions_link'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['static_links']['sitemap_mobile_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Label'),
      '#default_value' => $this->get('sitemap_mobile_label'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['static_links']['sitemap_mobile_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Link'),
      '#default_value' => $this->get('sitemap_mobile_link'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['static_links']['sitemap_basic_pages_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic Page Label'),
      '#default_value' => $this->get('sitemap_basic_pages_label'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];
  }
  /**
   *
   */
  private function generateDynamicLinks(&$form) {
    
    $form['dynamic_links'] = [
      '#type' => 'details',
      '#title' => 'Custom Links',
      '#open' => true,
    ];

    $form['dynamic_links']['sitemap_links'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Sitemap Links'),
      '#default_value' => $this->get('sitemap_links'),
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
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

  }
  /**
   *
   */
  private function generateContentTypeForm(&$form) {
    
    $form['content_types_wrapper'] = [
      '#type' => 'vertical_tabs',
      '#title' => 'Configure content types to show on site map',
      '#tree' => true,
    ];

    $content_types = \Drupal::service('entity.manager')->getStorage('node_type')->loadMultiple();
    foreach ($content_types as $content_type) {
      $key = $content_type->id();
      $label = $content_type->label();

      $form["content_types_$key"] = [
        '#type' => 'details',
        '#title' => $content_type->label(),
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
}
