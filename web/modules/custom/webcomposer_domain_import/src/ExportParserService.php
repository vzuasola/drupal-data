<?php

namespace Matterhorn\Domains;

use phpoffice\phpexcel;

/**
 * Class for creating and reading Matterhorn Domains Excel Spreadsheet file using PHP Excel
 *
 * @package Matterhorn Domains
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 *
 */
class ExcelParserService {

	// Main PHP excel object
	private $excel;
	// The filename of the excel file
	private $filename;
	// Number of sheets
	private $sheet_number;

	/**
	 * Constructor function
	 * Passing the excel object to the class instance
	 *
	 * @param array $rows - the phpexcel array object
	 *
	 */
	public function __construct() {
		// initialize PHP excel object
		$this->excel = new \PHPExcel();
		// set filename
		$this->sheet_number = 0;
	}

	/**
	 * Reads and parses an excel file into a array of worksheets
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $path
	 * @return array $sheets
	 *
	 */
	public function read_excel($path) {
		try {
			// attempt to read excel file
			$excelReader = \PHPExcel_IOFactory::createReaderForFile($path);
			$excelReader->setLoadAllSheets();
			$excel = $excelReader->load($path);
		} catch (Exception $e) {
			// an error has occured parsing the excel file
			return FALSE;
		}

		// get all sheet names from the file
		$worksheetNames = $excel->getSheetNames($path);

		$sheets = array();

		foreach($worksheetNames as $key => $sheetName){
			$excel->setActiveSheetIndexByName($sheetName);
			$sheets[$sheetName] = $excel->getActiveSheet()->toArray(NULL, TRUE, TRUE, TRUE);
		}

		return $sheets;
	}

	/**
	 * Creates an excel sheet based on the given worksheet data
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $data - the array containing a single worksheet data
	 * @param array $sheet_name - the name of the worksheet
	 *
	 */
	public function create_sheet($data, $sheet_name) {
		// create a new worksheet
		$this->excel->createSheet();
		// populate sheet with data and add sheet name
		$this->excel->setActiveSheetIndex($this->sheet_number);
	    $this->excel->getActiveSheet()->fromArray($data);
	    $this->excel->getActiveSheet()->setTitle($sheet_name);

	    // calls the stlyer function
	    $this->style_excel($data);

	    // increment sheet count
	    $this->sheet_number = $this->sheet_number + 1;
	}

	/**
	 * Generate the excel file and invoke download operation
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $excel_version - the excel version of the generated excel
	 * @param boolean $headers - check if download will be invoked from browser
	 * @param array $output - the URL to output the file
	 *
	 */
	public function save($filename, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
		// Removes the blank worksheet set by PHP excel
		$this->excel->removeSheetByIndex($this->sheet_number);
		// create writer for excel object
		$excelWriter = \PHPExcel_IOFactory::createWriter($this->excel, $excel_version);

		// set the headers so that browser will invoke an upload
		if ($headers) {
			$this->set_headers($filename);
		}

		// output the excel file
		$excelWriter->save($output);
	}

	/**
	 * Triggers the browser to invoke download operation
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 *
	 */
	private function set_headers($filename) {
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header("Content-Transfer-Encoding: binary ");
	}

	/**
	 * Apply styling to worksheet
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 *
	 */
	private function style_excel() {
		// Column and row dimension
		$column = $this->excel->getActiveSheet()->getHighestColumn();

		$this->excel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		// $this->excel->getDefaultStyle()->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(17);
		$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

	    $this->excel->getActiveSheet()->getStyle('A1:' . $column . '1')->getFont()->setBold(true);
	    // $this->excel->getActiveSheet()->getRowDimension('1')->getStyle()->getFont()->setBold(true);

	    // $this->excel->getDefaultStyle()->getFont()->setName('Arial');
	}

}