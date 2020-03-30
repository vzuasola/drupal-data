<?php

namespace Drupal\webcomposer_domains_configuration_v2\Service;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser;
use Drupal\webcomposer_domains_configuration_v2\Storage\RedisService;
use Drupal\webcomposer_domains_configuration_v2\Storage\StorageInterface;

/**
 * Class DomainImportService.
 */
class DomainImportService
{

  /**
   * Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser definition.
   *
   * @var ImportParser
   */
  protected $importParser;

  /**
   * Drupal\webcomposer_domains_configuration_v2\Storage\StorageInterface definition.
   *
   * @var StorageInterface
   */
  protected $storage;

  /**
   * Constructs a new DomainImportService object.
   */
  public function __construct(ImportParser $importParser, StorageInterface $storage)
  {
    $this->importParser = $importParser;
    $this->storage = $storage;
  }

  public function execute(FormStateInterface $formState)
  {
    $start = microtime(true);
    // 1 - Read the import file
    $excelData = $this->importParser->readExcel($formState);

    print "Execution Time: " . number_format((microtime(true) - $start), 2);
    die();
  }

}
