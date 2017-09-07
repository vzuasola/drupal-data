<?php

namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;
use Parser\ExcelParser;

/**
 * Class WebcomposerDomainExport.
 *
 * @package Drupal\webcomposer_domain_import\Controller
 */
class WebcomposerDomainExport extends ControllerBase {

  // Variable for the all enabled languages.
  private $languages;

  // ExcelParser object.
  private $excal_parser;

  // Service for the export parser
  private $service;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->languages = \Drupal::languageManager()->getLanguages($flags = 1);
    $this->excal_parser = \Drupal::service('webcomposer_domain_import.excel_parser');
    $this->service = \Drupal::service('webcomposer_domain_import.export');
  }

  /**
   * Domain Export.
   *
   * @return string
   *   Return Hello string.
   */
  public function DomainExport() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: Export Successfull')
    ];
  }

  /**
   * Gets Matterhorn Domain data and invoke export excel operation
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   */
  public function domain_export_excel() {

    $export = new WebcomposerDomainExport();
    $data = $export->domain_export_get_parsed_data();
    $export->domain_export_create_excel($data);

      return;
  }

  /**
   * Gets data from Matterhorn Domain and parse it to PHP excel readable array
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @return array $result - the parsed Matterhorn Domain data
   *
   */
  public function domain_export_get_parsed_data() {
      $result = array();
      $language = array();
      $groups = $this->service->get_domain_groups();
      $domains = $this->service->get_domain_groups_with_domains();

      $placeholders = $this->service->get_domain_tokens();

      // Get all languages from which are enabled.
      foreach ($this->languages as $key => $value) {
        $language[$value->getId()] = $value->getName();
      }

      // Parse the languages in excel format.
      $result['languages'] = $this->service->excel_get_languages($language);

      $result['domains'] = $this->service->excel_get_domains($domains);

      $result['placeholders'] = $this->service->excel_get_placeholders_description($placeholders);
      foreach ($language as $key => $value) {
        // $list = $this->service->excel_get_domain_list($domains);
        $placeholders = $this->get_all_placeholders_per_language($key);
        // Get all the domain data per domain group per language.
        $variables = $this->get_all_domains_data_per_language($placeholders, $key);

        // $variables = $this->get_all_domain_variables($list, $key);
        // kint($variables);die;
        // $defaults = $this->service->get_domain_variables_default($key);

        // $result['variables'][$key] = $parser->excel_get_all_tokens($variables, $placeholders, $defaults);
        $result['variables'][$key] = $variables;
      }
      // kint($result);die;
      return $result;
  }

  /**
   * Creates the excel worksheet from the given parsed data
   * Invokes excel download
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param string $data - the parsed Matterhorn Domain data
   * @param array $excel_version - the excel version of the generated excel
   * @param boolean $headers - check if download will be invoked from browser
   * @param array $output - the URL to output the file
   *
   */
  public function domain_export_create_excel($data, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
      $language = array();
      // Get all languages from which are enabled.
      foreach ($this->languages as $key => $value) {
        $language[$key] = $value->getName();
      }

      // create new excel parser class instance
      // $excel = \Drupal::service('webcomposer_domain_import.excel_parser');
      // create languages worksheet
      $this->excal_parser->create_sheet($data['languages'], 'Languages');
      // create domains worksheet
      $this->excal_parser->create_sheet($data['domains'], 'Domains');
      // create token placeholder worksheet
      $this->excal_parser->create_sheet($data['placeholders'], 'Tokens');
      // create tokens worksheet per language
      foreach ( $language as $key => $language ) {
          $this->excal_parser->create_sheet($data['variables'][$key], $key);
      }
      // invoke excel creation and download
      $this->excal_parser->save('export.xlsx', $excel_version, $headers, $output);

      // stop script only if headers is set to invoke a download
      if ($headers) {
          exit;
      }
  }

  /**
   * Matterhorn Domain Export DB functions
   *
   */

  /**
   * Returns an array of all domains, where the index is the primary key `id` for domains temp table
   *
   * @return array $groups
   *
   */
  public function get_all_domains() {
    $domains = array();

    // Get all domains
    $domains = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('domain');

    foreach($domains as $domain){
        $groups[$domain->tid] = $domain->name;
    }

    return $groups;
  }

  /**
   * Get all the data per language.
   * @param  string $language language code.
   * @return array result     array of data.
   */
  // public function get_all_domains_per_language($domains, $language = 'en') {
  //   $domains_groups =
  // }

  public function get_all_placeholders_per_language($key) {
    $variables = array();
    $result = array();
    // Get the master placeholders
    $placeholders = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('master_placeholder');

    foreach ($placeholders as $value) {
      $token = taxonomy_term_load($value->tid);
        // kint($test);die;
      if ($token->hasTranslation($key)) {
        $paragraph = $token->get('field_add_master_placeholder')->getValue(false)[0]['target_id'];
        $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($paragraph);
        $filterTranslated = $paragraphs->getTranslation($key);
        $placeholder_key = $filterTranslated->field_placeholder_key->value;
        $placeholder_desc = $filterTranslated->field_default_value->value;
        // kint($placeholder_key);die;
        $variables[$placeholder_key] = $placeholder_desc;
      }
    }

    // check if property is empty
    $result['label']['group'] = 'Tokens';
    $result['default']['group'] = 'Default';

    // loop through the keys of the default values
    foreach ($variables as $key => $placeholder) {
      $result['label'][$key] = $key;
      $result['default'][$key] = $placeholder;
    }


    $result = $this->service->excel_filter_column($result);

    return $result;
  }

  public function get_all_domains_data_per_language($placeholders, $language) {
    // Domain all the domain groups
    $domains_groups = $this->service->get_domain_groups();

    // Get the domains for respective domain group.
    foreach ($domains_groups as $key => $value) {
      $group = taxonomy_term_load($key);
      if ($group->hasTranslation($language)) {
        // Get value of the field.
        $target_id = $group->get('field_add_placeholder')->getValue(false);

        // Check if the field is not empty.
        if (!empty($target_id)) {
          $paragraph = $group->get('field_add_placeholder')->getValue(false)[0]['target_id'];
          $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($paragraph);
          if ($paragraphs->hasTranslation($language)) {
            $filterTranslated = $paragraphs->getTranslation($language);
            $placeholder_key = $filterTranslated->field_placeholder_key->value;
            $placeholder_default = $filterTranslated->field_default_value->value;
            // Check if the values of the fields are not empty.
            if (!empty($placeholder_key) && !empty($placeholder_default)) {
              $group_placeholders[$value][$placeholder_key] = $placeholder_default;
            } else {
              $group_placeholders[$value] = NULL;
            }
          } else {
            $group_placeholders[$value] = NULL;
          }
        } else {
          $group_placeholders[$value] = NULL;
        }
      }
    }

    // kint($group_placeholders);die;
    foreach ($group_placeholders as $key => $value) {
      // check if property is empty
      $placeholders['group'][$key] = $key;
      foreach ($value as $holder => $default) {
        if (array_key_exists($holder, $placeholders)) {
          $placeholders[$holder][$key] = $default;
        } else {
          $placeholders[$holder] = $holder;
        }
      }
    }

    $group = $placeholders['group'];

    array_shift($placeholders);

     foreach ($group as $key => $value) {
      if (!array_key_exists($key, $result)) {
        $result[$key][] = $value;
      }
    }

    $i = 1;
    // kint($placeholders);die;
    // loop through the keys of the default values
    foreach ($placeholders as $key => $array) {
      foreach ($array as $k => $value) {
      if (array_key_exists($k, $result)) {
        $result[$k][$i] = $value;
      } else {
        $result[$k][$i] = NULL;
      }
    }
      $i++;
    }

    $result = array_values($result);

    // get the highest row number
    $count = 0;
    foreach ($result as $group) {
      $x = count($group);
      if ($count < $x) {
        $count = $x;
      }
    }

    // populate missing rows with nulls, so
     // that all columns will have the same number of rows
    for ($i = 0; $i < count($result); $i++) {
      for ($j = 0; $j < $count; $j++) {
        if (empty($result[$i][$j])) {
          $result[$i][$j] = NULL;
        }
      }
    }

    $result = $this->service->excel_filter_column($result);
    // kint($result);die;
    return $result;
  }
}
