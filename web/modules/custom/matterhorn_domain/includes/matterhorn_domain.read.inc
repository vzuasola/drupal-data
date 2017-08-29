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
    $id = NULL;
    $domain = $form_state['values']['matterhorn_domain']['name'];

    // set domain value if value exists
    if (isset($form_state['values']['matterhorn_domain']['id'])) {
        $id = $form_state['values']['matterhorn_domain']['id'];
    }

    // query matching domain from database
    $result = db_select('new_matterhorn_domain_domains', 'domains')
                    ->fields('domains', array('id'))
                    ->condition('domains.type_id', 3, '=')
                    ->condition('domains.name', $domain, '=')
                    ->execute()->fetchField();

    // validation conditions
    $match = (!empty($id) && !empty($result) && $result != $id);
    $condition = (empty($id) && $result);

    // display error when validation conditions are met
    if ($match || $condition) {
        form_set_error('name', t('The domain name already exists.'));
    }
}

/**
 * Validation for add_domain form
 *
 */
function matterhorn_domain_groups_validate($form, &$form_state) {
    $id = NULL;
    $group = $form_state['values']['matterhorn_domain_group']['name'];

    // set domain value if value exists
    if (isset($form_state['values']['matterhorn_domain_group']['id'])) {
        $id = $form_state['values']['matterhorn_domain_group']['id'];
    }

    // query matching group from database
    $result = db_select('new_matterhorn_domain_domains', 'groups')
                    ->fields('groups', array('id'))
                    ->condition('groups.type_id', 2, '=')
                    ->condition('groups.name', $group, '=')
                    ->execute()->fetchField();

    // validation conditions
    $match = (!empty($id) && !empty($result) && $result != $id);
    $condition = (empty($id) && $result);

    // display error when validation conditions are met
    if ($match || $condition) {
        form_set_error('name', t('The domain group name already exists.'));
    }
}

/**
 * Validation for add_variable form
 *
 */
function matterhorn_domain_variables_validate($form, &$form_state) {
    $id = NULL;
    $variable = $form_state['values']['name'];

    // set domain value if value exists
    if (isset($form_state['values']['id'])) {
        $id = $form_state['values']['id'];
    }

    // query matching group from database
    $result = db_select('new_matterhorn_domain_variables', 'variables')
                    ->fields('variables', array('id'))
                    ->condition('variables.name', $variable, '=')
                    ->execute()->fetchField();

    // validation conditions
    $match = (!empty($id) && !empty($result) && $result != $id);
    $condition = (empty($id) && $result);

    // display error when validation conditions are met
    if ($match || $condition) {
        form_set_error('name', t('The variable name already exists.'));
    }
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

    // query all domains from database
    $result = db_select('new_matterhorn_domain_domains', 'domains')
            ->fields('domains')
            ->condition('domains.type_id', 3, '=')
            ->orderBy('weight')
            ->execute();

    // format data
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

     // query and join results of groups and domain table
    $query = db_select('new_matterhorn_domain_domains', 'groups');
    $query->join('new_matterhorn_domain_domains', 'domains', 'groups.id = domains.group_id');

    $query->addField('domains', 'id', 'id');
    $query->addField('groups', 'name', 'name');
    $query->addField('domains', 'name', 'domain');
    $query->addField('domains', 'group_id', 'group_id');
    $query->addField('domains', 'weight', 'weight');

    $result = $query->orderBy('group_id')
            ->orderBy('weight')
            ->execute();

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

    $result = array(
        'groups' => $groups,
        'count' => $count,
    );

    return $result;
}

/**
 * Returns the name of domain by id
 *
 */
function _matterhorn_domain_get_domain_name($id) {
    // query matching domain from database
    $domain_name = db_select('new_matterhorn_domain_domains', 'domains')
                    ->fields('domains', array('name'))
                    ->condition('domains.id', $id, '=')
                    ->condition('domains.type_id', 3, '=')
                    ->execute()->fetchField();

    return $domain_name;
}

/**
 * Returns the name of group by id
 *
 */
function _matterhorn_domain_get_group_name($id) {
    // query matching groups from database
    $group_name = db_select('new_matterhorn_domain_domains', 'groups')
                    ->fields('groups', array('name'))
                    ->condition('groups.id', $id, '=')
                    ->condition('groups.type_id', 2, '=')
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

    // query all domains from database
    $result = db_select('new_matterhorn_domain_domains', 'groups')
            ->fields('groups')
            ->condition('groups.type_id', 2, '=')
            ->execute();

    // format data
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
    // query matching variables from database
    $variable = db_select('new_matterhorn_domain_variables', 'var')
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
 * Returns an array of placeholder values, based on domain/group id and language
 * where the index is the unique identifier `name`
 *
 */
function _matterhorn_domain_get_variables_by_id($id, $lang = 'en', $tokens = NULL) {
    $variables = array();

    // query all matching variables from database
    $query = db_select('new_matterhorn_domain_domain_variables', 'vars');
    $query->join('new_matterhorn_domain_variables', 'var', 'vars.variable_id = var.id');

    $query->fields('vars')
            ->fields('var')
            ->condition('vars.domain_id', $id, '=');

    if (!empty($tokens)) {
        $names = array_keys($tokens);
        $query->condition('name', $names, 'IN');
    }

    $result = $query->condition('vars.language', $lang, '=')->execute();

    // format data
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
    // query matching variable from database
    $domain_name = db_select('new_matterhorn_domain_variables', 'vars')
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
    // get all variables
    $variables = _matterhorn_domain_get_all_variables($tokens);

    $value = _matterhorn_domain_get_variables_by_id('1', $lang);

    foreach ($variables as $var) {
        // set variable value to null if value does not exist
        if (!isset($value[$var['name']]['value'])) {
            $variables[$var['name']]['value'] = NULL;
            continue;
        }

        $variables[$var['name']]['value'] = $value[$var['name']]['value'];
    }

    return $variables;
}

/**
 * Returns an array of placeholder values, based on current domain and current language
 * It merges/flattens the following data to a single array
 *
 */
function _matterhorn_domain_get_variables_by_heirarchy($domain, $lang = 'en', $tokens = NULL) {
    // get property ids
    $did = $domain['id'];
    $gid = $domain['group_id'];

    // get variable data
    $default = _matterhorn_domain_get_variables_default($lang);
    $groups = _matterhorn_domain_get_variables_by_id($gid, $lang);
    $domains = _matterhorn_domain_get_variables_by_id($did, $lang);

    // merge all variable data
    $variables = array_merge($default, $groups, $domains);

    return $variables;
}
