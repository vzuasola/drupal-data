<?php

namespace Drupal\webcomposer_domains_configuration_v2\Parser;

use Drupal\file\Entity\File;
use Interop\Container\ContainerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportParser
{
  public function __construct()
  {
  }

  public static function create(ContainerInterface $container)
  {
  }

  public function readExcel($form_state)
  {
    $message = 'Reading File...';
    if (is_object($form_state)) {
      $fid = $form_state->getValue('fid');
      if (!$fid) {
        $file_field = $form_state->getValue('import_file');
        $fid = $file_field[0];
      }
    } else {
      $fid = $form_state;
    }

    $uri = File::load($fid)->getFileUri();
    $realPath = \Drupal::service('file_system')->realpath($uri);

    // Extract the data from the excel file
    $excelData = $this->getExcelData($realPath);

  }

  private function getExcelData(string $path)
  {
    try {
      // Attempt to read excel file.
      $excelReader = IOFactory::createReaderForFile($path);
      $excelReader->setLoadAllSheets();
      $excel = $excelReader->load($path);
      $sheets = $excel->getSheetNames();
      // Isolate Token Sheets from Grouped sheets with domains
      // This is for me to set the default value for the domains without token values
      $datas = [];

      foreach ($sheets as $sheetName) {
        $sheet = $excel->getSheetByName($sheetName)
          ->setCodeName(strtolower($sheetName));
        $range = "A1:"
          . $sheet->getHighestDataColumn()
          . $sheet->getHighestDataRow(); // TODO: Test if same with blanks

        $sheetData = $sheet->rangeToArray($range, true, true, true);
        $this->parseSheet($sheetData, $sheet);
      }

      die();
    } catch (\Throwable $e) {
      // Log the error here?
      return $e;
    }
  }

  private function parseSheet($sheetData, Worksheet $sheet)
  {
    $sheetName = $sheet->getCodeName();
    if($sheetName === 'tokens') {
      var_dump($sheetData);
    }
    var_dump($sheetName);
  }

}
