<?php

namespace Drupal\webcomposer_domain_import\Parser;

/**
 * Class for creating and reading Excel Spreadsheet file using PHP Excel.
 *
 * @package Matterhorn Domains
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 */
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
    $this->excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    // Set filename.
    $this->sheetNumber = 0;
  }

  /**
   * Reads and parses an excel file into a array of worksheets.
   *
   * @param string $path
   *   File path uri.
   *
   * @return array
   *   Return sheets of excel file.
   */
  public function readExcel($path) {
    try {
      // Attempt to read excel file.
      $excelReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($path);
      $excelReader->setLoadAllSheets();
      $excel = $excelReader->load($path);
    }
    catch (Exception $e) {
      // An error has occured parsing the excel file.
      return FALSE;
    }

    // Get all sheet names from the file.
    $worksheetNames = $excel->getSheetNames($path);

    $sheets = [];

    foreach ($worksheetNames as $key => $sheetName) {
      $excel->setActiveSheetIndexByName($sheetName);

      // Get last column with data
      $column = $excel->getActiveSheet()->getHighestDataColumn();
      // Get last row with data
      $row = $excel->getActiveSheet()->getHighestRow();
      $cell = $column.$row;
      $sheets[$sheetName] = $excel->getActiveSheet()->rangeToArray('A1:'.$cell, TRUE, TRUE, TRUE);
    }

    return $sheets;
  }

  /**
   * Creates an excel sheet based on the given worksheet data.
   *
   * @param array $data
   *   The array containing a single worksheet data.
   * @param string $sheet_name
   *   The name of the worksheet.
   */
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

  /**
   * Generate the excel file and invoke download operation.
   *
   * @param string $filename
   *   Name of the excel file.
   * @param string $excel_version
   *   The excel version of the generated excel.
   * @param bool $headers
   *   Check if download will be invoked from browser.
   * @param string $output
   *   The URL to output the file.
   */
  public function save($filename, $excel_version = 'Xlsx', $headers = TRUE, $output = 'php://output') {
    // Removes the blank worksheet set by PHP excel.
    $this->excel->removeSheetByIndex($this->sheetNumber);
    // Create writer for excel object.
    $excelWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->excel, $excel_version);

    // Set the headers so that browser will invoke an upload.
    if ($headers) {
      $this->setHeaders($filename);
    }

    // Output the excel file.
    $excelWriter->save($output);
  }

  /**
   * Triggers the browser to invoke download operation.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   */
  private function setHeaders($filename) {
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header("Content-Transfer-Encoding: binary ");
  }

  /**
   * Apply styling to worksheet.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   */
  private function styleExcel() {
    // Column and row dimension.
    $column = $this->excel->getActiveSheet()->getHighestColumn();

    $this->excel->getDefaultStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
    // $this->excel->getDefaultStyle()->getAlignment()->setWrapText(true);
    $this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(17);
    $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

    $this->excel->getActiveSheet()->getStyle('A1:' . $column . '1')->getFont()->setBold(TRUE);
    // $this->excel->getActiveSheet()->getRowDimension('1')->getStyle()->getFont()->setBold(true);
    // $this->excel->getDefaultStyle()->getFont()->setName('Arial');
  }

}
