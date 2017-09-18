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

  // public function __construct() {
  //     $this->import = new ImportParser();

  //   }

  /**
   * Domain Import.
   *
   * @return string
   *   Return Hello string.
   */
  public function DomainImport($form, $form_state) {
    kint_require();
    $languages = [];
    $excel_parser = \Drupal::service('webcomposer_domain_import.excel_parser');

    $file_field = $form_state->getValue('import_file');
    $fid = $file_field[0];

    $uri = File::load($fid)->getFileUri();
    $realPath = drupal_realpath($uri);

    $sheets = $excel_parser->read_excel($realPath);

    $parser = new ImportParser($sheets);
    // kint($import_parser_obj->validate());die(); 

    if($parser->validate() === "EXCEL_FORMAT_OK") {  
      // Prepare all the vacabs for import
      $vid = [self::DOMAIN, self::DOMAIN_GROUP];
      self::TermDelete($vid);
       // Save/Import Domain Group
      $excel_get_domain_groups = $parser->excel_get_domain_groups(true);
      self::createTaxonomyTerm($excel_get_domain_groups, self::DOMAIN_GROUP, []);

      // Save/Import Domains
      $excel_get_domains = $parser->excel_get_domains(true);
      self::importDomains($excel_get_domains);

      // Save the placeholder key and value w.r.t domain and groups
      $languages = $parser->excel_get_languages();
       foreach ($languages as $key => $value) {
        $getPlaceholerVariables[$value] = $parser->excel_get_variables($value);

      }
      // $a = self::ImportPlaceholderVariables($languages);
      ddd($getPlaceholerVariables);
      
    }
    else {
      drupal_set_message('Invalid file format. Please correct the file and re-import again.', 'error');
    }

  }

  // private static function getColumnLabel($test)
  // {
  //   $label = [];
  //   foreach ($import_parser_obj as $key => $value) {
  //     $label[$key] = $value;
  //   }
  //   return $label;
  // }

  private static function createTaxonomyTerm($terms, $vocab, $options)
  {
    foreach ($terms as $key => $name) {
      $term = self::readTaxonomyByName($name , $vocab);
      if(empty($term)) {

        $termItem = [
          'name' => $name, 
          'vid' => $vocab,
        ];

        // This will add custom fields
        if (!empty($options)) {
          foreach ($options as $taxField => $taxValue) {
            $termItem[$taxField] = $taxValue;
          }
        }
         $term = Term::create($termItem)->save();
    }
  }
  }

  private static function importDomains($domainLists)
  {
    $options = [];
    $test= [];
    foreach ($domainLists as $domainGroup => $domains) {

      $group = self::readTaxonomyByName($domainGroup , 'domain_groups');
      $options = [
        'field_select_domain_group' => $group,
      ];

      foreach ($domains as $key => $domain) {
        $test[$key] = $domain;
        self::createTaxonomyTerm($test, self::DOMAIN, $options);
      }

    }

  }

  private static function readTaxonomyByName($name, $vocab)
  {
    $termid = 0;
    $term_id =0;
    //Get tid of term with same name 
    $termid = db_query('SELECT n.tid FROM {taxonomy_term_field_data} n WHERE n.name  = :uid AND n.vid  = :vid', array(':uid' =>  $name, ':vid' => $vocab));
    foreach($termid as $val){
      $term_id = $val->tid; // get tid
    } 
    return $term_id;

  }

  private static function TermDelete($vid) {
    foreach ($vid as $key => $vocab) {
      $tids = \Drupal::entityQuery('taxonomy_term')
          ->condition('vid', $vocab)
         ->execute();
      entity_delete_multiple('taxonomy_term', $tids);
    }
      
  }

  private static function ImportPlaceholderVariables($languages) {
     

      return $getPlaceholerVariables;
  }
}

