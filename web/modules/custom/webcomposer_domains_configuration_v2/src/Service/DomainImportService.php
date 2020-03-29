<?php

namespace Drupal\webcomposer_domains_configuration_v2\Service;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser;
use Drupal\webcomposer_domains_configuration_v2\Storage\RedisService;

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
   * Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser definition.
   *
   * @var RedisService
   */
  protected $redisService;

  /**
   * Constructs a new DomainImportService object.
   */
  public function __construct(ImportParser $importParser, RedisService $redisService)
  {
    $this->importParser = $importParser;
    $this->redisService = $redisService;
  }

  public function execute(FormStateInterface $formState)
  {
    // 1 - Read the import file
    $this->importParser->readExcel($formState);
  }

}
