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
    $this->sectionSitemapXML($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionSitemap(array &$form) {
    $form['sitemap'] = [
      '#type' => 'details',
      '#title' => $this->t('Sitemap Page'),
    ];

    $default_sitemap_title = $this->get('sitemap_title');
    $form['sitemap']['sitemap_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sitemap Page Title'),
      '#default_value' => $default_sitemap_title,
      '#description' => $this->t('Sitemap Page title.'),
      '#translatable' => TRUE,
    ];

  }

  /**
   * {@inheritdoc}
   */
  private function sectionSitemapXML(array &$form) {
    $form['sitemap_xml'] = [
      '#type' => 'details',
      '#title' => $this->t('Sitemap XML Settings'),
    ];

    $default_sitemap_xml_paths = $this->get('sitemap_xml_paths');
    $form['sitemap_xml']['sitemap_xml_paths'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Relative Paths'),
      '#default_value' => $default_sitemap_xml_paths,
      '#description' => $this->t("Please specify drupal internal (relative) paths, one per line. Do not forget to prepend the paths with a '/'.<br>Optionally link priority <em>(0.0 - 1.0)</em> can be added by appending it after a space.<br> Optionally link change frequency <em>(always / hourly / daily / weekly / monthly / yearly / never)</em> can be added by appending it after a space."),
      '#translatable' => TRUE,
    ];

  }
}
