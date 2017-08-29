<?php

/**
 * Matterhorn domain validations
 *
 */

/**
 * Validation for add_domain form
 *
 */
function matterhorn_domain_domains_validate($form, &$form_state) {

    $id = (isset($form_state['values']['matterhorn_domain']['id'])) ? $form_state['values']['matterhorn_domain']['id'] : '';
    $domain = $form_state['values']['matterhorn_domain']['name'];

    $result = db_select('matterhorn_domain_domains', 'domains')
                    ->fields('domains', array('id'))
                    ->condition('domains.domain', $domain, '=')
                    ->execute()->fetchField();

    if (($id != '' && $result !== FALSE && $result != $id) || ($id == '' && $result)) {
        form_set_error('name', t('The domain name already exists.'));
    }
}

/**
 * Validation for add_domain form
 *
 */
function matterhorn_domain_groups_validate($form, &$form_state) {
    $id = (isset($form_state['values']['matterhorn_domain_group']['id'])) ? $form_state['values']['matterhorn_domain_group']['id'] : '';
    $group = $form_state['values']['matterhorn_domain_group']['name'];

    $result = db_select('matterhorn_domain_groups', 'groups')
                    ->fields('groups', array('id'))
                    ->condition('groups.name', $group, '=')
                    ->execute()->fetchField();

    if (($id != '' && $result !== FALSE && $result != $id) || ($id == '' && $result)) {
        form_set_error('name', t('The domain group name already exists.'));
    }
}

/**
 * Validation for add_variable form
 *
 */
function matterhorn_domain_variables_validate($form, &$form_state) {
    // just return a true value
}

/**
 * Matterhorn domain database read
 *
 */

/**
 * Returns an array of all domains, where the index is the primary key `id`
 *
 */
function _matterhorn_domain_get_domains() {
    static $domains = '';

    if ($domains != '') {
        return $domains;
    }

    $domains = array();

    $result = db_select('matterhorn_domain_domains', 'domains')
            ->fields('domains')
            ->orderBy('weight')
            ->execute();

    while ($row = $result->fetchAssoc()) {
        $domains[$row['id']] = $row;
    }

    return $domains;
}

/**
 * Returns a nested array of domain groups with the following data:
 *
 * id = the domain group primary key
 * name = name of the domain group
 * domains	= array containing the domains under this domain group
 *
 */
function _matterhorn_domain_get_domain_groups_with_domains() {
    static $groups = '';

    if ($groups != '') {
        return $groups;
    }

    $groups = array();

    $query = db_select('matterhorn_domain_groups', 'groups');
    $query->join('matterhorn_domain_domains', 'domains', 'groups.id = domains.group_id');
    $query->fields('groups')->fields('domains')->orderBy('weight')->orderBy('group_id');

    $result = $query->execute();

    $count = 0;

    foreach ($result as $row) {
        $count++;
        if (!isset($groups[$row->group_id])) {
            $groups[$row->group_id] = array(
                'id' => $row->group_id,
                'name' => $row->name,
                'domains' => array(),
            );
        }
        if (!empty($row->id)) {
            $groups[$row->group_id]['domains'][] = array(
                'id' => $row->id,
                'domain' => $row->domain,
                'weight' => $count,
            );
        }
    }

    return array(
        'groups' => $groups,
        'count' => $count,
    );
}

/**
 * Returns the name of domain by id
 *
 */
function _matterhorn_domain_get_domain_name($id) {
    $domain_name = db_select('matterhorn_domain_domains', 'domains')
                    ->fields('domains', array('domain'))
                    ->condition('domains.id', $id, '=')
                    ->execute()->fetchField();
    return $domain_name;
}

/**
 * Returns the name of group by id
 *
 */
function _matterhorn_domain_get_group_name($id) {
    $group_name = db_select('matterhorn_domain_groups', 'groups')
                    ->fields('groups', array('name'))
                    ->condition('groups.id', $id, '=')
                    ->execute()->fetchField();
    return $group_name;
}

/**
 * Returns an array of all domain groups, where the index is the primary key `id`
 *
 */
function _matterhorn_domain_get_domain_groups() {
    static $groups = '';

    if ($groups != '') {
        return $groups;
    }

    $groups = array();

    $result = db_select('matterhorn_domain_groups', 'groups')
            ->fields('groups')
            ->execute();

    foreach ($result as $row) {
        $groups[$row->id] = $row->name;
    }

    return $groups;
}

/**
 * Return an array of a single placeholder
 *
 */
function _matterhorn_domain_get_variable($id) {

    $variable = db_select('matterhorn_domain_variables', 'var')
            ->fields('var')
            ->condition('var.id', $id, '=')
            ->execute()
            ->fetchAssoc();

    return $variable;
}

/**
 * Returns an array of all placeholder
 *
 */
function _matterhorn_domain_get_all_variables($tokens = NULL) {

    $variables = array();

    $query = db_select('matterhorn_domain_variables', 'vars')->fields('vars');

    if (!empty($tokens)) {
        $names = array_keys($tokens);
        $query->condition('name', $names, 'IN');
    }

    $result = $query->orderBy('vars.name')->execute();

    while ($row = $result->fetchAssoc()) {
        $variables[$row['name']] = $row;
    }

    return $variables;
}

/**
 * Returns an array of placeholder values, based on domain/group id and language
 * where the index is the unique identifier `name`
 *
 */
function _matterhorn_domain_get_variables_by_id($id, $lang = 'en', $tokens = NULL) {
    $variables = array();
    $query = db_select('matterhorn_domain_domain_variables', 'vars')
            ->fields('vars')
            ->condition('vars.id', $id, '=');

    if (!empty($tokens)) {
        $names = array_keys($tokens);
        $query->condition('name', $names, 'IN');
    }

    $result = $query->condition('vars.language', $lang, '=')->execute();

    while ($row = $result->fetchAssoc()) {
        $variables[$row['name']] = $row;
    }
    return $variables;
}

/**
 * Returns the name of variable by id
 *
 */
function _matterhorn_domain_get_variable_name($id) {
    $domain_name = db_select('matterhorn_domain_variables', 'vars')
                    ->fields('vars', array('name'))
                    ->condition('vars.id', $id, '=')
                    ->execute()->fetchField();
    return $domain_name;
}

/**
 * Returns an array of the default placeholder default
 *
 */
function _matterhorn_domain_get_variables_default($lang, $tokens = NULL) {

    $variables = _matterhorn_domain_get_all_variables($tokens);

    foreach ($variables as $var) {
        $vid = 'variable:' . $var['id'];
        $value = _matterhorn_domain_get_variables_by_id($vid, $lang, $tokens);
        $variables[$var['name']]['value'] = (isset($value[$var['name']]['value'])) ? $value[$var['name']]['value'] : '';
    }

    return $variables;
}

/**
 * Returns an array of placeholder values, based on current domain and current language
 * It merges/flattens the following data to a single array
 *
 */
function _matterhorn_domain_get_variables_by_heirarchy($domain, $lang = 'en', $tokens = NULL) {
    $did = 'domain:' . $domain['id'];
    $gid = 'group:' . $domain['group_id'];

    $default = _matterhorn_domain_get_variables_default($lang, $tokens);
    $groups = _matterhorn_domain_get_variables_by_id($gid, $lang, $tokens);
    $domains = _matterhorn_domain_get_variables_by_id($did, $lang, $tokens);

    $variables = array_merge($default, $groups, $domains);

    return $variables;
}
