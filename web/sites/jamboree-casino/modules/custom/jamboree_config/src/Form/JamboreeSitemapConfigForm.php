<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_sitemap",
 *   route = {
 *     "title" = "Sitemap Configuration",
 *     "path" = "/admin/config/jamboree/sitemap_configuration",
 *   },
 *   menu = {
 *     "title" = "Sitemap Configuration",
 *     "description" = "Provides sitemap configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeSitemapConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.sitemap_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['jamboree_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionSitemap($form);
    $this->sectionCustomLinks($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionSitemap(array &$form) {
    $form['sitemap'] = [
      '#type' => 'details',
      '#title' => $this->t('Sitemap'),
    ];


    $default_sitemap_enable = $this->get('enable_sitemap');
    $form['sitemap']['enable_sitemap'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Sitemap'),
      '#default_value' => $default_sitemap_enable,
      '#description' => 'When checked, sitemap page will be accessible',
    ];

    $default_sitemap_title = $this->get('sitemap_title');
    $form['sitemap']['sitemap_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $default_sitemap_title,
    ];

  }
}
