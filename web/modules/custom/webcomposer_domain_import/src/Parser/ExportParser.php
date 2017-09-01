<?php

namespace Drupal\webcomposer_domain_import\Parser;

/**
 * Class for parsing Domains data to excel object
 *
 * @package Webcomposer Domain Import
 *
 */
class ExportParser {

	/**
   * Constructor.
   */
  public function __construct() {

  }

	// Container for default placeholder list
	private $placeholders = array();
	private $domains = array();

	/**
   * Returns an array of all domain groups, where the index is the primary key `id`
   *
   */
  public function get_domain_groups() {
    static $groups = '';

    if ($groups != '') {
        return $groups;
    }

    $groups = array();

    $domain_groups = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('domain_groups');
    foreach ($domain_groups as $key => $value) {
    	$groups[] = (string) $value->name;
    }

    return $groups;
  }


  /**
   * Returns a nested array of domain groups with the following data:
   *
   * id = the domain group primary key
   * name = name of the domain group
   * domains  = array containing the domains under this domain group
   *
   */
  public function get_domain_groups_with_domains() {

    $count = 0;

    // Get all the domains with respective groups.
    $domains = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('domain');

    foreach ($domains as $key => $value) {
      $count++;

    	// Get domain group ID.
    	$group_id = taxonomy_term_load($value->tid)->get('field_select_domain_group')->getValue(false)[0]['target_id'];

    	// Set array as domain name => group.
    	$group_name = taxonomy_term_load($group_id)->get('name')->getValue(false)[0]['value'];

    	// $domain_name = [$value->tid => $value->name];
    	if (!array_key_exists($group_id, $groups)) {
        $groups[$group_id]['id'] = $group_id;
        $groups[$group_id]['name'] = $group_name;
        $domain_information = array (
          'id'=>$value->tid,
          'domain'=>$value->name,
          'weight'=>$count
        );

        $groups[$group_id]['domains'][$value->tid] = $domain_information;

      } else {
          // Get domain information.
          $domain_information = ['id'=>$value->tid, 'domain'=>$value->name, 'weight'=>$count];

          // Update the domains in existing array.
          $groups[$group_id]['domains'][$value->tid] = array_merge($domain_information, $groups[$group_id]['domains']);
     	 }
    }

    $result = array(
        'groups' => $groups,
        'count' => $count,
    );

    return $result;
  }

  /**
   * Returns an array of all placeholder
   *
   */
  function _matterhorn_domain_get_all_variables($tokens = NULL) {
    $variables = array();

    // query all variables from database
    $query = db_select('new_matterhorn_domain_variables', 'vars')->fields('vars');

    if (!empty($tokens)) {
        $names = array_keys($tokens);
        $query->condition('name', $names, 'IN');
    }

    // sort data by name
    $result = $query->orderBy('vars.name')->execute();

    // format data
    while ($row = $result->fetchAssoc()) {
        $variables[$row['name']] = $row;
    }

    return $variables;
  }

	/**
	 * Converts a column based format array to row based PHP excel readable array
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $columns - a column based format array
	 * @return array $result
	 *
	 */
	public function excel_filter_column($columns) {
		$result = array();

		foreach($columns as $column_key => $column_data) {
			foreach($column_data as $row_key => $row_data) {
				$result[$row_key][$column_key] = $row_data;
			}
		}

		return $result;
	}

	/**
	 * Generates the languages worksheet data
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $languages - the list of available languages
	 * @return array $result
	 *
	 */
	public function excel_get_languages($languages) {
		$result = array();

		// add label to array collection
		$result[] = array('Languages');

		foreach ($languages as $key => $value) {
			$result[] = array($key);
		}

		return $result;
	}

	/**
	 * Generates the domain groups worksheet data
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $groups - the domain groups fetched from the database
	 * @return array $result
	 *
	 */
	public function excel_get_domain_groups($groups) {
		$result = array();

		foreach ($groups as $group) {
			$result[] = array($group);
		}

		return $result;
	}

	/**
	 * Generates the domain list worksheet data with their corresponding groups
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $groups - the list of domains from the database
	 * @return array $result
	 *
	 */
	public function excel_get_domains($groups) {
		$k = 0;
		$result = array();

		foreach ($groups['groups'] as $group) {
			$name = $group['name'];
			$result[$k][] = $group['name'];

			foreach ($group['domains'] as $domain) {
				$result[$k][] = $domain['domain'];
			}
			$k++;
		}
    // kint($result);die;

		// get the highest row number
		$count = 0;
		foreach ($result as $group) {
			$x = count($group);
			if ($count < $x) {
				$count = $x;
			}
		}

		// populate missing rows with nulls, so that all columns will have the same number of rows
		for ($i = 0; $i < count($result)-1; $i++) {
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
	 * Generates the domain list worksheet data
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $domain_groups - the list of domain groups
	 * @return array $result
	 *
	 */
	public function excel_get_domain_list($domain_groups) {
		// if cache is not empty, return the cache instead
		if (!empty($this->domains)) {
			return $this->domains;
		}

		$result = array();
		$k = 0;

		foreach ($domain_groups['groups'] as $group) {
			$name = $group['name'];
			$result[$k][] = $group['name'];

			foreach ($group['domains'] as $domain) {
				$result[$k][] = $domain['domain'];
			}

			$k++;
		}

		// put all domain variables in class property
		$this->domains = $result;
		return $this->domains;
	}

	/**
	 * Generates the placeholder list together with the description
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $placeholders - the list of placeholders
	 * @return array $result
	 *
	 */
	public function excel_get_placeholders_description($placeholders) {
		$result = array();
		$result = $this->cache_placeholders($placeholders);

		// convert token data into excel writable arrays
		$result = $this->excel_filter_column($result);
		return $result;
	}

	/**
	 * Generates the tokens and placeholder worksheet data per domain
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $data - array containing the token data per domain
	 * @param array $placeholders - the list of placeholders
	 * @param array $defaults - the default placeholder values
	 * @return array $result
	 *
	 */
	public function excel_get_all_tokens($data, $placeholders, $defaults = NULL) {
		$result = array();

		$cache = $this->cache_placeholders($placeholders);
		$result['label'] = $cache['label'];

		// put default token value as part of excel spreadsheet
		if ($defaults) {
			$result['default']['group'] = 'default';
			// loop through default values
			foreach ($defaults as $domain) {
				$result['default'][ $domain['name'] ] = $domain['value'];
			}
		}

		// reformat token data into column based format
		// save column structure by appending NULLS to empty columns
		foreach ($data as $group_name => $group) {
			$result[$group_name]['group'] = $group_name;
			foreach ($result['label'] as $token) {
				// check if token exist, otherwise make it NULL
				if (!isset( $group[$token]['value'])) {
					$group[$token]['value'] = NULL;
				}

				$result[$group_name][$token] = $group[$token]['value'];
			}
		}

		// convert token data into excel writable arrays
		$result = $this->excel_filter_column($result);

		return $result;
	}

	/**
	 * Private helper functions
	 *
	 */

	/**
	 * Comment
	 *
	 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
	 * @param array $placeholders - the list of placeholders
	 * @return array $result
	 *
	 */
	private function cache_placeholders($placeholders) {
		// check if property is empty
		if (empty($this->placeholders)) {
			$this->placeholders['label']['group'] = 'tokens';
			$this->placeholders['description']['group'] = 'description';
			// loop through the keys of the default values
			foreach ($placeholders as $key => $placeholder) {
				$this->placeholders['label'][$key] = $key;
				$this->placeholders['description'][$key] = $placeholder['description'];
			}
		}

		return $this->placeholders;
	}
}
