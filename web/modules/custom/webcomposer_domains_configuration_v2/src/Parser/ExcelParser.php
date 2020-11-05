<?php

namespace Drupal\webcomposer_domains_configuration_v2\Parser;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExcelParser {

  /**
   * Main PHP excel object.
   *
   * @var excel
   */
  private $excel;
  /**
   * The filename of the excel file.
   *
   * @var filename
   */
  private $filename;
  /**
   * Number of sheets.
   *
   * @var sheetNumber
   */
  private $sheetNumber;

  /**
   * Constructor function Passing the excel object to the class instance.
   */
  public function __construct() {
    // Initialize PHP excel object.
    $this->excel = new Spreadsheet();
    // Set filename.
    $this->sheetNumber = 0;
  }

  public function createSheet(array $data, $sheet_name) {
    // Create a new worksheet.
    $this->excel->createSheet();
    // Populate sheet with data and add sheet name.
    $this->excel->setActiveSheetIndex($this->sheetNumber);
    $this->excel->getActiveSheet()->fromArray($data);
    $this->excel->getActiveSheet()->setTitle($sheet_name);

    // Calls the stlyer function.
    $this->styleExcel($data);

    // Increment sheet count.
    $this->sheetNumber = $this->sheetNumber + 1;
  }

  public function save($filename, $excel_version = 'Xlsx', $headers = TRUE, $output = 'php://output') {
    // Removes the blank worksheet set by PHP excel.
    $this->excel->removeSheetByIndex($this->sheetNumber);
    // Create writer for excel object.
    $excelWriter = IOFactory::createWriter($this->excel, $excel_version);

    // Set the headers so that browser will invoke an upload.
    if ($headers) {
      $this->setHeaders($filename);
    }

    // Output the excel file.
    $excelWriter->save($output);
  }

  private function setHeaders($filename) {
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header("Content-Transfer-Encoding: binary ");
  }

  private function styleExcel() {
    // Column and row dimension.
    $column = $this->excel->getActiveSheet()->getHighestColumn();

    $this->excel->getDefaultStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
    $this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(17);
    $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

    $this->excel->getActiveSheet()->getStyle('A1:' . $column . '1')->getFont()->setBold(TRUE);

  }

}
