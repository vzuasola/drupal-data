<?php

namespace Drupal\webcomposer_territory_blocking\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "territory_blocking",
 *   route = {
 *     "title" = "Territory Blocking Configuration",
 *     "path" = "/admin/config/webcomposer/config/territoryblocking",
 *   },
 *   menu = {
 *     "title" = "Territory Blocking Configuration",
 *     "description" = "Provides Webcomposer Territory Blocking configuration",
 *     "parent" = "webcomposer_territory_blocking.list",
 *     "weight" = 30
 *   },
 * )
 */
class TerritoryBlockingForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.territory_blocking'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['territory_blocking_tab'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Balance Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'territory_blocking_tab',
    ];

    $form['field_configuration']['territory_blocking_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Territory Blocking'),
      '#required' => true,
      '#description' => $this->t("Add a key value pair of balance mapping
        <br>
        Format is balance, then comma separated country codes, separated by pipe
        <br>
        <br>
        Example <strong>5|US,CH,PH,SG</strong>
      "),
      '#default_value' => $this->get('territory_blocking_mapping')
    ];

    return $form;
  }

}
