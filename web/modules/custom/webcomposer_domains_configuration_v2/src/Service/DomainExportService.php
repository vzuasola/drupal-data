<?php

namespace Drupal\webcomposer_domains_configuration_v2\Service;

use Drupal\webcomposer_domains_configuration_v2\Parser\ExcelParser;
use Drupal\webcomposer_domains_configuration_v2\Storage\StorageService;

/**
 * Class DomainExportService.
 */
class DomainExportService {

  const DEFAULT_LANG = 'en';

  /**
   * @var ExcelParser
   */
  protected $excelParser;

  /**
   * @var StorageService
   */
  protected $storage;

  /**
   * Constructs a new DomainImportService object.
   */
  public function __construct(ExcelParser $excelParser, StorageService $storage) {
    $this->excelParser = $excelParser;
    $this->storage = $storage;
  }

  /**
   * executes the export process
   */
  public function execute() {
    $tokens = $this->getTokensSheet();
    $groups = $this->getGroupSheet();

    // Create tokens sheet
    $this->excelParser->createSheet($tokens, 'tokens');
    foreach ($groups as $group => $domains) {
      // Create domains sheet (with domains)
      $this->excelParser->createSheet($domains, $group);
    }

    // Invoke excel creation and download.
    $this->excelParser->save('export.xlsx');

    // Stop script only if headers is set to invoke a download.
    exit;
  }

  /**
   * Retrieves the tokens from storage
   *
   * @return array
   */
  private function getTokensSheet() {
    $tokenSheet[] = ['tokens', "Default"];
    foreach ($this->storage->getTokens() as $token => $default) {
      $tokenSheet[] = [$token, $default];
    }

    return $tokenSheet;
  }

  /**
   * Retrieves the groups from storage
   *
   * @return array
   */
  private function getGroupSheet() {
    $groups = $this->storage->getGroups();
    ksort($groups);
    $groupSheet = [];

    array_unshift($tokens, "domains");
    foreach ($groups as $group => $domains) {
      $groupName = str_replace('groups:', '', $group);
      foreach ($domains as $domain) {
        $domainDetails = $this->getDomainDetails($domain);
        if (count($groupSheet[$groupName]) === 0) {
          $tokens = array_keys($domainDetails);
          array_unshift($tokens, "domains");
          $groupSheet[$groupName][] = $tokens; // Set the header
        }
        $domainRow = array_merge([$domain], array_values($domainDetails));
        $groupSheet[$groupName][] = $domainRow;
      }
    }

    return $groupSheet;
  }

  /**
   * @param $domain
   * @param $lang
   * @return array
   */
  private function getDomainDetails($domain, $lang = self::DEFAULT_LANG) {
    $domainDetails = $this->storage->getDomain($domain, $lang);
    return $domainDetails;
  }
}
