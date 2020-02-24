<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_avaya_blocking",
 *   route = {
 *     "title" = "Avaya Blocking Configuration",
 *     "path" = "/admin/config/jamboree/avaya_blocking_configuration",
 *   },
 *   menu = {
 *     "title" = "Avaya Blocking Configuration",
 *     "description" = "Provides Avaya Blocking configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeAvayaBlockingForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.jamboree_avaya_blocking'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Avaya Blocking Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {

    $form['page_setting'] = [
        '#type' => 'details',
        '#title' => t('Avaya Blocking Setting'),
        '#group' => 'advanced',
      ];

    $d = $this->get('users_list');
    $form['page_setting']['users_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Users List'),
      '#default_value' => $d,
      '#format' => $d['format'],
      '#description' => 'One username per line ',
    ];
  }
}