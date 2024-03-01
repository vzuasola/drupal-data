<?php

namespace Drupal\webcomposer_audit\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_audit_cleanup",
 *   route = {
 *     "title" = "Webcomposer Audit Cleanup Config",
 *     "path" = "/admin/config/webcomposer/audit/cleanupconfig",
 *   },
 * )
 */
class CleanupConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_audit.cleanup_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $timeUnits = [
      'day' => 'Day',
      'week' => 'Week',
      'month' => 'Month',
      'year' => 'Year'
    ];
    $form['info'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div>Runs every time crons runs between the allowed hours. Configure cron <a href='/admin/config/system/cron'>here</a> </div>"),
    ];
  $form['cleanup'] = [
      '#type' => 'details',
      '#title' => $this->t('Cleanup Config'),
      '#collapsible' => False,
      '#open' => TRUE,
    ];
  // Hide language
  $form['cleanup']['cleanup_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Automated Cleanup'),
    '#default_value' => $this->get('cleanup_enabled'),
  );
    $form['cleanup']['limit_date_wrapper'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => 'form--inline',
      ],
    ];
    $form['cleanup']['limit_date_wrapper']['limit_date_num'] = [
      '#title' => 'Cleanup only older than',
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->get('limit_date_num') ?? '6',
    ];

    $form['cleanup']['limit_date_wrapper']['limit_date_unit'] = [
      '#title' => '',
      '#type' => 'select',
      '#options' => $timeUnits,
      '#attributes' => [
        'style' => 'padding-top: 3px; padding-bottom: 4px; margin-top:18px',
      ],
      '#default_value' => $this->get('limit_date_unit') ?? 'month',
    ];
    $form['cleanup']['limit_date_wrapper']['actions'] = [
      '#type' => 'actions',
    ];
    $form['cleanup']['datelimit_note'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div>There is a hard limit of six months, values lower than that will be disregarded</div>"),
    ];

    $form['cleanup']['limit_num'] = [
      '#title' => 'How many to clean up per run',
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->get('limit_num') ?? 50,
    ];

    $form['cleanup']['allowed_hours_wrapper'] = [
      '#type' => 'container',
      '#title' => $this->t('Cleanup Config'),
      '#attributes' => [
        'class' => 'form--inline',
      ],
    ];
    $utcnow = gmdate('Y-m-d H:i:s');
    $form['cleanup']['allowed_hours_wrapper']['label'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div style='margin-top:25px'>Run Between Hours (UTC). Current date time: <strong>$utcnow</strong>  (ex.: 6-9 means from 06:00-09:59)</div>"),
    ];

    $form['cleanup']['allowed_hours_wrapper']['allowed_hours_start'] = [
      '#title' => 'From',
      '#type' => 'select',
      '#options' => range(0,23),
      '#default_value' => $this->get('allowed_hours_start') ?? '6',
    ];
    $form['cleanup']['allowed_hours_wrapper']['allowed_hours_end'] = [
      '#title' => 'To',
      '#type' => 'select',
      '#options' => range(0,23),
      '#default_value' => $this->get('allowed_hours_end') ?? '9',
    ];
    $form['cleanup']['allowed_hours_wrapper']['actions'] = [
      '#type' => 'actions',
    ];
    $form['cleanup']['run_manual'] = [
      '#type' => 'submit',
      '#value' => $this->t('Run Cleanup Manually'),
      '#attributes' => [
        'style' => 'margin-top:15px; margin-left:0 ',
      ],
      '#submit' => ['::manual'],
    ];
    $form['cleanup']['run_manual_force'] = [
      '#type' => 'submit',
      '#value' => $this->t('Force Run Cleanup Manually'),
      '#attributes' => [
        'style' => 'margin-top:15px; margin-left:0 ',
      ],
      '#submit' => ['::manualforce'],
    ];
    $form['cleanup']['action_note'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div style='margin-top:10px'>\"Run Cleanup\" follows the normal runtime rules (feature flag & hour restriction). \"Force Run\" disregards them and runs no matter what.</div>"),
    ];

    $form['cleanup_stats'] = [
      '#type' => 'details',
      '#title' => $this->t('Cleanup Stats'),
      '#collapsible' => TRUE,
      '#open' => False,
    ];
    
    $lastRun = \Drupal::state()->get('webcomposer_audit.last_cleanup_execute');
    $lastRun = $lastRun === null ? 'Never' : gmdate('Y-m-d H:i:s', $lastRun);

    $lastCount = \Drupal::state()->get('webcomposer_audit.last_cleanup_count');
    $lastCount = $lastCount ?? '-';

    $form['cleanup_stats']['last_run'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div>Last Run Date (UTC): $lastRun</div>"),
    ];
    $form['cleanup_stats']['last_count'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div>Last Run Count: $lastCount</div>"),
    ];

    return $form;
  }

  public function manual(array &$form, FormStateInterface $form_state) {
    $cleanupStatus = \Drupal\webcomposer_audit\Cleanup::runCleanup();
    if($cleanupStatus){
      \Drupal::messenger()->addStatus('Cleanup successful');  
    } else {
      \Drupal::messenger()->addWarning('Cleanup failed');  
    }
  }
  public function manualforce(array &$form, FormStateInterface $form_state) {
    $cleanupStatus = \Drupal\webcomposer_audit\Cleanup::runCleanup(true);
    if($cleanupStatus){
      \Drupal::messenger()->addStatus('Force Cleanup successful');  
    } else {
      \Drupal::messenger()->addWarning('Force Cleanup failed');  
    }
  }
}
