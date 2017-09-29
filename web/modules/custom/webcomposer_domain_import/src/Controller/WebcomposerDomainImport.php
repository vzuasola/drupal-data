<?php

namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
// Use Drupal\webcomposer_domain_import\Parser\ImportParser;
// use Drupal\webcomposer_domain_import\Parser\ExcelParser;.
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\Database\Database;

/**
 * Class WebcomposerDomainImport.
 *
 * @package Drupal\webcomposer_domain_import\Controller
 */
class WebcomposerDomainImport extends ControllerBase {

  const DOMAIN = 'domain';
  const DOMAIN_GROUP = 'domain_groups';
  const MASTER_PLACEHOLDER = 'master_placeholder';

  /**
   * Import parser Object.
   *
   * @var [type]
   */
  private $ImportParser;

  /**
   * ExcelParser Object.
   *
   * @var [type]
   */
  private $ExcelParser;

  /**
   * Construct Class Contructor.
   */
  public function __construct() {
    $this->ImportParser = \Drupal::service('webcomposer_domain_import.import');
    $this->ExcelParser = \Drupal::service('webcomposer_domain_import.excel_parser');

  }

  /**
   * ReadExcel Reads the file and check the validation.
   *
   * @param [Array] $form_state
   * @param [Array] &$context
   */
  private function readExcel($form_state, &$context) {
    $message = 'Reading File...';
    $context['message'] = $message;
    $file_field = $form_state->getValue('import_file');
    $fid = $file_field[0];
    $uri = File::load($fid)->getFileUri();
    $realPath = drupal_realpath($uri);
    $sheets = $this->ExcelParser->read_excel($realPath);
    $this->ImportParser->setData($sheets);
    $context['sandbox'] = $this->ImportParser->validate();
  }

  /**
   * Get all the languages from sheet.
   *
   * @param [array] $form_state
   */
  public function getExcelLanguages($form_state) {
    $this->readExcel($form_state, $context);
    return $this->ImportParser->excel_get_languages();
  }

  /**
   * Preparing the Import.
   *
   * @param [Array] $form_state
   * @param [Array] &$context
   */
  public function importPrepare($form_state, &$context) {
    $this->readExcel($form_state, $context);

    if ($context['sandbox'] === "EXCEL_FORMAT_OK") {
      $message = 'Deleting existing Domains, Domains groups, Master Placeholders and related Paragraphs...';
      $context['message'] = $message;
      $this->deleteParagraph();
      // Prepare all the vacabs for import.
      $vid = [self::DOMAIN, self::DOMAIN_GROUP, self::MASTER_PLACEHOLDER];
      $this->termDelete($vid);
    }
    else {
      $context['finished'] = 1;
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox']]);
      $status = drupal_set_message($message, 'error');
      $this->domainImportErrorCallback($status);

    }
  }

  /**
   * Import Domain Groups.
   *
   * @param [Array] $form_state
   * @param [Array] &$context
   */
  public  function importDomainGroups($form_state, $langcode, &$context) {

    $this->readExcel($form_state, $context);
    if ($context['sandbox'] === "EXCEL_FORMAT_OK") {
      $message = 'Importing Domains Groups...';
      $context['message'] = $message;
      $getPlaceholerVariables = $this->ImportParser->excel_get_variables($langcode);
      foreach ($getPlaceholerVariables as $value) {
        if ($value['type'] === 'group') {
          $paragraphLists = [];
          foreach ($value['variables'] as $placeholderKey => $placeholderValue) {
            if (!is_null($placeholderValue)) {
              $paragraph = Paragraph::create(
              [
                'type' => 'domain_management_configuration',
                'field_placeholder_key' => [
                  "value"  => trim($placeholderKey),
                ],
                'field_default_value' => [
                  "value" => trim($placeholderValue),
                ],
                'langcode' => [
                  "value" => $langcode,
                ],
              ]
              );

              $paragraph->save();
              $paragraphLists[] = [
                'target_id' => $paragraph->id(),
                'target_revision_id' => $paragraph->getRevisionId(),
              ];
            }
          }

          $tid = $this->readTaxonomyByName($value['name'], self::DOMAIN_GROUP);
          if (empty($tid)) {
            $termItem = [
              'name' => trim($value['name']),
              'vid' => self::DOMAIN_GROUP,
              'langcode' => $langcode,
              'field_add_placeholder' => $paragraphLists,
            ];

            $termSave = Term::create($termItem)->save();
          }
          else {
            $translationStack = [
              'table' => 'taxonomy_term_field_data',
              'tid' => $tid,
              'vid' => self::DOMAIN_GROUP,
              'langcode' => $langcode,
              'name' => trim($value['name']),
            ];
            $this->insertTermTranslation($translationStack);
            foreach ($paragraphLists as $key => $value) {
              $referencedStack = [
                'table' => 'taxonomy_term__field_add_placeholder',
                'bundle' => self::DOMAIN_GROUP,
                'tid' => $tid,
                'langcode' => $langcode,
                'key' => $key,
                'target_id' => $value['target_id'],
                'target_revision_id' => $value['target_revision_id'],
                'column_target_id' => 'field_add_placeholder_target_id',
                'column_target_revision_id' => 'field_add_placeholder_target_revision_id',
              ];

              $this->insertParagraphReferenceTranslation($referencedStack);
            }

          }
        }
      }

    }
    else {
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      $context['finished'] = 1;
      $status = drupal_set_message($message, 'error');
      $this->domainImportErrorCallback($status);
    }

  }

  /**
   * Import Domains.
   *
   * @param [Array] $form_state
   * @param [Array] &$context
   * @param [type] $langcode
   */
  public function importDomains($form_state, $langcode, &$context) {
    $this->readExcel($form_state, $context);
    if ($context['sandbox'] === "EXCEL_FORMAT_OK") {
      $message = 'Importing Domains...';
      $context['message'] = $message;
      $getPlaceholerVariables = $this->ImportParser->excel_get_variables($langcode);
      foreach ($getPlaceholerVariables as $value) {
        if ($value['type'] === 'group') {
          $group = $this->readTaxonomyByName($value['name'], 'domain_groups');
        }

        if ($value['type'] === 'domain') {
          $paragraphLists = [];
          foreach ($value['variables'] as $placeholderKey => $placeholderValue) {
            if (!is_null($placeholderValue)) {
              $paragraph = Paragraph::create(
              [
                'type' => 'domain_management_configuration',
                'field_placeholder_key' => [
                  "value"  => trim($placeholderKey),
                ],
                'field_default_value' => [
                  "value" => trim($placeholderValue),
                ],
                'langcode' => [
                  "value" => $langcode,
                ],
              ]
              );

              $paragraph->save();
              $paragraphLists[] = [
                'target_id' => $paragraph->id(),
                'target_revision_id' => $paragraph->getRevisionId(),
              ];
            }
          }
          $tid = $this->readTaxonomyByName($value['name'], self::DOMAIN);
          if (empty($tid)) {
            $termItem = [
              'name' => trim($value['name']),
              'vid' => self::DOMAIN,
              'langcode' => $langcode,
              'field_add_placeholder' => $paragraphLists,
              'field_select_domain_group' => $group,
            ];

            $termSave = Term::create($termItem)->save();
          }
          else {
            $translationStack = [
              'table' => 'taxonomy_term_field_data',
              'tid' => $tid,
              'vid' => self::DOMAIN,
              'langcode' => $langcode,
              'name' => trim($value['name']),
            ];
            $this->insertTermTranslation($translationStack);
            foreach ($paragraphLists as $key => $value) {
              $referencedStack = [
                'table' => 'taxonomy_term__field_add_placeholder',
                'bundle' => self::DOMAIN,
                'tid' => $tid,
                'langcode' => $langcode,
                'key' => $key,
                'target_id' => $value['target_id'],
                'target_revision_id' => $value['target_revision_id'],
                'column_target_id' => 'field_add_placeholder_target_id',
                'column_target_revision_id' => 'field_add_placeholder_target_revision_id',
              ];

              $this->insertParagraphReferenceTranslation($referencedStack);
            }

          }
        }

      }
      $this->domainImportFinishedCallback();
    }
    else {
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      $context['finished'] = 1;
      $status = drupal_set_message($message, 'error');
      $this->domainImportErrorCallback($status);
    }
  }

  /**
   * ImportMasterPlaceholder.
   *
   * @param [Array] $form_state
   * @param [Array] &$context
   */
  public function importMasterPlaceholder($form_state, &$context) {
    $this->readExcel($form_state, $context);
    if ($context['sandbox'] === "EXCEL_FORMAT_OK") {
      $message = 'Importing Master Placeholder...';
      $context['message'] = $message;
      $languages = $this->ImportParser->excel_get_languages();
      foreach ($languages as $key => $value) {
        $getPlaceholerVariables[$value] = $this->ImportParser->excel_get_master_placeholder($value);
      }
      foreach ($getPlaceholerVariables as $langcode => $term) {
        $paragraphLists = [];
        $termName = [];
        foreach ($term as $key => $value) {
          $paragraph = Paragraph::create(
          [
            'type' => 'domain_management_configuration',
            'field_placeholder_key' => [
              "value"  => trim($key),
            ],
            'field_default_value' => [
              "value" => trim($value),
            ],
            'langcode' => [
              "value" => $langcode,
            ],
          ]
            );

          $paragraph->save();
          $paragraphLists[] = [
            'target_id' => $paragraph->id(),
            'target_revision_id' => $paragraph->getRevisionId(),
          ];
          $termName[] = $key;
        }
        foreach ($termName as $key => $value) {
          $tid = $this->readTaxonomyByName($value, self::MASTER_PLACEHOLDER);
          if (empty($tid)) {
            $termItem = [
              'name' => trim($value),
              'vid' => self::MASTER_PLACEHOLDER,
              'langcode' => $langcode,
              'field_add_master_placeholder' => [
                'target_id' => $paragraphLists[$key]['target_id'],
                'target_revision_id' => $paragraphLists[$key]['target_revision_id'],
              ],
            ];
            $termSave = Term::create($termItem)->save();
          }
          else {
            $translationStack = [
              'table' => 'taxonomy_term_field_data',
              'tid' => $tid,
              'vid' => self::MASTER_PLACEHOLDER,
              'langcode' => $langcode,
              'name' => trim($value),
            ];
            $this->insertTermTranslation($translationStack);

            $referencedStack = [
              'table' => 'taxonomy_term__field_add_master_placeholder',
              'bundle' => self::MASTER_PLACEHOLDER,
              'tid' => $tid,
              'langcode' => $langcode,
              'key' => $key,
              'target_id' => $paragraphLists[$key]['target_id'],
              'target_revision_id' => $paragraphLists[$key]['target_revision_id'],
              'column_target_id' => 'field_add_master_placeholder_target_id',
              'column_target_revision_id' => 'field_add_master_placeholder_target_revision_id',
            ];

            $this->insertParagraphReferenceTranslation($referencedStack);
          }
        }

      }
    }
    else {
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      $context['finished'] = 1;
      $status = drupal_set_message($message, 'error');
      $this->domainImportErrorCallback($status);
    }
  }

  /**
   * ReadTaxonomyByName.
   *
   * @param [string] $name
   * @param [string] $vocab
   *
   * @return [interger]
   *   $term_id
   */
  private function readTaxonomyByName($name, $vocab) {
    $termid = 0;
    $term_id = 0;
    // Get tid of term with same name.
    $termid = db_query('SELECT n.tid FROM {taxonomy_term_field_data} n WHERE n.name  = :uid AND n.vid  = :vid', [':uid' => $name, ':vid' => $vocab]);
    foreach ($termid as $val) {
      // Get tid.
      $term_id = $val->tid;
    }
    return $term_id;

  }

  /**
   * InsertTermTranslation Adds the translation of taxonomy term.
   *
   * @param [array] $param
   *   stack of table column values.
   */
  private function insertTermTranslation($param) {
    $query = \Drupal::database()->insert($param['table']);
    $query->fields(['tid',
      'vid',
      'langcode',
      'name',
      'weight',
      'changed',
      'default_langcode',
      'content_translation_source',
      'content_translation_outdated',
      'content_translation_status',
      'content_translation_created',
    ]);
    $query->values([$param['tid'], $param['vid'], $param['langcode'], $param['name'], 20, strtotime(date('m/d/y H:i:s')), 0, 'und', 0, 1, strtotime(date('m/d/y H:i:s'))]);
    $query->execute();

  }

  /**
   * InsertParagraphReferenceTranslation Insert the translated paragraph with taxonomy.
   *
   * @param [array] $param
   *   stack of table column values.
   */
  private function insertParagraphReferenceTranslation($param) {
    $query = \Drupal::database()->insert($param['table']);
    $query->fields(['bundle',
      'deleted',
      'entity_id',
      'revision_id',
      'langcode',
      'delta',
      $param['column_target_id'],
      $param['column_target_revision_id'],
    ]);
    $query->values([$param['bundle'], 0, $param['tid'], $param['tid'], $param['langcode'], $param['key'], $param['target_id'], $param['target_revision_id']]);
    $query->execute();
  }

  /**
   * TermDelete.
   *
   * @param [string] $vid
   */
  private function termDelete($vid) {
    foreach ($vid as $key => $vocab) {
      $tids = \Drupal::entityQuery('taxonomy_term')
        ->condition('vid', $vocab)
        ->execute();
      entity_delete_multiple('taxonomy_term', $tids);
    }
  }

  /**
   * DeleteParagraph.
   */
  private function deleteParagraph() {
    $tables = ['paragraph__field_placeholder_key',
      'paragraph__field_default_value',
      'paragraph__field_description',
      'paragraph_revision__field_default_value',
      'paragraph_revision__field_description',
      'paragraph_revision__field_placeholder_key',
    ];
    // Delete the placeholder key, placeholder value and description tables
    // Before proceeding with import.
    foreach ($tables as $table) {
      \Drupal::database()->delete($table)
        ->condition('bundle', 'domain_management_configuration', '=')
        ->execute();
    }

    // Delete all entries from main paragraph tables for domain configs.
    $paragraphTable = [
      'paragraphs_item',
      'paragraphs_item_field_data',
    ];

    foreach ($paragraphTable as $table) {
      \Drupal::database()->delete($table)
        ->condition('type', 'domain_management_configuration', '=')
        ->execute();
    }

  }

  /**
   * DomainImportErrorCallback for Batch Process to end.
   */
  public function domainImportErrorCallback($status) {
    return $status;
  }

  /**
   * DomainImportFinishedCallback for Batch Process to end.
   */
  public function domainImportFinishedCallback() {
    drupal_set_message(t('Import successfully Completed!'), 'status');
  }

}
