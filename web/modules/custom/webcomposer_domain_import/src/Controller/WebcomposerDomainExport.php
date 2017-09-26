<?php

namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class WebcomposerDomainExport.
 *
 * @package Drupal\webcomposer_domain_import\Controller
 */
class WebcomposerDomainExport extends ControllerBase {

  /**
   * Variable for the all enabled languages.
   */
  private $languages;

  /**
   * ExcelParser object.
   */
  private $excal_parser;

  /**
   * Service for the export parser.
   */
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
      '#markup' => $this->t('Implement method: Export Successfull'),
    ];
  }

  /**
   * Gets Matterhorn Domain data and invoke export excel operation.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   */
  public function domain_export_excel() {

    $export = new WebcomposerDomainExport();
    $data = $export->domain_export_get_parsed_data();
    $export->domain_export_create_excel($data);

    return;
  }

  /**
   * Gets data from Matterhorn Domain and parse it to PHP excel readable array.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return array $result - the parsed Matterhorn Domain data
   */
  public function domain_export_get_parsed_data() {
    $result = [];
    $language = [];
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

      $result['variables'][$key] = $variables;
    }

    return $result;
  }

  /**
   * Creates the excel worksheet from the given parsed data
   * Invokes excel download.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param string $data
   *   - the parsed Matterhorn Domain data.
   * @param array $excel_version
   *   - the excel version of the generated excel.
   * @param bool $headers
   *   - check if download will be invoked from browser.
   * @param array $output
   *   - the URL to output the file.
   */
  public function domain_export_create_excel($data, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
    $language = [];
    // Get all languages from which are enabled.
    foreach ($this->languages as $key => $value) {
      $language[$key] = $value->getName();
    }

    // Create languages worksheet.
    $this->excal_parser->create_sheet($data['languages'], 'Languages');
    // Create domains worksheet.
    $this->excal_parser->create_sheet($data['domains'], 'Domains');
    // Create token placeholder worksheet.
    $this->excal_parser->create_sheet($data['placeholders'], 'Tokens');
    // Create tokens worksheet per language.
    foreach ($language as $key => $language) {
      $this->excal_parser->create_sheet($data['variables'][$key], $key);
    }
    // Invoke excel creation and download.
    $this->excal_parser->save('export.xlsx', $excel_version, $headers, $output);

    // Stop script only if headers is set to invoke a download.
    if ($headers) {
      exit;
    }
  }

  /**
   * Returns an array of all domains, where the index is the primary key `id` for domains temp table.
   *
   * @return array $groups
   */
  public function get_all_domains() {
    $domains = [];

    // Get all domains.
    $domains = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('domain');

    foreach ($domains as $domain) {
      $groups[$domain->tid] = $domain->name;
    }

    return $groups;
  }

  /**
   * Get all the data per language.
   *
   * @param string $language
   *   language code.
   *
   * @return array result     array of data.
   */
  public function get_all_placeholders_per_language($key) {
    $variables = [];
    $result = [];

    // Get the master placeholders.
    $placeholders = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('master_placeholder');

    foreach ($placeholders as $value) {
      $token = taxonomy_term_load($value->tid);

      if ($token->hasTranslation($key)) {
        $paragraph = $token->get('field_add_master_placeholder')->getValue(FALSE)[0]['target_id'];
        $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($paragraph);
        $translated = $paragraphs->getTranslation($key);
        $placeholder_key = $translated->field_placeholder_key->value;
        $placeholder_desc = $translated->field_default_value->value;

        $variables[$placeholder_key] = $placeholder_desc;
      }
    }

    // Check if property is empty.
    $result['label']['group'] = 'Tokens';
    $result['default']['group'] = 'Default';

    // Loop through the keys of the default values.
    foreach ($variables as $key => $placeholder) {
      $result['label'][$key] = $key;
      $result['default'][$key] = $placeholder;
    }

    $result = $this->service->excel_filter_column($result);

    return $result;
  }

  /**
   * Get the all structured data for the ecxel.
   *
   * @param array $placeholders
   *   array of placeholders.
   * @param string $language
   *   language code.
   *
   * @return array               result array of excelsheet.
   */
  public function get_all_domains_data_per_language($placeholders, $language) {
    $variables = [];

    // Get all the domain groups.
    $domains_groups = $this->service->get_domain_groups();

    // Get all the domains.
    $domains = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('domain');

    // Get the domains for respective domain group.
    foreach ($domains_groups as $key => $value) {
      $group = taxonomy_term_load($key);
      if ($group->hasTranslation($language)) {
        // Get value of the field.
        $target_id = $group->get('field_add_placeholder')->getValue(FALSE);

        // Check if the field is not empty.
        if (!empty($target_id)) {
          $paragraph = $group->get('field_add_placeholder')->getValue(FALSE)[0]['target_id'];
          $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($paragraph);
          if ($paragraphs->hasTranslation($language)) {
            $translated = $paragraphs->getTranslation($language);
            $placeholder_key = $translated->field_placeholder_key->value;
            $placeholder_default = $translated->field_default_value->value;
            // Check if the values of the fields are not empty.
            if (!empty($placeholder_key) && !empty($placeholder_default)) {
              $group_placeholders[$value][$placeholder_key] = $placeholder_default;
            }
            else {
              $group_placeholders[$value] = NULL;
            }
          }
          else {
            $group_placeholders[$value] = NULL;
          }
        }
        else {
          $group_placeholders[$value] = NULL;
        }
      }
    }

    foreach ($domains as $domain) {

      $domain_data = taxonomy_term_load($domain->tid);
      $group_domain = $domain_data->get('field_select_domain_group')->getValue(FALSE)[0]['target_id'];

      $group_name = taxonomy_term_load($group_domain)->getName();

      if ($domain_data->hasTranslation($language)) {
        // Get value of the field.
        $field_placeholder = $domain_data->get('field_add_placeholder')->getValue(FALSE);
        if (!empty($field_placeholder)) {
          $bal = 0;
          foreach ($field_placeholder as $key => $field) {

            $target_id = $field['target_id'];
            $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($target_id);

            if ($paragraphs->hasTranslation($language)) {
              $translated = $paragraphs->getTranslation($language);
              $placeholder_key = $translated->field_placeholder_key->value;
              $placeholder_default = $translated->field_default_value->value;
              $domain_placeholer_array[$placeholder_key] = $placeholder_default;
            }
          }
          $domain_array[$group_name][$domain->name] = $domain_placeholer_array;
        }
      }
    }

    foreach ($group_placeholders as $key => $value) {
      $variables[$key] = $value;
      foreach ($domain_array as $domain => $data) {
        if (array_key_exists($domain, $group_placeholders)) {
          foreach ($data as $name => $default) {
            if ($key === $domain) {
              $variables[$name] = $default;
            }
          }
        }
      }
    }

    foreach ($variables as $key => $value) {
      // Check if property is empty.
      $placeholders['group'][$key] = $key;
      if (is_array($value)) {
        foreach ($value as $holder => $default) {
          if (array_key_exists($holder, $placeholders)) {
            $placeholders[$holder][$key] = $default;
          }
          else {
            $placeholders[$holder]['label'] = $holder;
            $placeholders[$holder]['default'] = $default;
            $placeholders[$holder][$key] = $default;
          }
        }
      }
    }

    $group = $placeholders['group'];

    array_shift($placeholders);
    $result = [];
    foreach ($group as $key => $value) {
      if (!array_key_exists($key, $result)) {
        $result[$key][] = $value;
      }
    }

    // Loop through the keys of the default values.
    $i = 1;

    foreach ($placeholders as $key => $array) {
      foreach ($array as $k => $value) {
        if (array_key_exists($k, $result)) {
          $result[$k][$i] = $value;
        }
        else {
          $result[$k][$i] = NULL;
        }
      }
      $i++;
    }

    $result = array_values($result);

    // Get the highest row number.
    $count = 0;
    foreach ($result as $group) {
      $x = count($group);
      if ($count < $x) {
        $count = $x;
      }
    }

    // Populate missing rows with nulls, so
    // that all columns will have the same number of rows.
    for ($i = 0; $i < count($result); $i++) {
      for ($j = 0; $j < $count; $j++) {
        if (empty($result[$i][$j])) {
          $result[$i][$j] = NULL;
        }
      }
    }

    $result = $this->service->excel_filter_column($result);

    return $result;
  }

}
