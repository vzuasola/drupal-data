<?php

/**
 * @file
 * Contains \Drupal\casino_optin_provision\Controller\DownloadResultsController.
 */

namespace Drupal\casino_optin_provision\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DownloadResultsController extends ControllerBase {

  /**
   * $connection
   */
  protected $connection;

  /**
   * $request
   */
  protected $request;

  /**
   * $dateFormatter
   */
  protected $dateFormatter;


  /**
   *
   */
  public function __construct($conn, $date_formatter, RequestStack $req){
    $this->connection = $conn;
    $this->dateFormatter = $date_formatter;
    $this->request = $req;
  }

  /**
   *
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('date.formatter'),
      $container->get('request_stack')
    );
  }

  /**
   *
   */
  public function download() {

    $data = array();

    $dateFrom = $this->request->getCurrentRequest()->get('date_from');
    $dateTo = $this->request->getCurrentRequest()->get('date_to');

    $tFrom = strtotime("$dateFrom 00:00:01");
    $tTo = strtotime("$dateTo 23:59:59");

    $query = $this->connection
                  ->select('casino_optin_report', 'opt')
                  ->fields('opt', array('oid','username','application_date','currency'))
                  ->condition('opt.application_date', array($tFrom, $tTo), 'BETWEEN')
                  ->orderBy('oid', 'DESC');

    $queryResults = $query->execute()->fetchAll();

    foreach ($queryResults as $key => $value) {
      $data[$key]['application_date'] = $this->dateFormatter->format($value->application_date, 'date_only');
      $data[$key]['username'] = $value->username;
      $data[$key]['currrency'] = $value->currency;
    }

    $this->generateCsv($data, "OptInreport-$dateFrom-$dateTo.csv");
  }

  /**
   * Generate CSV File
   */
  public function generateCsv($data, $filename = "export.csv") {

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=$filename");
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen("php://output", "w");

    fputcsv($output, array('Opt-In Date','Username','Currency'));
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
  }

}
