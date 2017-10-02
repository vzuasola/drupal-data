<?php

namespace Drupal\webcomposer_domain_import\Parser;

/**
 * Class for parsing Domains data to excel object.
 *
 * @package Webcomposer Domain Import
 */
class ExportParser {

  /**
   * Constructor.
   */
  public function __construct() {

  }

  /**
   * Container for default placeholder list.
   */
  private $placeholders = [];
  private $domains = [];

  /**
   * Returns an array of all domain groups, where the index is the primary key `id`.
   */
  public function get_domain_groups() {
    return $this->readTaxonomyByName('domain_groups');
  }

  /**
   * Retruns all domains.
   */
  public function get_domain() {
    return $this->readTaxonomyByName('domain');
  }

  /**
   * Returns domain group id.
   */
  public function get_domain_group_id($entity_id) {
    $termid = 0;
    $term_id = 0;

    $termid = db_query('SELECT n.field_select_domain_group_target_id FROM {taxonomy_term__field_select_domain_group} n WHERE n.entity_id  = :entity_id', [':entity_id' => $entity_id]);

    foreach ($termid as $val) {
      // Get tid.
      $term_id = $val->field_select_domain_group_target_id;
    }
    return $term_id;

  }

  /**
   * Returns Placeholder target id.
   */
  public function get_add_placeholder_target_id($entity_id, $langcode) {
    $termid = 0;
    $term_id = [];

    $termid = db_query('SELECT n.field_add_placeholder_target_id FROM {taxonomy_term__field_add_placeholder} n WHERE n.entity_id  = :entity_id AND n.langcode = :langcode', [':entity_id' => $entity_id, ':langcode' => $langcode]);

    foreach ($termid as $val) {
      // Get tid.
      $term_id[]['target_id'] = $val->field_add_placeholder_target_id;
    }
    return $term_id;
  }

  /**
   * Returns Placeholder Key.
   */
  public function get_paragraph__field_placeholder_key($entity_id, $langcode) {
    $termid = 0;
    $key_value = '';

    $termid = db_query('SELECT n.field_placeholder_key_value FROM {paragraph__field_placeholder_key} n WHERE n.entity_id  = :entity_id AND n.langcode = :langcode', [':entity_id' => $entity_id, ':langcode' => $langcode]);

    foreach ($termid as $val) {
      // Get tid.
      $key_value = $val->field_placeholder_key_value;
    }
    return $key_value;
  }

  /**
   * REturns Placeholder default key.
   */
  public function get_paragraph__field_default_value($entity_id, $langcode) {
    $termid = 0;
    $key_value = '';

    $termid = db_query('SELECT n.field_default_value_value FROM {paragraph__field_default_value} n WHERE n.entity_id  = :entity_id AND n.langcode = :langcode', [':entity_id' => $entity_id, ':langcode' => $langcode]);

    foreach ($termid as $val) {
      // Get tid.
      $key_value = $val->field_default_value_value;
    }
    return $key_value;
  }

  /**
   * Returns ter id based on vocab id.
   */
  private function readTaxonomyByName($vocab) {
    $term_id = [];
    // Get tid of term with same name.
    $termid = db_query('SELECT n.tid, n.name FROM {taxonomy_term_field_data} n WHERE n.vid  = :vid', [':vid' => $vocab]);
    foreach ($termid as $termName) {
      // Get tid and term name.
      $term_id[$termName->tid] = $termName->name;
    }
    return $term_id;

  }

  /**
   * Returns a nested array of domain groups with the following data:.
   *
   * Id = the domain group primary key
   * name = name of the domain group
   * domains  = array containing the domains under this domain group.
   */
  public function get_domain_groups_with_domains() {

    $count = 0;
    $groups = [];
    // Get all the domains with respective groups.
    $domains = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('domain');

    foreach ($domains as $key => $value) {
      $count++;

      // Get domain group ID.
      $group_id = taxonomy_term_load($value->tid)->get('field_select_domain_group')->getValue(FALSE)[0]['target_id'];

      // Set array as domain name => group.
      $group_name = taxonomy_term_load($group_id)->get('name')->getValue(FALSE)[0]['value'];

      if (!array_key_exists($group_id, $groups)) {
        $groups[$group_id]['id'] = $group_id;
        $groups[$group_id]['name'] = $group_name;
        $domain_information = [
          'id' => $value->tid,
          'domain' => $value->name,
          'weight' => $count,
        ];

        $groups[$group_id]['domains'][$value->tid] = $domain_information;

      }
      else {
        // Get domain information.
        $domain_information = ['id' => $value->tid, 'domain' => $value->name, 'weight' => $count];

        // Update the domains in existing array.
        $groups[$group_id]['domains'][$value->tid] = array_merge($domain_information, $groups[$group_id]['domains']);
      }
    }

    $result = [
      'groups' => $groups,
      'count' => $count,
    ];

    return $result;
  }

  /**
   * Get domains with domain groups.
   *
   * @return array  array of all the tockens.
   */
  public function get_domain_tokens() {
    $variables = [];

    // Get the master placeholders.
    $placeholders = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('master_placeholder');

    foreach ($placeholders as $value) {
      $token = taxonomy_term_load($value->tid)->get('field_add_master_placeholder')->getValue(FALSE)[0]['target_id'];

      $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($token);
      $placeholder_key = $paragraphs->get('field_placeholder_key')->getValue(FALSE);
      $variables[] = $placeholder_key[0]['value'];
    }
    return $variables;
  }

  /**
   * Converts a column based format array to row based PHP excel readable array.
   *
   * @param array $columns
   *   - a column based format array.
   *
   * @return array $result
   */
  public function excel_filter_column($columns) {
    $result = [];

    foreach ($columns as $column_key => $column_data) {
      foreach ($column_data as $row_key => $row_data) {
        $result[$row_key][$column_key] = $row_data;
      }
    }

    return $result;
  }

  /**
   * Generates the languages worksheet data.
   *
   * @param array $languages
   *   - the list of available languages.
   *
   * @return array $result
   */
  public function excel_get_languages($languages) {
    $result = [];

    // Add label to array collection.
    $result[] = ['Languages'];

    foreach ($languages as $key => $value) {
      $result[] = [$key];
    }

    return $result;
  }

  /**
   * Generates the domain groups worksheet data.
   *
   * @param array $groups
   *   - the domain groups fetched from the database.
   *
   * @return array $result
   */
  public function excel_get_domain_groups($groups) {
    $result = [];

    foreach ($groups as $group) {
      $result[] = [$group];
    }

    return $result;
  }

  /**
   * Generates the domain list worksheet data with their corresponding groups.
   *
   * @param array $groups
   *   - the list of domains from the database.
   *
   * @return array $result
   */
  public function excel_get_domains($groups) {
    $k = 0;
    $result = [];

    foreach ($groups['groups'] as $group) {
      $name = $group['name'];
      $result[$k][] = $group['name'];

      foreach ($group['domains'] as $domain) {
        $result[$k][] = $domain['domain'];
      }
      $k++;
    }

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
    for ($i = 0; $i < count($result) - 1; $i++) {
      for ($j = 0; $j < $count; $j++) {
        if (empty($result[$i][$j])) {
          $result[$i][$j] = NULL;
        }
      }
    }

    $result = $this->excel_filter_column($result);

    return $result;
  }

  /**
   * Generates the placeholder list together with the description.
   *
   * @param array $placeholders
   *   - the list of placeholders.
   *
   * @return array $result
   */
  public function excel_get_placeholders_description($placeholders) {
    $result = [];
    $result = $this->cache_placeholders($placeholders);

    // Convert token data into excel writable arrays.
    $result = $this->excel_filter_column($result);

    return $result;
  }

  /**
   * Generates the tokens and placeholder worksheet data per domain.
   *
   * @param array $data
   *   - array containing the token data per domain.
   * @param array $placeholders
   *   - the list of placeholders.
   * @param array $defaults
   *   - the default placeholder values.
   *
   * @return array $result
   */
  public function excel_get_all_tokens($data, $placeholders, $defaults = NULL) {
    $result = [];

    $cache = $this->cache_placeholders($placeholders);
    $result['label'] = $cache['label'];

    // Put default token value as part of excel spreadsheet.
    if ($defaults) {
      $result['default']['group'] = 'default';
      // Loop through default values.
      foreach ($defaults as $domain) {
        $result['default'][$domain['name']] = $domain['value'];
      }
    }

    // Reformat token data into column based format
    // save column structure by appending NULLS to empty columns.
    foreach ($data as $group_name => $group) {
      $result[$group_name]['group'] = $group_name;
      foreach ($result['label'] as $token) {
        // Check if token exist, otherwise make it NULL.
        if (!isset($group[$token]['value'])) {
          $group[$token]['value'] = NULL;
        }

        $result[$group_name][$token] = $group[$token]['value'];
      }
    }

    // Convert token data into excel writable arrays.
    $result = $this->excel_filter_column($result);

    return $result;
  }

  /**
   * Format the array of placeholders.
   *
   * @param array $placeholders
   *   - the list of placeholders.
   *
   * @return array $result
   */
  private function cache_placeholders($placeholders) {

    // Check if property is empty.
    if (empty($this->placeholders)) {
      $this->placeholders['label']['group'] = 'tokens';

      // Loop through the keys of the default values.
      foreach ($placeholders as $key => $placeholder) {
        $this->placeholders['label'][$key] = $placeholder;
      }
    }

    return $this->placeholders;
  }

}
