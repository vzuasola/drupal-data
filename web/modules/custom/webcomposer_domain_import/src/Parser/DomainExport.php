<?php

namespace Drupal\webcomposer_domain_import\Parser;

/**
 * Class which handles domain export.
 */
class DomainExport {

  /**
   * Variable for the all enabled languages.
   *
   * @var languages
   */
  private $languages;

  /**
   * ExcelParser object.
   *
   * @var excelParser
   */
  private $excelParser;

  /**
   * Service for the export parser.
   *
   * @var service
   */
  private $service;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->languages = \Drupal::languageManager()->getLanguages($flags = 1);
    $this->excelParser = \Drupal::service('webcomposer_domain_import.excel_parser');
    $this->service = \Drupal::service('webcomposer_domain_import.export');
  }

  /**
   * Gets Matterhorn Domain data and invoke export excel operation.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   */
  public function domainExportExcel() {
    $data = $this->domainExportGetParsedData();
    $this->domainExportCreateExcel($data);
  }

  /**
   * Gets data from Matterhorn Domain and parse it to PHP excel readable array.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return array
   *   The parsed Matterhorn Domain data
   */
  public function domainExportGetParsedData() {
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
      $placeholders = $this->getAllPlaceholdersPerLanguage($key);
      // Get all the domain data per domain group per language.
      $variables = $this->getAllDomainsDataPerLanguage($placeholders, $key);
      $result['variables'][$key] = $variables;
    }

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
  public function domainExportCreateExcel($data, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
    $language = [];
    // Get all languages from which are enabled.
    foreach ($this->languages as $key => $value) {
      $language[$key] = $value->getName();
    }

    // Create languages worksheet.
    $this->excelParser->createSheet($data['languages'], 'Languages');
    // Create domains worksheet.
    $this->excelParser->createSheet($data['domains'], 'Domains');
    // Create token placeholder worksheet.
    $this->excelParser->createSheet($data['placeholders'], 'Tokens');
    // Create tokens worksheet per language.
    foreach ($language as $key => $language) {
      $this->excelParser->createSheet($data['variables'][$key], $key);
    }
    // Invoke excel creation and download.
    $this->excelParser->save('export.xlsx', $excel_version, $headers, $output);

    // Stop script only if headers is set to invoke a download.
    if ($headers) {
      exit;
    }
  }

  /**
   * Get all the data per language.
   *
   * @param string $key
   *   Language code.
   *
   * @return array
   *   Result array of data.
   */
  public function getAllPlaceholdersPerLanguage($key) {
    $variables = [];
    $result = [];
    // Get the master placeholders.
    $placeholders = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('master_placeholder');
    foreach ($placeholders as $value) {
      $token = taxonomy_term_load($value->tid);

      if ($token->hasTranslation($key)) {
        $getTranslation = $token->getTranslation($key);

        $paragraph = $getTranslation->get('field_add_master_placeholder')->getValue(FALSE)[0]['target_id'];
        $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($paragraph);
        if ($paragraphs->hasTranslation($key)) {
          $translated = $paragraphs->getTranslation($key);
          $placeholder_key = $translated->field_placeholder_key->value;
          $placeholder_desc = $translated->field_default_value->value;
          $variables[$placeholder_key] = $placeholder_desc;

        }

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
   *   Array of placeholders.
   * @param string $language
   *   Language code.
   *
   * @return array
   *   Result array of excelsheet.
   */
  public function getAllDomainsDataPerLanguage(array $placeholders, $language) {
    $variables = [];
    // Get all the domain groups.
    $domains_groups = $this->service->get_domain_groups();
    $domains = $this->service->get_domain();
    // Get the domains for respective domain group.
    foreach ($domains_groups as $key => $value) {
      $target_id = $this->service->get_add_placeholder_target_id($key, $language);
      // Check if the field is not empty.
      if (!empty($target_id)) {
        foreach ($target_id as $field) {
          $pid = $field['target_id'];
          $placeholder_key = $this->service->get_paragraph__field_placeholder_key($pid, $language);
          $placeholder_default = $this->service->get_paragraph__field_default_value($pid, $language);
          // Check if the values of the fields are not empty.
          if (!empty($placeholder_key) && !empty($placeholder_default)) {
            $group_placeholders[$value][$placeholder_key] = $placeholder_default;
          }
          else {
            $group_placeholders[$value] = NULL;
          }
        }
      }
      else {
        $group_placeholders[$value] = NULL;
      }
    }

    foreach ($domains as $domain_tid => $domain) {
      $group_domain = $this->service->get_domain_group_id($domain_tid);
      if (array_key_exists($group_domain, $domains_groups)) {
        $group_name = $domains_groups[$group_domain];
      }
      $field_placeholder = $this->service->get_add_placeholder_target_id($domain_tid, $language);
      if (!empty($field_placeholder)) {
        $domain_placeholer_array = [];
        foreach ($field_placeholder as $field) {

          $target_id = $field['target_id'];
          $placeholder_key = $this->service->get_paragraph__field_placeholder_key($target_id, $language);
          $placeholder_default = $this->service->get_paragraph__field_default_value($target_id, $language);
          $domain_placeholer_array[$placeholder_key] = $placeholder_default;
        }
        $domain_array[$group_name][$domain] = $domain_placeholer_array;
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
