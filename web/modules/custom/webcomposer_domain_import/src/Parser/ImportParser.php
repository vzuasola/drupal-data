<?php

namespace Drupal\webcomposer_domain_import\Parser;

/**
 * Class for parsing PHP excel array object.
 *
 * @package Matterhorn Domains
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 */
class ImportParser {

  /**
   * Container for excel data.
   */
  private $rows = [];

  // Container variables for storing processed data.
  /**
   * On this class, we used these properties as cache storage.
   */
  private $columns = [];
  private $groups = [];
  private $domains = [];
  private $list = [];
  private $languages = [];
  private $placeholders = [];
  private $variables = [];

  /**
   * Constructor function
   * Passing the excel object to the class instance.
   *
   * @param array $rows
   *   - the phpexcel array object.
   */
  public function setData($rows) {
    return $this->rows = $rows;

  }

  /**
   * Function to process all data at once
   * Calling this function will tell the parser to process all data and store it in its cache.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   */
  public function process_cache() {
    // Parse data.
    $this->excel_get_languages();
    $this->excel_get_domain_groups();
    $this->excel_get_domains();
    // Parse language dependent data.
    foreach ($this->languages as $index) {
      $this->excel_get_placeholders($index);
      $this->excel_filter_column($index);
      $this->excel_get_variables($index);
    }
  }

  /**
   * Gets the data inside the cache storage.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return array $cache
   */
  public function get_cache() {
    if (empty($this->columns)) {
      $this->process_cache();
    }

    $cache = [];

    $cache['columns'] = $this->columns;
    $cache['domains'] = $this->domains;
    $cache['groups'] = $this->groups;
    $cache['list'] = $this->list;
    $cache['languages'] = $this->languages;
    $cache['placeholders'] = $this->variables;
    $cache['variables'] = $this->variables;

    return $cache;
  }

  /**
   * Validates the data of the excel file.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  public function validate() {
    $validate = [];

    $validate[] = $this->validate_labels();
    $validate[] = $this->validate_domain_labels();
    $validate[] = $this->validate_main_format();
    // $validate[] = $this->validate_domain_format();
    // Need to correct the export.
    // $validate[] = $this->validate_domain_consistency();
    // Correct the export.
    $validate[] = $this->validate_domain_duplicates();
    // $validate[] = $this->validate_tokens_duplicates();
    foreach ($validate as $code) {
      if ($code !== 'VALIDATE_OK') {
        return $code;
      }
    }

    return 'EXCEL_FORMAT_OK';
  }

  /**
   * Converts the row based assoc array of phpexcel to column based format
   * by default phpexcel arrays are grouped by indeces of rows, this will convert them to indeces of columns.
   *
   * Row based: Row 1 => column 1, column 2, column 3
   * Column based: Column 1 => row 1, row 2, row 3
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   *
   * @return array $result
   */
  public function excel_filter_column($index, $caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->columns[$index]) && $caching == TRUE) {
      return $this->columns[$index];
    }

    // Reformat array to column based format.
    foreach ($this->rows[$index] as $row_key => $row_data) {
      $row_data = array_values($row_data);
      foreach ($row_data as $column_key => $column_data) {
        $this->columns[$index][$column_key][$row_key] = $column_data;
      }
    }

    return $this->columns[$index];
  }

  /**
   * Gets all available languages from the excel object.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   *
   * @return array $result
   */
  public function excel_get_languages($caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->languages) && $caching == TRUE) {
      return $this->languages;
    }

    $columns = $this->excel_filter_column('Languages');
    $columns = $columns[0];

    // Put each language in result array.
    foreach ($columns as $column_data) {
      $this->languages[] = $column_data;
    }

    // Unset label as part of language group.
    $this->languages = array_values($this->languages);
    unset($this->languages[0]);

    return $this->languages;
  }

  /**
   * Get the domain groups from the excel object
   * Returns a one dimension array of domain groups.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   *
   * @return array $result
   */
  public function excel_get_domain_groups($caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->groups) && $caching == TRUE) {
      return $this->groups;
    }

    $result = [];

    $groups = $this->rows['Domains'];
    $groups = array_values($groups);
    $groups = $groups[0];

    // Id should start at 1.
    $k = 1;
    foreach ($groups as $key => $name) {
      // Ignore empty values.
      if (!empty($name)) {
        $result[$k] = $name;
        $k++;
      }
    }
    // Store result to cache.
    $this->groups = $result;

    return $this->groups;
  }

  /**
   * Gets the domains per domain group from the phpexcel object
   * Output format: Domain Group 1 => domain 1, domain 2, domain 3.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   *
   * @return array $result
   */
  public function excel_get_domains($caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->domains) && $caching == TRUE) {
      return $this->domains;
    }

    $columns = $this->excel_filter_column('Domains');

    // Reformat array to domains per domain group.
    foreach ($columns as $column_data) {

      $column_data = array_values($column_data);

      // Skip the loop if the domain is empty.
      if (empty($column_data[0])) {
        continue;
      }
      // Populate domain list property.
      $this->list = array_merge_recursive($this->list, array_filter($column_data));
      // Populate domains property.
      $this->domains[$column_data[0]] = array_filter($column_data);
    }

    // Unset domain group as part of domain collection.
    foreach ($this->domains as $key => $result_data) {
      $this->domains[$key] = array_values($result_data);
      unset($this->domains[$key][0]);
    }

    return $this->domains;
  }

  /**
   * Gets the placeholders and its respective default value from the phpexcel object per language.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   * @param array $language
   *   - the language of the token to fetch.
   *
   * @return result
   */
  public function excel_get_placeholders($language, $caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->placeholders[$language]) && $caching == TRUE) {
      return $this->placeholders[$language];
    }

    $descriptions = $this->excel_filter_column('Tokens');
    $columns = $this->excel_filter_column($language);

    // Tokens are always on column A.
    $tokens = array_values($columns[0]);
    // Default values are always on column B.
    $default = array_values($columns[1]);
    $description = array_values($descriptions[1]);

    // No default value has been set, return false instead.
    if ($default[0] != 'default') {
      return FALSE;
    }

    // Unset the label as part of the placeholder collection.
    unset($default[0]);
    unset($tokens[0]);

    // Reformat array to placeholder => value.
    foreach ($tokens as $key => $token) {
      // Skip loop if token is NULL.
      if (!isset($token)) {
        continue;
      }

      $this->placeholders[$language][$token]['name'] = $default[$key];
      $this->placeholders[$language][$token]['description'] = $description[$key];
    }

    return $this->placeholders[$language];
  }

  /**
   * Gets all the contents of the placeholder of all domains of a specified language.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   *
   * @return array $result
   */
  public function excel_get_variables($language, $caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->variables[$language]) && $caching == TRUE) {
      return $this->variables[$language];
    }

    $columns = $this->excel_filter_column($language);

    $row = array_values($this->rows[$language]);
    $domains = $row[0];
    $domains = array_values($domains);

    // Unset label as part of the domain list.
    unset($domains[0]);
    unset($domains[1]);

    // Get variables per domain.
    foreach ($domains as $key => $domain) {
      // Skip the loop if the domain is empty.
      if (empty($domain)) {
        continue;
      }

      $this->variables[$language][$domain]['name'] = $domain;
      $this->variables[$language][$domain]['type'] = $this->excel_get_domain_type($domain);

      $columns[0] = array_values($columns[0]);
      $columns[$key] = array_values($columns[$key]);

      // Unset label as part of domain tokens.
      unset($columns[$key][0]);

      // Reformat to domain => variable 1, variable 2, variable 3.
      foreach ($columns[$key] as $k => $value) {
        $this->variables[$language][$domain]['variables'][$columns[0][$k]] = $value;
      }
    }

    return $this->variables[$language];
  }

  /**
   * Private helper functions.
   */

  /**
   * Determine whether a given domain name is a group or simply a domain.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $name
   *   - the name of the domain.
   *
   * @return string
   */
  private function excel_get_domain_type($name) {
    $groups = $this->excel_get_domain_groups();

    if (in_array($name, $groups)) {
      return 'group';
    }

    return 'domain';
  }

  /**
   * Gets the domain group of a specified domain name.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $name
   *   - the name of the domain.
   *
   * @return array $result
   */
  private function excel_get_domain_group_by_domain($name) {
    $columns = $this->excel_filter_column('Domains');

    foreach ($columns as $column_data) {
      foreach ($column_data as $domain) {
        if ($name == $domain) {
          return $column_data[1];
        }
      }
    }

    return FALSE;
  }

  /**
   * Private validation functions.
   */

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_labels() {
    $cache = $this->get_cache();

    $language_label = NULL;
    $token_label = NULL;
    $token_description = NULL;

    if (isset($cache['columns']['Languages'][0][1])) {
      $language_label = $cache['columns']['Languages'][0][1];
    }

    if (isset($cache['columns']['Tokens'][0][1])) {
      $token_label = $cache['columns']['Tokens'][0][1];
    }

    // Check excel labels.
    if (!$language_label || !$token_label) {
      return 'EXCEL_IMPROPER_FORMAT_LABELS';
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_domain_labels() {
    $cache = $this->get_cache();

    foreach ($this->languages as $language) {

      $token = $cache['columns'][$language][0][1];
      $description = $cache['columns'][$language][1][1];

      if (strtolower($token) !== 'tokens' || strtolower($description) !== 'default') {
        return 'EXCEL_IMPROPER_FORMAT_DOMAIN_LABELS';
      }
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_main_format() {
    $group_list = array_keys($this->domains);

    if (!in_array('main', $group_list)) {
      return 'EXCEL_IMPROPER_MAIN_FORMAT';
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_tokens_consistency() {
    $cache = $this->get_cache();

    foreach ($this->languages as $language) {
      $match = $cache['columns']['Tokens'][0];
      $check = $cache['columns'][$language][0];

      // Remove nulls from array.
      $match = array_filter($match, 'strlen');
      $check = array_filter($check, 'strlen');
      if ($match !== $check) {
        return 'EXCEL_FORMAT_INVALID_COLUMNS';
      }
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_domain_format() {
    $rows = $this->rows;
    $domain_row = array_filter($rows['Domains'][1]);

    foreach ($rows['Domains'] as $domains) {

      $domains = array_filter($domains, 'strlen');

      if (empty($domains)) {
        continue;
      }

      if (count($domain_row) < count($domains)) {
        return 'EXCEL_IMPROPER_DOMAIN_FORMAT';
      }
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_domain_consistency() {
    $rows = $this->rows;

    // Reformat and sort domain list.
    $domain_list = $this->list;
    asort($domain_list);
    $domain_list = array_values($domain_list);
    foreach ($this->languages as $language) {

      $domain = $rows[$language][1];

      // Unset labels.
      unset($domain['A']);
      unset($domain['B']);

      // Remove nulls and sort domain list.
      $domain = array_filter($domain, 'strlen');
      asort($domain);
      $domain = array_values($domain);

      if ($domain_list !== $domain) {
        return 'EXCEL_FORMAT_DOMAINS_MISMATCH';
      }
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_domain_duplicates() {
    // Define trimming function.
    $func = function ($value) {
      $value = trim($value);
      $value = str_replace(' ', '', $value);
      return $value;
    };

    $domain_list = array_map($func, $this->list);

    if (array_diff_key($domain_list, array_unique($domain_list))) {
      return 'EXCEL_FORMAT_DOMAINS_DUPLICATES';
    }

    return 'VALIDATE_OK';
  }

  /**
   * Validator function for validation excel content.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   *
   * @return string
   */
  private function validate_tokens_duplicates() {
    $cache = $this->get_cache();

    // Define trimming function.
    $func = function ($value) {
      $value = trim($value);
      $value = str_replace(' ', '', $value);
      return $value;
    };

    foreach ($this->languages as $language) {
      // Get tokens.
      $tokens = $cache['columns'][$language][0];
      unset($tokens[1]);

      // Check for duplicates of token values.
      $token_list = array_map($func, $tokens);

      if (array_diff_key($token_list, array_unique($token_list))) {
        return 'EXCEL_FORMAT_COLUMNS_DUPLICATES';
      }
    }

    return 'VALIDATE_OK';
  }

  /**
   * Gets the placeholders and its respective default value from the phpexcel object per language.
   *
   * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
   * @param array $rows
   *   - the phpexcel array object.
   * @param array $language
   *   - the language of the token to fetch.
   *
   * @return result
   */
  public function excel_get_master_placeholder($language, $caching = TRUE) {
    // If cache is not empty, return the cache instead.
    if (!empty($this->placeholders[$language]) && $caching == TRUE) {
      return $this->placeholders[$language];
    }

    $columns = $this->excel_filter_column($language);

    // Tokens are always on column A.
    $tokens = array_values($columns[0]);
    // Default values are always on column B.
    $default = array_values($columns[1]);
    // No default value has been set, return false instead.
    if ($default[0] != 'Default') {
      return FALSE;
    }

    // Unset the label as part of the placeholder collection.
    unset($default[0]);
    unset($tokens[0]);

    // Reformat array to placeholder => value.
    foreach ($tokens as $key => $token) {
      // Skip loop if token is NULL.
      if (!isset($token)) {
        continue;
      }

      $this->placeholders[$language][$token] = $default[$key];
    }

    return $this->placeholders[$language];
  }

}
