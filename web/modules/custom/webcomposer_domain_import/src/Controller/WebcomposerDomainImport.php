<?php

namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\webcomposer_domain_import\Form\ImportForm;
use Drupal\file\Entity\File;
// use Drupal\webcomposer_domain_import\Parser\ImportParser;
// use Drupal\webcomposer_domain_import\Parser\ExcelParser;
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
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
   * [$ImportParser description]
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
   * [$ExcelParser description]
   * @var [type]
   */
  private $ExcelParser;

  /**
   * [__construct description]
   */
  public function __construct() {
      $this->ImportParser =  \Drupal::service('webcomposer_domain_import.import');
      $this->ExcelParser = \Drupal::service('webcomposer_domain_import.excel_parser');


  }
  
  /**
   * [ReadExcel description]
   * @param [type] $form_state [description]
   * @param [type] &$context   [description]
   */
  private function ReadExcel($form_state, &$context) {
    $message = 'Reading File...';
    $context['message'] = $message;
    $file_field = $form_state->getValue('import_file');
    $fid = $file_field[0];
    $uri = File::load($fid)->getFileUri();
    $realPath = drupal_realpath($uri);
    $sheets = $this->ExcelParser->read_excel($realPath);
    $context['sandbox'] = $sheets;
    
  }

  /**
   * [getExcelLanguages description]
   * @param  [type] $form_state [description]
   * @return [type]             [description]
   */
  public function getExcelLanguages($form_state) {
     $this->ReadExcel($form_state, $context);
     $this->ImportParser->setData($context['sandbox']);
    return $this->ImportParser->excel_get_languages();
  }
  
  /**
   * [ImportPrepare description]
   * @param [type] $form_state [description]
   * @param [type] &$context   [description]
   */
  public function ImportPrepare($form_state, &$context) {
    $message = 'Deleting existing Domains, Domains groups, Master Placeholders and realted Paragraphs...';
    $context['message'] = $message;

    $this->ReadExcel($form_state, $context);
    $this->ImportParser->setData($context['sandbox']);
    if($this->ImportParser->validate() === "EXCEL_FORMAT_OK") {  
      $this->DeleteParagraph();
      // Prepare all the vacabs for import
      $vid = [self::DOMAIN, self::DOMAIN_GROUP, self::MASTER_PLACEHOLDER];
      $this->TermDelete($vid);
    }
    else {
      ksm($this->ImportParser->validate());
      $message = t('An error occurred while processing %error_operation .', array('%error_operation' => $this->ImportParser->validate(), TRUE));
      drupal_set_message($message, 'error');
      $context['finished'] = 1;
    }
  }

  /**
   * [ImportDomainGroups description]
   * @param [type] $form_state [description]
   * @param [type] &$context   [description]
   */
  public  function ImportDomainGroups($form_state, &$context) {
    $message = 'Importing Domains Groups...';
    $context['message'] = $message;
    $this->ReadExcel($form_state, $context);
    $this->ImportParser->setData($context['sandbox']);
    $languages = $this->ImportParser->excel_get_languages();
    foreach ($languages as $key => $value) {
        $getPlaceholerVariables[$value] = $this->ImportParser->excel_get_variables($value);
    }
    foreach ($getPlaceholerVariables as $langcode => $term) { 
      foreach ($term as $value) {
        if($value['type'] === 'group') {
           $paragraphLists = array();
              foreach ($value['variables'] as $PlaceholderKey => $PlaceholderValue) {
                  if(!is_null($PlaceholderValue)) {
                    $paragraph = Paragraph::create([
                      'type' => 'domain_management_configuration',
                      'field_placeholder_key' => array(
                          "value"  =>  $PlaceholderKey,
                        ),
                      'field_default_value' => array(
                        "value" => $PlaceholderValue,
                        ),
                      'langcode' => array(
                        "value" => $langcode,
                        ),
                      ]);

                      $paragraph->save();
                      $paragraphLists[] = array(
                       'target_id' => $paragraph->id(),
                       'target_revision_id' => $paragraph->getRevisionId(),
                        ); 
                  }
              }
             $check = $this->readTaxonomyByName($value['name'] , $vocab);
             if(empty($check)) {
                $termItem = [
                  'name' => $value['name'],
                  'vid' => self::DOMAIN_GROUP,
                  'langcode' => $langcode,
                  'field_add_placeholder' => $paragraphLists,
                ];
              
                $termSave = Term::create($termItem)->save();
            }
            else {
              $TermLoad = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($check);
              if($langcode != 'en') {
                if(!$TermLoad->hasTranslation($langcode)) {
                   $TermLoad->addTranslation($langcode , [ 
                      'name' => $value['name'],
                      'field_add_placeholder' => $paragraphLists,
                    ])->save();
                }
              }
            }
          }
      }
    }
  //end of function 
  }

  /**
   * [ImportDomains description]
   * @param [type] $form_state [description]
   * @param [type] $langcode   [description]
   * @param [type] &$context   [description]
   */
  public function ImportDomains($form_state, $langcode, &$context) {
    $message = 'Importing Domains...';
    $context['message'] = $message;
    $this->ReadExcel($form_state, $context);
    $this->ImportParser->setData($context['sandbox']);
      $getPlaceholerVariables[$langcode] = $this->ImportParser->excel_get_variables($langcode);
      foreach ($getPlaceholerVariables as $langcode => $term) { 
          foreach ($term as $value) {
            if($value['type'] === 'group') {
               $group = $this->readTaxonomyByName($value['name'] , 'domain_groups');
            }
            
            if($value['type'] === 'domain') {
               $paragraphLists = array();
                  foreach ($value['variables'] as $PlaceholderKey => $PlaceholderValue) {
                      if(!is_null($PlaceholderValue)) {
                        $paragraph = Paragraph::create([
                          'type' => 'domain_management_configuration',
                          'field_placeholder_key' => array(
                              "value"  =>  $PlaceholderKey,
                            ),
                          'field_default_value' => array(
                            "value" => $PlaceholderValue,
                            ),
                          'langcode' => array(
                            "value" => $langcode,
                            ),
                          ]);

                          $paragraph->save();
                          $paragraphLists[] = array(
                           'target_id' => $paragraph->id(),
                           'target_revision_id' => $paragraph->getRevisionId(),
                            ); 
                      }
                  }
                $check = $this->readTaxonomyByName($value['name'] , $vocab);
                 if(empty($check)) {

                    $termItem = [
                      'name' => $value['name'],
                      'vid' => self::DOMAIN,
                      'langcode' => $langcode,
                      'field_add_placeholder' => $paragraphLists,
                      'field_select_domain_group' => $group
                    ];
                  
                    $termSave = Term::create($termItem)->save();
                   }
                  else {
                    $TermLoad = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($check);
                    if($langcode != 'en') {
                      if(!$TermLoad->hasTranslation($langcode)) {
                         $TermLoad->addTranslation($langcode , [ 
                            'name' => $value['name'],
                            'field_add_placeholder' => $paragraphLists,
                          ])->save();
                      }
                    }
                  }  
              }

          }
      }
      //end of function
      
  }

  /**
   * [ImportMasterPlaceholder description]
   * @param [type] $form_state [description]
   * @param [type] &$context   [description]
   */
  public function ImportMasterPlaceholder($form_state, &$context) {
    $message = 'Importing Master Placeholder...';
    $context['message'] = $message;
    $this->ReadExcel($form_state, $context);
    $this->ImportParser->setData($context['sandbox']);
       $getPlaceholerVariables = $this->ImportParser->excel_get_master_placeholder('en');
          foreach ($getPlaceholerVariables as $key => $value) {
            // code...
            if($key !== 'Tokens' && $value !== 'Default') {
             $paragraph = Paragraph::create([
                'type' => 'domain_management_configuration',
                'field_placeholder_key' => array(
                    "value"  =>  $key,
                  ),
                'field_default_value' => array(
                  "value" => $value,
                  ),
                'langcode' => array(
                  "value" => 'en',
                  ),
                ]);

                $paragraph->save();

             $check = $this->readTaxonomyByName($key , $vocab);
                 if(empty($check)) {

                    $termItem = [
                      'name' => $key,
                      'vid' => self::MASTER_PLACEHOLDER,
                      'langcode' => 'en',
                      'field_add_master_placeholder' => ['target_id' => $paragraph->id(), 'target_revision_id' => $paragraph->getRevisionId()]
                    ];
                    $termSave = Term::create($termItem)->save();
                   } 
              }
          }

  }

 /**
  * [readTaxonomyByName description]
  * @param  [type] $name  [description]
  * @param  [type] $vocab [description]
  * @return [type]        [description]
  */
  private function readTaxonomyByName($name, $vocab)
  {
    $termid = 0;
    $term_id =0;
    //Get tid of term with same name 
    $termid = db_query('SELECT n.tid FROM {taxonomy_term_field_data} n WHERE n.name  = :uid AND n.vid  = :vid', array(':uid' =>  $name, ':vid' => $vocab));
    foreach($termid as $val){
      $term_id = $val->tid; // get tid.
    } 
    return $term_id;

  }

 /**
  * [TermDelete description]
  * @param [type] $vid [description]
  */
  private function TermDelete($vid) {
    foreach ($vid as $key => $vocab) {
      $tids = \Drupal::entityQuery('taxonomy_term')
          ->condition('vid', $vocab)
         ->execute();
      entity_delete_multiple('taxonomy_term', $tids);
    }
  }

  /**
   * [createParagraph description]
   * @param  [type] $placeholderKey   [description]
   * @param  [type] $PlaceholderValue [description]
   * @return [type]                   [description]
   */
  private function DeleteParagraph() {
   $tables = ['paragraph__field_placeholder_key', 
    'paragraph__field_default_value', 
    'paragraph__field_description', 
    'paragraph_revision__field_default_value', 
    'paragraph_revision__field_description', 
    'paragraph_revision__field_placeholder_key'
  ]; 
    // delete the placeholder key, placeholder value and description tables
  // Before proceeding with import
    foreach ($tables as $table) { 
      \Drupal::database()->delete($table)
                ->condition('bundle', 'domain_management_configuration', '=')
                ->execute();
    }

    // Delete all entries from main paragraph tables for domain configs.
    
    $ParagraphTable = [
      'paragraphs_item',
      'paragraphs_item_field_data',
    ];

    foreach ($ParagraphTable as $table) { 
      \Drupal::database()->delete($table)
                ->condition('type', 'domain_management_configuration', '=')
                ->execute();
    }
   
  

  }

  /**
   * [DomainImportFinishedCallback description]
   */
  public static function DomainImportFinishedCallback() {
    drupal_set_message('Import complete.');
  }


}

