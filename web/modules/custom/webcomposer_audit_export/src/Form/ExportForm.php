<?php

namespace Drupal\webcomposer_audit_export\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

use Drupal\webcomposer_audit\Form\OverviewForm;

/**
 * Contribute form.
 */
class ExportForm extends FormBase {
  /**
   *
   */
  private $exportOperation;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->exportOperation = \Drupal::service('webcomposer_audit_export.export_operation');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'export_logs_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!empty($_SESSION['webcomposer_audit_export_filter'])) {
      $message = "Filters are applied for this export. You may see fewer results. Reset the filter to export all entries.";

      $form['message'] = [
        '#theme' => 'status_messages',
        '#message_list' => [
          'warning' => [$message],
        ],
      ];
    }

    $this->buildFilterForm($form, $form_state);

    return $form;
  }

  /**
   *
   */
  private function buildFilterForm(array &$form, FormStateInterface $form_state) {
    $date = date(OverviewForm::DATE_FORMAT);

    $form['filters'] = [
      '#type' => 'details',
      '#title' => $this->t('Audit Logs Export'),
      '#open' => TRUE,
      '#attributes' => [
        'style' => 'float: left; width: 100%;',
      ],
    ];

    $form['filters']['wrapper'] = [
      '#type' => 'container',
    ];

    $form['filters']['wrapper']['date'] = [
      '#type' => 'container',
      '#title' => t('Date Filters'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
      '#attributes' => [
        'class' => 'form--inline',
        'style' =>'clear: both; display: block;',
      ],
    ];

    $form['filters']['wrapper']['date']['date_start'] = [
      '#title' => 'Start Date',
      '#type' => 'date',
      '#size' => 20,
      '#description' => 'Sample format: ' . $date,
      '#default_value' => $this->getDateValue('date_start'),
      '#date_date_format' => OverviewForm::DATE_FORMAT,
      '#prefix' => '<div class="js-form-item form-item js-form-type-select form-type-select js-form-item-uid form-item-uid">',
      '#suffix' => '</div>',
    ];

    $form['filters']['wrapper']['date']['date_end'] = [
      '#title' => 'End Date',
      '#type' => 'date',
      '#size' => 20,
      '#description' => 'Sample format: ' . $date,
      '#default_value' => $this->getDateValue('date_end'),
      '#date_date_format' => OverviewForm::DATE_FORMAT,
      '#prefix' => '<div class="js-form-item form-item js-form-type-select form-type-select js-form-item-uid form-item-uid">',
      '#suffix' => '</div>',
    ];

    $form['filters']['wrapper']['date']['date_picker'] = [
      '#title' => 'Date Picker',
      '#description' => 'If a value is selected, Start and End Date Filters will be ignored.',
      '#type' => 'select',
      '#options' => OverviewForm::DATE_PICKER,
      '#attributes' => [
        'style' => 'margin-top: 10px; padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_export_filter']['date_picker']) ?
        $_SESSION['webcomposer_audit_export_filter']['date_picker'] : '-none-',
    ];

    $form['filters']['wrapper']['actions'] = [
      '#type' => 'container',
      '#title' => $this->t('Export Audit Logs'),
      '#attributes' => [
        'style' => 'float: left; width: 100%; margin-top: 1em; margin-bottom: 1em;',
      ],
    ];

    // $form['filters']['wrapper']['actions']['label'] = [
    //   '#type' => 'markup',
    //   '#markup' => $this->t("
    //     <p>Allows you to export audit logs data to a spreadsheet file.</p>
    //     <p><b>Reset</b> button fails after a successful <b>Export</b>. Update any filter to reenable <b>Reset</b> button.</p>
    //     <p><b>Export</b> button will not refresh the page to generate a spreadsheet file.</p>
    //   "),
    // ];

    $form['filters']['wrapper']['actions']['reset'] = [
      '#type' => 'submit',
      '#value' => $this->t('Reset'),
      '#submit' => ['::reset'],
      '#validate' => [],
    ];

    $form['filters']['wrapper']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Export'),
      '#id' => 'export',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach (OverviewForm::FILTER_DATE_KEYS as $key) {
      if (!empty($form_state->getValue($key))) {
        $_SESSION['webcomposer_audit_export_filter'][$key] = $form_state->getValue($key);
      } else {
        unset($_SESSION['webcomposer_audit_export_filter'][$key]);
      }
    }

    foreach (OverviewForm::FILTER_KEYS_OTHERS as $key) {
      if ($form_state->getValue($key)) {
        $_SESSION['webcomposer_audit_export_filter'][$key] = $form_state->getValue($key);
      } else {
        unset($_SESSION['webcomposer_audit_export_filter'][$key]);
      }
    }

    $filters = $this->getAllFilters();

    $this->exportOperation->setAuditFilters($filters);
    $this->exportOperation->doBatch();
  }

  /**
   *
   */
  public function reset(array &$form, FormStateInterface $form_state) {
    $_SESSION['webcomposer_audit_export_filter'] = [];
  }

  /**
   * Retrieves the default values for Drupal's DateTime field
   */
  private function getDateValue($field) {
    if (isset($_SESSION['webcomposer_audit_export_filter'][$field])) {
      return new DrupalDateTime($_SESSION['webcomposer_audit_export_filter'][$field]);
    }
  }

  /**
   *
   */
  private function getAllFilters() {
    $filter = [];
    $dateFilter = $this->getDateFilter();

    if ($dateFilter) {
      $filter['timestamp'] = $dateFilter;
    }

    return $filter;
  }

  /**
   * Processes timestamp query depending on date filters set
   */
  private function getDateFilter() {
    $date_picker = (isset($_SESSION['webcomposer_audit_export_filter']['date_picker'])) ?
      $_SESSION['webcomposer_audit_export_filter']['date_picker'] : null;

    if ($date_picker && $date_picker !== 0) {
      return [
        'value' => strtotime($date_picker),
        'operator' => '>='
      ];
    } else {
      $date_start = (isset($_SESSION['webcomposer_audit_export_filter']['date_start'])) ?
        strtotime($_SESSION['webcomposer_audit_export_filter']['date_start']) : null;
      $date_end = (isset($_SESSION['webcomposer_audit_export_filter']['date_end'])) ?
        strtotime($_SESSION['webcomposer_audit_export_filter']['date_end']) : null;

      if ($date_start && $date_end) {
        return [
          'value' => [
            $date_start,
            $date_end
          ],
          'operator' => 'BETWEEN'
        ];
      } elseif ($date_start) {
        return [
          'value' => $date_start,
          'operator' => '>='
        ];
      } elseif ($date_end) {
        return [
          'value' => $date_end,
          'operator' => '<='
        ];
      }
    }

    return false;
  }
}
