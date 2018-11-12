<?php

namespace Drupal\webcomposer_audit_export\Parser;

/**
 * Class for creating and reading Excel Spreadsheet file using PHP Excel.
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
    $this->excel = new \PHPExcel();
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
      $excelReader = \PHPExcel_IOFactory::createReaderForFile($path);
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
      $sheets[$sheetName] = $excel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
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
  public function save($filename, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
    // Removes the blank worksheet set by PHP excel.
    $this->excel->removeSheetByIndex($this->sheetNumber);
    // Create writer for excel object.
    $excelWriter = \PHPExcel_IOFactory::createWriter($this->excel, $excel_version);

    // Set the headers so that browser will invoke an upload.
    if ($headers) {
      $this->setHeaders($filename);
    }

    // Output the excel file.
    $excelWriter->save($output);
  }

  /**
   *
   */
  public function generateContent($excel_version = 'Excel2007') {
    ob_start();
    $this->save(NULL, $excel_version, FALSE);
    return ob_get_clean();
  }

  /**
   * Triggers the browser to invoke download operation.
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
   */
  private function styleExcel() {
    $column = $this->excel->getActiveSheet()->getHighestColumn();

    $this->excel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $this->excel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);
    $this->excel->getDefaultStyle()->getAlignment()->setWrapText(TRUE);
    $this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    $this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(50);

    $this->excel->getActiveSheet()->getStyle('A1:' . $column . '1')->getFont()->setBold(TRUE);
  }

}
