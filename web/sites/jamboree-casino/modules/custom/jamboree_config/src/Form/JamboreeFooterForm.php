<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_footer",
 *   route = {
 *     "title" = "Footer Configuration",
 *     "path" = "/admin/config/jamboree/footer_configuration",
 *   },
 *   menu = {
 *     "title" = "Footer Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeFooterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.footer_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $this->sectionFooterBlurb($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionFooterBlurb(array &$form) {
    $form['footer'] = [
      '#type' => 'details',
      '#title' => t('Footer Blurb'),
      '#group' => 'advanced',
    ];

    $d = $this->get('footer_blurb');

    $form['footer']['footer_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Footer Blurb'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }
}
