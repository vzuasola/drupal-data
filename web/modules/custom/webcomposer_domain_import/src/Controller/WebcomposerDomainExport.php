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
public function matterhorn_domain_export_excel() {
  
  $parser  = \Drupal::service('webcomposer_domain.export_xls');
    kint($parser);die();
    $data = $this->matterhorn_domain_export_get_parsed_data();
   // matterhorn_domain_export_create_excel($data);

    return;
}

/**
 * Gets data from Matterhorn Domain and parse it to PHP excel readable array
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @return array $result - the parsed Matterhorn Domain data
 *
 */
public function matterhorn_domain_export_get_parsed_data() {
    $result = array();
    $parser  = \Drupal::service('webcomposer_domain.export_xls');
    kint($parser);die();
    $groups = _matterhorn_domain_get_domain_groups();
    $domains = _matterhorn_domain_get_domain_groups_with_domains();
    $placeholders = _matterhorn_domain_get_all_variables();

    $result['languages'] = $parser->excel_get_languages( language_list() );
    $result['groups'] = $parser->excel_get_domain_groups($groups);
    $result['domains'] = $parser->excel_get_domains($domains);
    $result['placeholders'] = $parser->excel_get_placeholders_description($placeholders);

    foreach ( language_list() as $language => $languages ) {
        $list = $parser->excel_get_domain_list($domains);

        $variables = _matterhorn_domain_export_get_all_variables($list, $language);
        $defaults = _matterhorn_domain_get_variables_default($language);

        $result['variables'][$language] = $parser->excel_get_all_tokens($variables, $placeholders, $defaults);
    }

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
public function matterhorn_domain_export_create_excel($data, $excel_version = 'Excel2007', $headers = TRUE, $output = 'php://output') {
    // create new excel parser class instance
    $excel = new Matterhorn\Domains\ExcelParser;
    // create languages worksheet
    $excel->create_sheet($data['languages'], 'Languages');
    // create domains worksheet
    $excel->create_sheet($data['domains'], 'Domains');
    // create token placeholder worksheet
    $excel->create_sheet($data['placeholders'], 'Tokens');
    // create tokens worksheet per language
    foreach ( language_list() as $key => $language ) {
        $excel->create_sheet($data['variables'][$key], $key);
    }
    // invoke excel creation and download
    $excel->save('export.xlsx', $excel_version, $headers, $output);

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
public function _matterhorn_domain_export_get_all_domains() {
    $domains = array();

    $result = db_select('new_matterhorn_domain_domains', 'domains')
        ->fields('domains')
        ->orderBy('group_id')
        ->orderBy('weight')
        ->execute();

    foreach($result as $row){
        $groups[$row->id] = $row->name;
    }

    return $groups;
}

/**
 * Gets the id of a given domain
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param string $domain - the name of the domain
 * @return array $result - array containing domain string of domain id and type
 *
 */
public function _matterhorn_domain_export_get_type_id($domain) {
    $result = array();
    $groups = _matterhorn_domain_get_domain_groups();
    $domains = _matterhorn_domain_export_get_all_domains();

    $result['id'] = array_search($domain, $groups);

    if ($result['id']) {
        $result['type'] = 'group';
        return $result;
    }

    $result['id'] = array_search($domain, $domains);

    if ($result['id']) {
        $result['type'] = 'domain';
        return $result;
    }

    return FALSE;
}

/**
 * Fetches all the variables from the given domain list and language
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $domains - array containing the list of domains
 * @param string $language - the language
 * @return array $data
 *
 */
public function _matterhorn_domain_export_get_all_variables($domains, $language) {
    $data = array();

    // loop through domain groups
    for ($i = 0; $i < count($domains); $i++ ) {
        // loop through domain lists per group
        for ($k = 0; $k < count( $domains[$i] ); $k++) {
            // get all variables per domain list
            $data[ $domains[$i][$k] ] = _matterhorn_domain_export_get_variables($domains[$i][$k], $language);
        }
    }

    return $data;
}

/**
 * Gets the variable values of a specific domain and language
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param string $domain - the name of the domain
 * @param string $lang - the language
 * @return array $result - the variable data
 *
 */
public function _matterhorn_domain_export_get_variables($domain, $lang) {
    $result = array();
    $data = _matterhorn_domain_export_get_type_id($domain);

    $id = $data['id'];
    $type = $data['type'];

    if ($type !== 'domain' && $type !== 'group') {
        $id = FALSE;
    }

    if ($id) {
        $result = _matterhorn_domain_get_variables_by_id($id, $lang);
    } else {
        $result = _matterhorn_domain_get_variables_default($lang);
    }

    return $result;
}

/**
 * Gets the data of the specified domain
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param string $search - the name of the domain
 * @return array $result
 *
 */
public function _matterhorn_domain_export_get_current_domain_by_name($search) {
    $domains = _matterhorn_domain_get_domains();

    foreach ($domains as $domain) {
        if ($domain['name'] == $search) {
            return $domain;
        }
    }

    return FALSE;
}

}