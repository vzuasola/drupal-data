<?php

namespace Drupal\webcomposer_domains_configuration_v2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Annotation\WebcomposerConfigPlugin;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_domains_configuration_v2_export",
 *   route = {
 *     "title" = "Domains Export",
 *     "path" = "/admin/config/webcomposer/config/domains-export",
 *   },
 *   menu = {
 *     "title" = "Domains Export",
 *     "description" = "Provides domain export configuration",
 *     "parent" = "webcomposer_domains_configuration_v2.list",
 *     "weight" = 2
 *   },
 * )
 */
class ExportForm extends FormBase {
  const FORM_ID = 'export_domains_form';
  protected static $instanceId;

  /**
   * Constructor.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   *
   * @return string
   */
  public function getFormId() {
    return self::FORM_ID;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'item',
      '#title' => $this->t('Export Form'),
      '#markup' => $this->t('Under Construction'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
