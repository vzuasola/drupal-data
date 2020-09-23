<?php

namespace Drupal\webcomposer_graphyte\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "graphyte_configuration",
 *   route = {
 *     "title" = "Graphyte Configuration",
 *     "path" = "/admin/config/webcomposer/config/graphyte",
 *   },
 *   menu = {
 *     "title" = "Graphyte Configuration",
 *     "description" = "Provides Webcomposer Graphyte configuration",
 *     "parent" = "webcomposer_graphyte.list",
 *     "weight" = 30
 *   },
 * )
 */
class GraphyteConfiguration extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_graphyte.integration_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['graphyte'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['setting_config'] = [
      '#group' => 'graphyte',
      '#type' => 'details',
      '#title' => 'Settings',
    ];

    $form['recommend_config'] = [
      '#group' => 'graphyte',
      '#type' => 'details',
      '#title' => 'Recommends API',
      '#access' => (boolean) $this->get('enable'),
    ];

    $this->getSettingsConfig($form['setting_config']);
    $this->getRecommentsConfig($form['recommend_config']);

    return $form;
  }

  private function getSettingsConfig(&$form) {
    $form['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Graphyte integration'),
      '#default_value' => $this->get('enable'),
      '#description' => $this->t('Enable/Disable graphyte integrations'),
    ];

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#default_value' => $this->get('api_key'),
      '#description' => $this->t('API key'),
      '#required' => true,
    ];

    $form['brand_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Brand Key'),
      '#default_value' => $this->get('brand_key'),
      '#description' => $this->t('Brand keys'),
      '#required' => true,
    ];
  }

  private function getRecommentsConfig(&$form) {
    $form['recommend_api_domain'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Recommends API host'),
      '#default_value' => $this->get('recommend_api_domain'),
      '#description' => $this->t('Recommends API host <br/>
          <b>Test:</b> https://test-api-apac.graphyte.ai/recommend/v1/placements/{placementKey}/recommendations</br>
          <b>Production:</b> https://api-apac.graphyte.ai/recommend/v1/placements/{placementKey}/recommendations</br>
      '),
      '#rows' => 2,
      '#required' => true,
    ];

    // Hardcoded for now
    $product_list = [
      'games',
      'arcade',
    ];

    foreach ($product_list as $product) {
      if (!empty($product)) {
        $form[$product] = [
          '#type' => 'details',
          '#title' => $this->t($product),
          '#collapsible' => true,
          '#group' => 'recommends_product_form'
        ];

        $form[$product][$product .'_category_list'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Categories'),
          '#default_value' => $this->get($product .'_category_list'),
          '#description' => $this->t('Enter category line. This will be the category keys as well'),
        ];

        $categories = array_map('trim', explode(PHP_EOL, $this->get($product .'_category_list')));
        foreach ($categories as $category) {
          if (!empty($category)) {
            $form[$product][$category] = [
              '#type' => 'details',
              '#title' => $this->t($category),
              '#collapsible' => true,
              '#group' => 'recommends_product_categories_form'
            ];

            $form[$product][$category][$product . '_' . $category .'_placement_key'] = [
              '#type' => 'textfield',
              '#title' => $this->t('Placement key'),
              '#default_value' => $this->get($product . '_' . $category .'_placement_key'),
              '#description' => $this->t('Placement key for this recommends request'),
              '#required' => true,
            ];

            $form[$product][$category][$product . '_' . $category .'_category_alias'] = [
              '#type' => 'textfield',
              '#title' => $this->t('Category Alias'),
              '#default_value' => $this->get($product . '_' . $category .'_category_alias'),
              '#description' => $this->t('Alias for this category.'),
              '#required' => true,
            ];

            $form[$product][$category][$product . '_' . $category .'_category_name'] = [
              '#type' => 'textfield',
              '#title' => $this->t('Category Name'),
              '#default_value' => $this->get($product . '_' . $category .'_category_name'),
              '#description' => $this->t('Category name - Translatable'),
              '#translatable' => true,
            ];
          }
        }
      }
    }
  }
}
