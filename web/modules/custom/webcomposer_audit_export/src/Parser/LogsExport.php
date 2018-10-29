<?php

namespace Drupal\webcomposer_audit_export\Parser;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\TypedData\TypedDataInterface;

use Drupal\webcomposer_audit\Storage\AuditStorageInterface;

/**
 * Class which handles domain export.
 */
class LogsExport {

  /**
   * ExcelParser object.
   *
   * @var excelParser
   */
  protected $excelParser;

  /**
   * Service for the export parser.
   *
   * @var service
   */
  protected $service;

  /**
   * Filters for the export parser.
   *
   * @var filters
   */
  private $filters = [];

  /**
   * Constructor.
   */
  public function __construct($excelParser, $service) {
    $this->excelParser = $excelParser;
    $this->service = $service;
  }

  /**
   * Gets Matterhorn Audit Log data and invoke export excel operation.
   *
   * @param array $filters
   *   - Array of date filters.
   * @author yunyce <yunyce.dejesus@bayviewtechnology.com>
   */
  public function logsExportExcel() {
    $data = $this->logsExportGetParsedData();
    $this->logsExportCreateExcel($data);
  }

  /**
   * Gets data from Matterhorn Audit Log and parse it to PHP excel readable array.
   *
   * @return array
   *   The parsed Matterhorn Audit Log data
   */
  public function logsExportGetParsedData() {
    $result = [];

    $logs = $this->service->get_audit_logs($this->filters);

    // Post process audit log data
    $process_logs = $this->postProcessLogsData($logs);

    $result['logs'] = $this->service->excel_get_audit_logs($process_logs);

    return $result;
  }

  /**
   * Creates the excel worksheet from given parsed data invokes excel download.
   *
   * @param string $data
   *   - The parsed Domain data.
   * @param string $excel_version
   *   - The excel version of the generated excel.
   * @param bool $headers
   *   - Check if download will be invoked from browser.
   * @param string $output
   *   - The URL to output the file.
   */
  public function logsExportCreateExcel($data, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
    // Create token placeholder worksheet.
    $this->excelParser->createSheet($data['logs'], 'Audit Logs');
    // Invoke excel creation and download.
    $this->excelParser->save('export.xlsx', $excel_version, $headers, $output);

    // Stop script only if headers is set to invoke a download.
    if ($headers) {
      exit;
    }
  }

  /**
   * Creates the excel worksheet from given parsed data invokes excel download.
   *
   * @param array $logs
   *   - The array Audit Log data.
   * @return array
   *   - The parsed Matterhorn Audit Log data
   */
  private function postProcessLogsData($logs) {
    $result = [];

    foreach ($logs as $key => $log) {
      $title = trim(trim($log->title), '>');
      $entity = unserialize($log->entity);

      // Switch case for Action Type
      switch (ucwords(str_replace('_', ' ', $log->action))) {
        case 'Update':
          // for non standard entities
          if (method_exists($entity, 'getOriginal')) {
            $original = $entity->getOriginal();
          } elseif (isset($entity->original)) {
            $original = $entity->original;
          } else {
            continue;
          }

          $compare = $this->generateCompareDiff($original, $entity);
        break;

        case 'Add':
          $compare = $this->generateCompareDiff([], $entity);
          break;

        case 'Delete':
          $compare = $this->generateCompareDiff($entity, []);
          break;

        default:
          // we do not know what type of action this is so we skip diff generation
          return;
      }

      $result[$key] = [
        'title' => $title,
        'type' => ucwords(str_replace('_', ' ', $log->type)),
        'action' => ucwords(str_replace('_', ' ', $log->action)),
        'user' => $log->name,
        'date' => \Drupal::service('date.formatter')->format($log->timestamp, 'short'),
        'language' => strtoupper($log->language),
        'entity_before' => $compare['before'],
        'entity_after' => $compare['after'],
      ];
    }

    return $result;
  }

  /**
   * Function for comparing entity difference of before and after values
   * @param array $before
   *   - The array entity before.
   * @param array $after
   *   - The array entity after.
   * @return array
   *   - The excel readable of entity before and after
   */
  private function generateCompareDiff($before, $after) {
    $map = [];
    $keyStr = [];
    $entity_before = '';
    $entity_after = '';

    $before = $this->getLineChangesFromEntity($before);
    $after = $this->getLineChangesFromEntity($after);

    $before_keys = array_keys($before);
    $after_keys = array_keys($after);

    $keys = array_replace($before_keys, $after_keys);

    // Create excel usable before and after entity change
    foreach ($keys as $key) {

      $before_key = "";
      $after_key = "";

      if (!empty($before[$key]) && !is_array($before[$key])) {
        $before_key = $before[$key];
      }

      if (!empty($after[$key]) && !is_array($after[$key])) {
        $after_key = $after[$key];
      }

      if (empty($entity_before)) {
        $entity_before = $key . ':' . "\n";
        $entity_before = $entity_before . '  -  ' . $before_key;
      } else {
        $entity_before = $entity_before . "\n" . $key . ':' . "\n" ;
        $entity_before = $entity_before . '  -  ' . $before_key;
      }

      if (empty($entity_after)) {
        $entity_after = $key . ':' . "\n";
        $entity_after = $entity_after . '  +  ' . $after_key;
      } else {
        $entity_after = $entity_after . "\n" . $key . ':' . "\n" ;
        $entity_after = $entity_after . '  +  ' . $after_key;
      }

    }

    $keyStr['before'] = $entity_before;
    $keyStr['after'] = $entity_after;

    return $keyStr;
  }

  /**
   * Function for parse usable value from array
   * @param array $entity
   *   - The array entity data.
   * @return array
   *   - The converted string value
   */
  private function getLineChangesFromEntity($entity) {
    $map = [];

    foreach ($entity as $key => $value) {
      if ($value instanceof TypedDataInterface) {
        $map[$value->getName()] = $value->getString();
      } elseif ($value instanceof EntityInterface) {
        $map[$key] = $this->getLineChangesFromEntity($value->toArray());
      } else {
        $map[$key] = $value;
      }
    }

    return $map;
  }

  /**
   * Function for setting Audit Log filters
   *
   * @param array $filters
   *   - The array entity data.
   */
  public function setAuditFilters($filters) {
    $this->filters = $filters;
  }
}
