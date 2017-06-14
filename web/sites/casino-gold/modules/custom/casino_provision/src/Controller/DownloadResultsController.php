<?php

/**
 * @file
 * Contains \Drupal\casino_provision\Controller\DownloadResultsController.
 */

namespace Drupal\casino_provision\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DownloadResultsController extends ControllerBase {

  /**
   * @var $connection
   */
  protected $connection;

  /**
   * @var $request
   */
  protected $request;

  /**
   * @var $dateFormatter
   */
  protected $dateFormatter;


  /**
   * @var \Drupal\Core\Database\Connection $conn
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack $req
   *
   * @var \Drupal\Core\Datetime $date_formatter
   */
  public function __construct($conn, $date_formatter, RequestStack $req){
    $this->connection = $conn;
    $this->dateFormatter = $date_formatter;
    $this->request = $req;
  }

  /**
   * @var Symfony\Component\DependencyInjection\ContainerInterface $container
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('date.formatter'),
      $container->get('request_stack')
    );
  }

  /**
   * Page Callback
   */
  public function download() {

    $data = array();

    $dateFrom = $this->request->getCurrentRequest()->get('date_from');
    $dateTo = $this->request->getCurrentRequest()->get('date_to');

    $tFrom = strtotime("$dateFrom 00:00:00");
    $tTo = strtotime("$dateTo 23:59:59");

    $query = $this->connection
                  ->select('casino_provision_report', 'opt')
                  ->fields('opt', array('oid','username','application_date','currency'))
                  ->condition('opt.application_date', array($tFrom, $tTo), 'BETWEEN')
                  ->orderBy('opt.application_date', 'DESC');

    $queryResults = $query->execute()->fetchAll();

    foreach ($queryResults as $key => $value) {
      $data[$key]['application_date'] = $this->dateFormatter->format($value->application_date, 'date_only');
      $data[$key]['username'] = $value->username;
      $data[$key]['currrency'] = $value->currency;
    }

    $this->generateCsv($data, "OptInreport.csv");
  }

  /**
   * Generate CSV File
   *
   * @var array $data
   *
   * @var string $filename
   */
  public function generateCsv($data, $filename = "export.csv") {

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=$filename");
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen("php://output", "w");

    fputcsv($output, array('Date','Username','Currency'));
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
  }

}
