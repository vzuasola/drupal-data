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
   * Database Service Object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

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
    if ($this->ImportParser->validate() === "EXCEL_FORMAT_OK") {
      $context['sandbox'] = $this->ImportParser->validate();

    }
    else {
      $context['sandbox'] = $this->ImportParser->validate();
    }

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

    $message = 'Deleting existing Domains, Domains groups, Master Placeholders and realted Paragraphs...';
    $context['message'] = $message;
    if ($context['sandbox'] === "EXCEL_FORMAT_OK") {
      $this->deleteParagraph();
      // Prepare all the vacabs for import.
      $vid = [self::DOMAIN, self::DOMAIN_GROUP, self::MASTER_PLACEHOLDER];
      $this->termDelete($vid);
    }
    else {
      // @todo fix the message on success as well.
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      drupal_set_message($message, 'error');
      $context['finished'] = 1;
    }
  }

  /**
   * Import Domain Groups.
   *
   * @param [Array] $form_state
   * @param [Array] &$context
   */
  public  function importDomainGroups($form_state, &$context) {

    $this->readExcel($form_state, $context);
    if ($context['sandbox'] === "EXCEL_FORMAT_OK") {
      $message = 'Importing Domains Groups...';
      $context['message'] = $message;
      $languages = $this->ImportParser->excel_get_languages();
      foreach ($languages as $key => $value) {
        $getPlaceholerVariables[$value] = $this->ImportParser->excel_get_variables($value);
      }
      foreach ($getPlaceholerVariables as $langcode => $term) {
        foreach ($term as $value) {
          if ($value['type'] === 'group') {
            $paragraphLists = [];
            foreach ($value['variables'] as $placeholderKey => $placeholderValue) {
              if (!is_null($placeholderValue)) {
                $paragraph = Paragraph::create(
                [
                  'type' => 'domain_management_configuration',
                  'field_placeholder_key' => [
                    "value"  => $placeholderKey,
                  ],
                  'field_default_value' => [
                    "value" => $placeholderValue,
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

            $check = $this->readTaxonomyByName($value['name'], self::DOMAIN_GROUP);
            if (empty($check)) {
              $termItem = [
                'name' => $value['name'],
                'vid' => self::DOMAIN_GROUP,
                'langcode' => $langcode,
                'field_add_placeholder' => $paragraphLists,
              ];

              $termSave = Term::create($termItem)->save();
            }
            else {
              $termLoad = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($check);
              if ($langcode != 'en') {
                if (!$termLoad->hasTranslation($langcode)) {
                  $termLoad->addTranslation(
                  $langcode, [
                    'name' => $value['name'],
                    'field_add_placeholder' => $paragraphLists,
                  ]
                    )->save();
                }
              }
            }
          }
        }
      }

    }
    else {
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      drupal_set_message($message, 'error');
      $context['finished'] = 1;
    }
    // End of function.
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
      $getPlaceholerVariables[$langcode] = $this->ImportParser->excel_get_variables($langcode);
      foreach ($getPlaceholerVariables as $langcode => $term) {
        foreach ($term as $value) {
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
                    "value"  => $placeholderKey,
                  ],
                  'field_default_value' => [
                    "value" => $placeholderValue,
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
            $check = $this->readTaxonomyByName($value['name'], self::DOMAIN);
            if (empty($check)) {

              $termItem = [
                'name' => $value['name'],
                'vid' => self::DOMAIN,
                'langcode' => $langcode,
                'field_add_placeholder' => $paragraphLists,
                'field_select_domain_group' => $group,
              ];

              $termSave = Term::create($termItem)->save();
            }
            else {
              $termLoad = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($check);
              if ($langcode != 'en') {
                if (!$termLoad->hasTranslation($langcode)) {
                  $termLoad->addTranslation(
                  $langcode, [
                    'name' => $value['name'],
                    'field_add_placeholder' => $paragraphLists,
                  ]
                    )->save();
                }
              }
            }
          }

        }
      }
    }
    else {
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      drupal_set_message($message, 'error');
      $context['finished'] = 1;
      // End of function.
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
      $getPlaceholerVariables = $this->ImportParser->excel_get_master_placeholder('en');
      foreach ($getPlaceholerVariables as $key => $value) {
        // code...
        if ($key !== 'Tokens' && $value !== 'Default') {
          $paragraph = Paragraph::create(
          [
            'type' => 'domain_management_configuration',
            'field_placeholder_key' => [
              "value"  => $key,
            ],
            'field_default_value' => [
              "value" => $value,
            ],
            'langcode' => [
              "value" => 'en',
            ],
          ]
            );

          $paragraph->save();

          $check = $this->readTaxonomyByName($key, self::MASTER_PLACEHOLDER);
          if (empty($check)) {

            $termItem = [
              'name' => $key,
              'vid' => self::MASTER_PLACEHOLDER,
              'langcode' => 'en',
              'field_add_master_placeholder' => ['target_id' => $paragraph->id(), 'target_revision_id' => $paragraph->getRevisionId()],
            ];
            $termSave = Term::create($termItem)->save();
          }
        }
      }
    }
    else {
      $message = t('An error occurred while processing %error_operation .', ['%error_operation' => $context['sandbox'], TRUE]);
      drupal_set_message($message, 'error');
      $context['finished'] = 1;
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
   * DomainImportFinishedCallback for Batch Process to end.
   */
  public static function domainImportFinishedCallback() {
    drupal_set_message('Import complete.');
  }

}
