<?php

namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\webcomposer_domain_import\Form\ImportForm;
use Drupal\file\Entity\File;
use Drupal\webcomposer_domain_import\Parser\ImportParser;
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;

/**
 * Class WebcomposerDomainImport.
 *
 * @package Drupal\webcomposer_domain_import\Controller
 */
class WebcomposerDomainImport extends ControllerBase {

  const DOMAIN = 'domain';
  const DOMAIN_GROUP = 'domain_groups';

    public function content($form, $form_state) {
      // $operations = [];
      $operations[] = [WebcomposerDomainImport::class, 'DomainImport', [$form, $form_state]];
      // kint($operations);die();
     $batch = array(
      'title' => t('Import is in process...'),
      'operations' =>  [WebcomposerDomainImport::class, 'DomainImport', [$form, $form_state]],
  'init_message' => t('Smack Batch is starting.'),
  'progress_message' => t('Processed @current out of @total.'),
  'error_message' => t('Smack My Batch has encountered an error.'),
    );

    batch_set($batch);
    return batch_process('admin/config/webcomposer/domains/Import');
    }
  /**
   * Domain Import.
   *
   * @return string
   *   Return Hello string.
   */
  public static function DomainImport($form, $form_state) {
    // die();
    kint_require();
    ddd($form_state);
    $languages = [];
    $excel_parser = \Drupal::service('webcomposer_domain_import.excel_parser');
    $file_field = $form_state->getValue('import_file');
    $fid = $file_field[0];
    $uri = File::load($fid)->getFileUri();
    $realPath = drupal_realpath($uri);
    $sheets = $excel_parser->read_excel($realPath);
    $parser = new ImportParser($sheets);
    // if($parser->validate() === "EXCEL_FORMAT_OK") {  
      // Prepare all the vacabs for import
      $vid = [self::DOMAIN, self::DOMAIN_GROUP];
      $this->TermDelete($vid);
       // Save/Import Domain Group
      $this->createTaxonomyTerm(self::DOMAIN_GROUP, [], $parser, 'group');
      // $this->importDomains($parser->excel_get_domains(true), $parser);

  }

  private  function createTaxonomyTerm($vocab, $options, $parser, $type)
  {
    kint_require();
    $languages = $parser->excel_get_languages();
     foreach ($languages as $key => $value) {
            $getPlaceholerVariables[$value] = $parser->excel_get_variables($value);
        }
      foreach ($getPlaceholerVariables as $langcode => $term) { 
          foreach ($term as $value) {
            if($value['type'] === $type) {
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
                            "value" => 'en',
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
                      'vid' => $vocab,
                      'langcode' => 'en',
                      'field_add_placeholder' => $paragraphLists,
                    ];
                    if($value['type'] === $type && !empty($options)) {
                     // This will add custom fields
                      // d($options);
                        foreach ($options as $taxField => $taxValue) {
                          $termItem['field_select_domain_group'] = $taxValue['field_select_domain_group'];
                        }
                    }
                    $termSave = Term::create($termItem)->save();
                }
              }
                // done importing domain groups
              //start imorting domains





          }
      }
     
//end of function 
  }

  private function importDomains($domainLists, $parser)
  {
    $options = [];
    $test= [];
    foreach ($domainLists as $domainGroup => $domains) {

      $group = $this->readTaxonomyByName($domainGroup , 'domain_groups');
      // kint($domainGroup);die();
      $options[] = [
        'field_select_domain_group' => $group,
       
      ];
        $this->createTaxonomyTerm(self::DOMAIN, $options, $parser, 'domain');

    }
  }

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

  private function TermDelete($vid) {
    foreach ($vid as $key => $vocab) {
      $tids = \Drupal::entityQuery('taxonomy_term')
          ->condition('vid', $vocab)
         ->execute();
      entity_delete_multiple('taxonomy_term', $tids);
    }
  }

  private function ImportPlaceholderVariables($languages) {
    return $getPlaceholerVariables;
  }

  private function createParagraph($placeholderKey, $PlaceholderValue){
   $paragraph = Paragraph::create([
    'type' => 'domain_management_configuration',
    'field_placeholder_key' => array(
        "value"  =>  $PlaceholderKey,
      ),
    'field_default_value' => array(
      "value" => $PlaceholderValue,
      ),
    'langcode' => array(
      "value" => 'en',
      ),
    ]);

    $paragraph->save();
    $paragraphLists = array(
                         'target_id' => $paragraph->id(),
                         'target_revision_id' => $paragraph->getRevisionId(),
                          );

    return $paragraphLists;

  }
}

