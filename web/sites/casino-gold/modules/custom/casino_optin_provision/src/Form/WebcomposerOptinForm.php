<?php

/**
 * @file
 * Contains \Drupal\casino_optin_provision\Form\WebcomposerOptinForm.
 */

namespace Drupal\casino_optin_provision\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Symfony\Component\HttpFoundation\RequestStack;


class WebcomposerOptinForm extends FormBase{

  /**
   * $connection
   */
  protected $connection;

  /**
   * $config
   */
  protected $config;

  /**
   * $dateFormatter
   */
  protected $dateFormatter;

  /**
   * $request
   */
  protected $request;


  /**
   *
   */
  public function __construct($conn, $conf, $date_formatter, RequestStack $request) {
    $this->connection = $conn;
    $this->config = $conf;
    $this->dateFormatter = $date_formatter;
    $this->request = $request;
  }


  /**
   *
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('config.factory'),
      $container->get('date.formatter'),
      $container->get('request_stack')
    );
  }

  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'webcomposer_optin_report_form';
  }

  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $dateNow = $this->dateFormatter->format(time(), 'date_only');

    $dateConfig = $this->config->get('core.date_format.date_only');
    $format = $dateConfig->get('pattern');

    // get the results from the parameters
    $date_from = $this->request->getCurrentRequest()->get('date_from');
    $date_to = $this->request->getCurrentRequest()->get('date_to');

    $isValidDate = false;

    /**
     * TODO
     * Change type from date to textfield and apply jQuery Datepicker
     */
    $form['date_from'] = array(
      '#type' => 'date',
      '#title' => $this->t('Date From'),
      '#date_date_format' => $format,
      '#default_value' => $date_from ?? $dateNow,
      '#required' => true
    );

    $form['date_to'] = array(
      '#type' => 'date',
      '#title' => $this->t('Date To'),
      '#date_date_format' => $format,
      '#default_value' => $date_to ?? $dateNow,
      '#required' => true
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Search'),
      '#button_type' => 'primary',
    );

    if ( $this->validateDate($date_from) && $this->validateDate($date_to)) {
      $result = $this->buildTable($date_from, $date_to);
      $form['search_result'] = array(
        '#type' => 'item',
        '#markup' => $result,
      );
    }

    return $form;
  }

  /**
  * {@inheritdoc}
  */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $formValue = $form_state->getValues();
    $dFrom = strtotime($formValue['date_from']);
    $dTo = strtotime($formValue['date_to']);

    if (!$this->validateDate($formValue['date_from'])) {
      $form_state->setErrorByName('date_from', $this->t('The value in Date is not a valid date.'));
    }

    if (!$this->validateDate($formValue['date_to'])) {
      $form_state->setErrorByName('date_to', $this->t('The value in Date is not a valid date.'));
    }

    if ($this->validateDate($formValue['date_from']) && $this->validateDate($formValue['date_to'])) {
      if ($dFrom > $dTo) {
        $form_state->setErrorByName('date_from', $this->t('Please check your date.'));
      }
    }
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $csvArray = array();
    $formValue = $form_state->getValues();

    $url = Url::fromRoute('casino_optin_provision.report')
          ->setRouteParameters(array(
            'date_from' => $formValue['date_from'],
            'date_to'=> $formValue['date_to']));

    $form_state->setRedirectUrl($url);
  }

  /**
   * Build table result
   */
  public function buildTable($dateFrom, $dateTo) {

    $rows = array();
    $dFrom = strtotime("$dateFrom 00:00:01");
    $dTo = strtotime("$dateTo 23:59:59" );

    $query = $this->connection
                  ->select('casino_optin_report', 'opt')
                  ->condition('opt.application_date', array($dFrom, $dTo), 'BETWEEN');

    $countQuery = clone $query;
    $countQuery->addExpression('Count(opt.oid)');

    $pagedQuery = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender');
    $pagedQuery->limit(2);
    $pagedQuery->setCountQuery($countQuery);

    $results = $pagedQuery->fields('opt', array('oid','username','application_date','currency'))
                        ->orderBy('application_date', 'DESC')
                        ->execute();

    if ( count( $query->execute()->fetchAll() ) > 0) {
      foreach ($results as $key => $value) {
        $rows[$key]['application_date'] = $this->dateFormatter->format($value->application_date, 'date_only');
        $rows[$key]['username'] = $value->username;
        $rows[$key]['currrency'] = $value->currency;
      }
    } else {
      return "No Results!";
    }

    $url = Url::fromRoute('casino_optin_provision.download',array(
      'date_from' => $dateFrom,
      'date_to'=> $dateTo
    ));
    $link = Link::fromTextAndUrl(t('csv'), $url);
    $link = $link->toRenderable();

    $table = array(
      "#markup" => "Export results to " . render($link) . "<br>",
    );
    $header = array(
      array('data' => $this->t('Opt-In Date')),
      array('data' => $this->t('username')),
      array('data' => $this->t('Currency')),
    );

    $table['config_table'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    );
    $table['pager'] = array(
      '#type' => 'pager'
    );

    return drupal_render($table);
  }


  /**
   * Validate date
   */
  function validateDate($date) {
    $dateConfig = $this->config->get('core.date_format.date_only');
    $format = $dateConfig->get('pattern');

    $d = \DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }
}
