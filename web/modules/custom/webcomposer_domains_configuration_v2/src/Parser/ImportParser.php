<?php

namespace Drupal\webcomposer_domains_configuration_v2\Parser;

use Drupal;
use Drupal\file\Entity\File;
use Exception;
use Interop\Container\ContainerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportParser {
  private $tokens = [];
  const DOMAIN_COLUMN = 'domains';
  const TOKEN_COLUMN = 'tokens';

  public function __construct() {
  }

  public static function create(ContainerInterface $container) {
  }

  public function readExcel($form_state) {
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
    $realPath = Drupal::service('file_system')->realpath($uri);

    // Extract the data from the excel file
    return $this->getExcelData($realPath);
  }

  private function getExcelData(string $path) {
    // Attempt to read excel file.
    $excelReader = IOFactory::createReaderForFile($path);
    $excelReader->setLoadAllSheets();
    $excel = $excelReader->load($path);
    $sheets = $excel->getSheetNames();
    $excelData = [];

    foreach ($sheets as $sheetName) {
      $sheet = $excel->getSheetByName($sheetName)
        ->setCodeName(strtolower(trim($sheetName)));
      $range = "A1:"
        . $sheet->getHighestDataColumn()
        . $sheet->getHighestDataRow(); // TODO: Test if same with blanks

      $sheetData = $sheet->rangeToArray($range, true, true, false);
      $excelData[$sheet->getCodeName()] = $this->parseSheet($sheetData, $sheet);
    }
    $this->sanitizeSheetData($excelData);

    return ($excelData);
  }

  private function parseSheet($sheetData, Worksheet $sheet) {
    $sheetName = $sheet->getCodeName();
    if ($sheetName === self::TOKEN_COLUMN) {
      return $this->parseTokens($sheetData);
    }
    return $this->parseDomains($sheetData);
  }

  private function parseTokens($sheetData) {
    $headings = array_shift($sheetData);
    array_walk(
      $sheetData,
      function (&$row) use ($headings) {
        $row = array_combine($headings, $row);
      }
    );
    $this->tokens = array_column($sheetData, 'Default', self::TOKEN_COLUMN);
    array_walk($this->tokens, function (&$token) {
      if (is_bool($token) && $token) {
        $token = "";
      }
    });

    return $this->tokens;
  }

  private function parseDomains($sheetData) {
    $headings = array_shift($sheetData);
    $domainData = [];
    array_walk(
      $sheetData,
      function (&$row) use ($headings) {
        $row = array_combine($headings, $row);
      }
    );

    // Remove domains rows with no value
    $sheetData = array_filter($sheetData, function ($sheet) {
      if ($sheet[self::DOMAIN_COLUMN]) {
        return is_string($sheet[self::DOMAIN_COLUMN]);
      }
      throw new Exception("Invalid Sheet Format");
    });

    foreach ($sheetData as $domainRow) {
      $domain = $domainRow[self::DOMAIN_COLUMN];
      $this->filterTokens($domainRow);
      $domainData[$domain] = $domainRow;
    }

    return $domainData;
  }

  private function filterTokens(&$domainRow) {
    unset($domainRow[self::DOMAIN_COLUMN]);
    foreach ($domainRow as $key => $data) {
      // If the $domainRow has a token not included on the masterlist token,
      // do not include it on the parsed data
      if (!isset($this->tokens[$key]) || is_numeric($key)) {
        unset($domainRow[$key]);
        continue;
      }
      // If the domain column has a boolean value this means that it is empty on its cell
      $domainRow[$key] = (is_bool($domainRow[$key]) && $domainRow[$key])
        ? ""
        : $domainRow[$key];
    }
  }

  private function sanitizeSheetData(&$sheet) {
    array_walk_recursive(
      $sheet,
      function (&$value) {
        if (is_string($value)) {
          $value = trim($value);
        }
      }
    );
  }
}
