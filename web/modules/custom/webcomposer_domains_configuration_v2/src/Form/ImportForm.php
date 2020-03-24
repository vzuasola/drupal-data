<?php

namespace Drupal\webcomposer_domains_configuration_v2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Annotation\WebcomposerConfigPlugin;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_domains_configuration_v2",
 *   route = {
 *     "title" = "Domains Import",
 *     "path" = "/admin/config/webcomposer/config/domains-import",
 *   },
 *   menu = {
 *     "title" = "Domains Import",
 *     "description" = "Provides domain import configuration",
 *     "parent" = "webcomposer_domains_configuration_v2.list",
 *     "weight" = 30
 *   },
 * )
 */

class ImportForm extends FormBase {
  const FORM_ID = 'import_domains_form';
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
    $form['import_file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Import file'),
      '#required' => TRUE,
      '#upload_validators'  => [
        'file_validate_extensions' => ['csv xml xlsx'],
        'file_validate_size' => [25600000],
      ],
      '#upload_location' => 'public://taxonomy_files/',
      '#description' => t('Upload a file to Import Domains! Supported format xlsx'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
