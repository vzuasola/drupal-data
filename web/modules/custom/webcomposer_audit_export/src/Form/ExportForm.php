<?php

namespace Drupal\webcomposer_audit_export\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class ExportForm extends FormBase {
  const DATE_FORMAT = 'm/d/Y';
  const TIME_FORMAT = 'h:i:s A';
  const EXPORT_BUTTON = 'export';
  const FILTER_DATE_KEYS = [
    'date_start',
    'date_end',
  ];
  const FILTER_KEYS_OTHERS = [
    'date_picker'
  ];
  const DATE_PICKER = [
    '0' => '-none-',
    '-1 day' => '1 DAY',
    '-3 day' => '3 DAYS',
    '-1 week' => '1 WEEK',
    '-2 week' => '2 WEEKS',
    '-1 month' => '1 MONTH',
    '-2 month' => '2 MONTHS',
  ];

  /**
   * logsExport object.
   *
   * @var logsExport
   */
  private $logsExport;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->logsExport = \Drupal::service('webcomposer_audit_export.logs_export');
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
    $date = date(self::DATE_FORMAT . ' ' . self::TIME_FORMAT);

    $form['filters'] = [
      '#type' => 'details',
      '#title' => $this->t('Filter Audit Logs Export'),
      '#open' => TRUE,
      '#attributes' => [
        'style' =>'float: left; width: 100%;',
      ],
    ];

    $form['filters']['wrapper'] = [
      '#type' => 'container',
    ];

    $form['filters']['wrapper']['date'] = [
      '#type' => 'fieldset',
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
      '#type' => 'datetime',
      '#size' => 20,
      '#description' => 'Sample format: ' . $date,
      '#default_value' => $this->getDateValue('date_start'),
      '#date_date_format' => self::DATE_FORMAT,
      '#date_time_format' => self::TIME_FORMAT,
      '#prefix' => '<div class="js-form-item form-item js-form-type-select form-type-select js-form-item-uid form-item-uid">',
      '#suffix' => '</div>',
    ];

    $form['filters']['wrapper']['date']['date_end'] = [
      '#title' => 'End Date',
      '#type' => 'datetime',
      '#size' => 20,
      '#description' => 'Sample format: ' . $date,
      '#default_value' => $this->getDateValue('date_end'),
      '#date_date_format' => self::DATE_FORMAT,
      '#date_time_format' => self::TIME_FORMAT,
      '#prefix' => '<div class="js-form-item form-item js-form-type-select form-type-select js-form-item-uid form-item-uid">',
      '#suffix' => '</div>',
    ];

    $form['filters']['wrapper']['date']['date_picker'] = [
      '#title' => 'Date Picker',
      '#description' => 'If a value is selected, Start and End Date Filters will be ignored.',
      '#type' => 'select',
      '#options' => self::DATE_PICKER,
      '#attributes' => [
        'style' => 'margin-top: 10px; padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_export_filter']['date_picker']) ?
        $_SESSION['webcomposer_audit_export_filter']['date_picker'] : '-none-',
    ];


    $form['filters']['wrapper']['actions'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Export Audit Logs'),
      '#description' => $this->t('<ul>
          <li>Allows you to export audit logs data to a spreadsheet file.</li>
          <li><b>Reset</b> button fails after a successful <b>Export</b>. Update any
          filter to reenable <b>Reset</b> button.</li>
          <li><b>Export</b> button will not refresh the page to generate a spreadsheet
          file.</li></ul>'),
    ];

    $form['filters']['wrapper']['actions']['reset'] = [
      '#type' => 'submit',
      '#value' => $this->t('Reset'),
      '#submit' => ['::reset'],
      '#validate' => [],
    ];

    $form['filters']['wrapper']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Export'),
      '#id' => self::EXPORT_BUTTON,
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
    $format = self::DATE_FORMAT . ' ' . self::TIME_FORMAT;

    foreach (self::FILTER_DATE_KEYS as $key) {
      if (is_object($form_state->getValue($key))) {
        $_SESSION['webcomposer_audit_export_filter'][$key] = $form_state->getValue($key)->format($format);
      } else {
        // Delete the session
        unset($_SESSION['webcomposer_audit_export_filter'][$key]);
      }
    }

    foreach (self::FILTER_KEYS_OTHERS as $key) {
      if ($form_state->getValue($key)) {
        $_SESSION['webcomposer_audit_export_filter'][$key] = $form_state->getValue($key);
      } else {
        // Delete session
        unset($_SESSION['webcomposer_audit_export_filter'][$key]);
      }
    }

    $batch = [];
    $batch = $this->generateExportBatch();
    batch_set($batch);
  }

  /**
   * Export Batch Function
   */
  public function generateExportBatch() {
    $logsDistinct = $this->logsExport->logsCount($this->getAllFilters());
    $batchNum = 500;
    $num_operations = intval(ceil($logsDistinct/$batchNum));

    $this->messenger()->addMessage($this->t('Exporting Audit Logs'));

    $operations = [];
    for ($i = 0; $i < $num_operations; $i++) {
      $operations[] = [
        [$this->logsExport, 'logsExportExcel'],
        [
          $i
        ],
      ];
    }
    $batch = [
      'title' => $this->t('Exporting Audit Logs'),
      'operations' => $operations,
      'finished' => [$this->logsExport, 'logExportBatchFinished'],
    ];

    return $batch;
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
      return new \Drupal\Core\Datetime\DrupalDateTime($_SESSION['webcomposer_audit_export_filter'][$field]);
    }

    return '';
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
