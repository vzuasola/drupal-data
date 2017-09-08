<?php

/**
 * Matterhorn domain edit handlers
 *
 */

/**
 * Displays the Edit Domain form (including the list of placeholders)
 *
 */
function matterhorn_domain_edit_domains($form, &$form_state, $id) {

    global $language;

    // get the list of domains
    $domains = _matterhorn_domain_get_domains();

    // check if the selected domain exists
    if (isset($domains[$id])) {

        $domain = $domains[$id];
        $did = 'domain:' . $id;
        $gid = 'group:' . $domain['group_id'];

        // get the current language
        $lang = $language->language;

        $form = array();

        $form['matterhorn_languages'] = array(
            '#type' => 'fieldset',
            '#title' => t('There are multilingual variables in this form'),
            '#description' => t('Check you are editing the variables for the right Language value or select the desired Language.'),
        );
        $form['matterhorn_languages']['select_key'] = array(
            '#type' => 'item',
            '#markup' => implode(' | ', matterhorn_language_tabs()),
        );
        $form['type'] = array(
            '#type' => 'hidden',
            '#default_value' => 'domain',
        );
        $form['matterhorn_domain'] = array(
            '#type' => 'fieldset',
            '#collapsible' => FALSE,
            '#collapsed' => FALSE,
            '#weight' => 0
        );
        $form['matterhorn_domain']['id'] = array(
            '#type' => 'hidden',
            '#default_value' => $id,
        );
        $form['matterhorn_domain']['name'] = array(
            '#type' => 'textfield',
            '#title' => t('Domain Name'),
            '#default_value' => $domain['domain'],
            '#description' => t('Specify the domain name, e.g. example.org or matterhorn.com'),
            '#required' => TRUE,
        );
        $form['matterhorn_domain']['name_old_value'] = array(
            '#type' => 'hidden',
            '#value' => $domain['domain']
        );
        $form['matterhorn_domain_variables'] = array(
            '#type' => 'fieldset',
            '#title' => t('Assign Placeholders'),
            '#collapsible' => TRUE,
            '#collapsed' => FALSE,
            '#tree' => TRUE,
            '#weight' => 5
        );

        $form['matterhorn_domain_variable']['domain_name'] = array(
            '#type' => 'hidden',
            '#value' => _matterhorn_domain_get_domain_name($id),
        );

        // get the placeholders for this domain and language
        $variables = _matterhorn_domain_get_variables_default($lang);

        $did = 'domain:' . $domain['id'];
        $gid = 'group:' . $domain['group_id'];

        foreach ($variables as $var) {
            $group = _matterhorn_domain_get_variables_by_id($gid, $lang);
            if (isset($group[$var['name']]['value'])) {
                $variables[$var['name']]['value'] = $group[$var['name']]['value'];
                $variables[$var['name']]['group'] = TRUE;
            }
            $domain = _matterhorn_domain_get_variables_by_id($did, $lang);
            if (isset($domain[$var['name']]['value'])) {
                $variables[$var['name']]['value'] = $domain[$var['name']]['value'];
                $variables[$var['name']]['domain'] = TRUE;
            }
        }

        // list the placeholders for this domain
        if (empty($variables)) {
            $form['matterhorn_domain_variables']['#description'] = t('There are no defined placeholders.');
        } else {
            $form['matterhorn_domain_variables']['#description'] = t('The values defined here will be used as the default placeholder for this specific domain.');

            foreach ($variables as $var) {
                $form['matterhorn_domain_variables']['current'][$var['name']] = array(
                    '#type' => 'textarea',
                    '#title' => $var['name'],
                    '#description' => $var['description'] . ' - ' . ((isset($var['group']) || isset($var['domain'])) ? (isset($var['domain']) ? '<b>domain value</b>' : '<b>domain group value</b>') : '<b>placeholder value</b>'),
                    '#default_value' => $var['value'],
                );
                $form['matterhorn_domain_variables']['old'][$var['name']] = array(
                    '#type' => 'hidden',
                    '#value' => $var['value'],
                );
            }
        }

        $form['matterhorn_domain_submit'] = array('#type' => 'submit', '#value' => t('Edit Domain'), '#weight' => 10);

        $form['#validate'][] = 'matterhorn_domain_domains_validate';
        $form['#submit'][] = 'matterhorn_domain_edit_domain_variables_submit';
        $form['#tree'] = TRUE;
        return $form;
    } else {
        drupal_not_found();
        exit;
    }
}

/**
 * Displays the Edit Domain Group form
 *
 */
function matterhorn_domain_edit_groups($form, &$form_state, $id) {
    global $language;

    // get the list of domain groups
    $groups = _matterhorn_domain_get_domain_groups();

    // check if the domain group exists
    if (isset($groups[$id])) {
        $name = $groups[$id];
        $gid = 'group:' . $id;
        $default_lang = language_default('language');
        $lang = $language->language;

        $form = array();

        $form['matterhorn_languages'] = array(
            '#type' => 'fieldset',
            '#title' => t('There are multilingual variables in this form'),
            '#description' => t('Check you are editing the variables for the right Language value or select the desired Language.'),
        );
        $form['matterhorn_languages']['select_key'] = array(
            '#type' => 'item',
            '#markup' => implode(' | ', matterhorn_language_tabs()),
        );
        $form['type'] = array(
            '#type' => 'hidden',
            '#default_value' => 'group',
        );
        $form['matterhorn_domain_group'] = array(
            '#type' => 'fieldset',
            '#collapsible' => FALSE,
            '#collapsed' => FALSE,
            '#weight' => 0
        );
        $form['matterhorn_domain_group']['id'] = array(
            '#type' => 'hidden',
            '#default_value' => $id,
        );
        // do not allow editing of the name of the main domain group
        $form['matterhorn_domain_group']['name'] = array(
            '#type' => 'textfield',
            '#title' => t('Domain Group Name'),
            '#description' => t('Specify the name of the domain group'),
            '#default_value' => $name,
            '#required' => TRUE,
        );
        $form['matterhorn_domain_group']['name_old_value'] = array(
            '#type' => 'hidden',
            '#value' => $name
        );
        if ($id == 1) {
            $form['matterhorn_domain_group']['name']['#attributes'] = array(
                'readonly' => 'readonly'
            );
        }
        $form['matterhorn_domain_variables'] = array(
            '#type' => 'fieldset',
            '#title' => t('Assign Placeholders'),
            '#collapsible' => TRUE,
            '#collapsed' => FALSE,
            '#tree' => TRUE,
            '#weight' => 5
        );


        // get and list the placeholders for this domain group and language
        $variables = _matterhorn_domain_get_variables_default($lang);

        foreach ($variables as $var) {
            $group = _matterhorn_domain_get_variables_by_id($gid, $lang);

            if (isset($group[$var['name']]['value'])) {
                $variables[$var['name']]['value'] = $group[$var['name']]['value'];
                $variables[$var['name']]['group'] = TRUE;
            }
        }

        if (empty($variables)) {
            $form['matterhorn_domain_variables']['#description'] = t('There are no defined placeholders.');
        } else {
            $form['matterhorn_domain_variables']['#description'] = t('The values defined here will be used as the default placeholder for this specific domain.');

            foreach ($variables as $var) {
                $form['matterhorn_domain_variables']['current'][$var['name']] = array(
                    '#type' => 'textarea',
                    '#title' => $var['name'],
                    '#description' => $var['description'] . ' - ' . (isset($var['group']) ? '<b>domain group value</b>' : '<b>placeholder value</b>'),
                    '#default_value' => $var['value'],
                );
                $form['matterhorn_domain_variables']['old'][$var['name']] = array(
                    '#type' => 'hidden',
                    '#value' => $var['value'],
                );
            }
        }

        $form['matterhorn_domain_submit'] = array('#type' => 'submit', '#value' => t('Edit Domain Group'), '#weight' => 10);

        $form['#validate'][] = 'matterhorn_domain_groups_validate';
        $form['#submit'][] = 'matterhorn_domain_edit_domain_variables_submit';
        $form['#tree'] = TRUE;
        return $form;
    } else {
        drupal_not_found();
        exit;
    }
}

/**
 * Displays the Edit Placeholder form
 *
 */
function matterhorn_domain_edit_variables($form, &$form_state, $id) {
    global $language;
    // get the list of placeholders
    $variable = _matterhorn_domain_get_variable($id);

    // check if the placeholder exists
    if (isset($variable)) {

        // get the Add Domain form and update it so it becomes the Edit Domain form
        $form = matterhorn_domain_variables();

        $form['matterhorn_domain_variable']['#title'] = t('Edit Placeholder');
        $form['matterhorn_domain_variable']['#collapsible'] = FALSE;
        $form['matterhorn_domain_variable']['#collapsed'] = FALSE;

        $form['matterhorn_domain_variable']['name']['#default_value'] = $variable['name'];

        // get variable value by language
        $vid = 'variable:' . $id;
        $value = _matterhorn_domain_get_variables_by_id($vid, $language->language);

        $value = ($value) ? $value[$variable['name']]['value'] : '';
        $form['matterhorn_domain_variable']['value']['#default_value'] = $value;
        $form['matterhorn_domain_variable']['description']['#default_value'] = $variable['description'];

        $form['matterhorn_domain_variable']['id'] = array(
            '#type' => 'hidden',
            '#default_value' => $id,
        );

        $form['matterhorn_domain_variable']['submit']['#value'] = t('Edit Placeholder');

        $form['matterhorn_domain_variable']['name_old_value'] = array(
            '#type' => 'hidden',
            '#value' => $value,
        );

        $form['#submit'] = array('matterhorn_domain_edit_variables_submit');
        unset($form['#theme']);

        return $form;
    } else {
        drupal_not_found();
        exit;
    }
}

/**
 * Matterhorn domain database insert
 *
 */

/**
 * Processes the Add Domain form upon submit
 *
 */
function matterhorn_domain_add_domains_submit($form, &$form_state) {
    // get values from POST
    $group_id = $form_state['values']['matterhorn_domain']['group_id'];
    $domain = $form_state['values']['matterhorn_domain']['name'];

    // get the highest weight of all domains
    $weight = db_select('matterhorn_domain_domains', 'domains')
                    ->fields('domains', array('weight'))
                    ->orderBy('weight', 'DESC')
                    ->execute()->fetchField();

    $domain = array('group_id' => $group_id, 'domain' => $domain, 'weight' => $weight + 1);

    // insert values to database
    drupal_write_record('matterhorn_domain_domains', $domain);
    matterhorn_domain_log('domain', $domain['domain'], 'domain_name', 'add');
    // set success message
    drupal_set_message(t('New domain %name has been added.', array('%name' => $domain['domain'])));
    // redirect to overview page
    $form_state['redirect'] = 'admin/config/framework/domain';

    return;
}

/**
 * Processes the Domain List form upon submit
 *
 */
function matterhorn_domain_list_domains_submit($form, &$form_state) {
    // get the updated group_ids
    $domains = isset($form_state['values']['domains']) ? $form_state['values']['domains'] : array();

    // update the group_id on each domains
    foreach ($domains as $row) {

        $domain = array(
            'group_id' => $row['group'],
            'weight' => $row['weight'],
            'id' => $row['id'],
        );

        drupal_write_record('matterhorn_domain_domains', $domain, 'id');

        if ($row['group'] != $row['old_group']) {
            $domain_name = _matterhorn_domain_get_domain_name($row['id']);
            $group_name = _matterhorn_domain_get_group_name($row['group']);
            $old_group_name = _matterhorn_domain_get_group_name($row['old_group']);
            matterhorn_domain_log('domain', $domain_name, 'domain_group', 'edit', $group_name, $old_group_name);
        }
    }

    // set success message
    drupal_set_message(t('Domains have been saved.'));

    // redirect to overview page
    $form_state['redirect'] = 'admin/config/framework/domain';

    return;
}

/**
 * Processes the Edit Domain and Edit Domain Groups forms
 *
 */
function matterhorn_domain_edit_domain_variables_submit($form, &$form_state) {
    global $language;

    // initiliaze variables from POST submit
    $type = $form_state['values']['type'];

    // set variables
    switch ($type) {
        case 'group':
            $gid = $form_state['values']['matterhorn_domain_group']['id'];
            $id = $type . ':' . $gid;
            $name = $form_state['values']['matterhorn_domain_group']['name'];
            $name_old_value = $form_state['values']['matterhorn_domain_group']['name_old_value'];
            break;
        case 'domain':
            $did = $form_state['values']['matterhorn_domain']['id'];
            $id = $type . ':' . $did;
            $name = $form_state['values']['matterhorn_domain']['name'];
            $name_old_value = $form_state['values']['matterhorn_domain']['name_old_value'];
            break;
    }

    $variables = isset($form_state['values']['matterhorn_domain_variables']) ? $form_state['values']['matterhorn_domain_variables'] : array();

    // then, insert the new domain/group variables
    if (isset($variables['current'])) {
        foreach ($variables['current'] as $key => $value) {
            if ($value != $variables['old'][$key]) {
                // remove the existing edited variables for this domain/group
                db_delete('matterhorn_domain_domain_variables')
                        ->condition('id', $id)
                        ->condition('name', $key)
                        ->condition('language', $language->language)
                        ->execute();
                // save the edited variables for this domain/group but empty
                if ($value != '') {
                    $variable = array(
                        'id' => $id,
                        'name' => $key,
                        'value' => $value,
                        'language' => $language->language,
                    );
                    drupal_write_record('matterhorn_domain_domain_variables', $variable);
                }
                $group_type = ($type == 'group') ? '_group' : '';
                matterhorn_domain_log('domain' . $group_type . '_placeholder', $name, $key, 'edit', $value, $variables['old'][$key]);
            }
        }
    }

    // save update and set success message based on the type
    if ($name != $name_old_value) {
        switch ($type) {
            case 'group':
                $group = array('id' => $gid, 'name' => $name);
                drupal_write_record('matterhorn_domain_groups', $group, 'id');
                matterhorn_domain_log('domain_group', $name, 'group_name', 'edit', $name, $name_old_value);
                drupal_set_message(t('Domain group %name has been updated.', array('%name' => $name)));
                break;
            case 'domain':
                $domain = array('id' => $did, 'domain' => $name);
                drupal_write_record('matterhorn_domain_domains', $domain, 'id');
                matterhorn_domain_log('domain', $name, 'domain_name', 'edit', $name, $name_old_value);
                drupal_set_message(t('Domain %name has been updated.', array('%name' => $name)));
                break;
        }
    }

    // redirect to overview page
    $form_state['redirect'] = 'admin/config/framework/domain';

    return;
}

/**
 * Processes the Add Domain Group form upon submit
 *
 */
function matterhorn_domain_groups_submit($form, &$form_state) {

    // check the POSTed values
    $name = $form_state['values']['matterhorn_domain_group']['name'];

    // create new domain group and get its id
    $group = array('name' => $name);
    drupal_write_record('matterhorn_domain_groups', $group);
    matterhorn_domain_log('domain_group', $name, 'group_name', 'add');

    // set success message
    drupal_set_message(t('New domain group %name has been added.', array('%name' => $name)));

    // redirect to overview page
    $form_state['redirect'] = 'admin/config/framework/domain';

    return;
}

/**
 * Processes the Add Placeholder form upon submit
 *
 */
function matterhorn_domain_variables_submit($form, &$form_state) {
    global $language;
    // get the POSTed data
    $key = $form_state['values']['name'];
    $value = $form_state['values']['value'];
    $description = $form_state['values']['description'];

    // set the success message
    drupal_set_message(t('The placeholder %key has been added.', array('%key' => $key)));

    // add the placeholder data to the database
    $variable = array(
        'name' => $key,
        'description' => $description,
    );
    drupal_write_record('matterhorn_domain_variables', $variable);
    matterhorn_domain_log('placeholder', 'NA', $key, 'add', $value, '');

    //get the last inserted id
    $id = $variable['id'];
    // update the placeholder language value
    if ($value != '') {
        $variables = array(
            'id' => 'variable:' . $id,
            'name' => $key,
            'value' => $value,
            'language' => $language->language,
        );
        drupal_write_record('matterhorn_domain_domain_variables', $variables);
        matterhorn_domain_log('placeholder_values', 'NA', $key, 'add', $value);
    }
    // redirect to the Placeholders Overview page
    $form_state['redirect'] = 'admin/config/framework/domain/variables';

    return;
}

/**
 * Processes the Edit Domain form upon submit
 *
 */
function matterhorn_domain_edit_variables_submit($form, &$form_state) {
    global $language;

    // get the POSTed data
    $id = $form_state['values']['id'];
    $key = $form_state['values']['name'];
    $value = $form_state['values']['value'];
    $description = $form_state['values']['description'];
    $domain_name = isset($form_state['values']['domain_name']) ? $form_state['values']['domain_name'] : 'NA';
    // set the success message
    drupal_set_message(t('The placeholder %key has been updated.', array('%key' => $key)));

    // update the placeholder on the database
    $variable = array(
        'id' => $id,
        'name' => $key,
        'description' => $description,
    );

    drupal_write_record('matterhorn_domain_variables', $variable, 'id');

    // remove the existing variables for this placeholder
    db_delete('matterhorn_domain_domain_variables')
            ->condition('id', 'variable:' . $id)
            ->condition('language', $language->language)
            ->execute();

    // update the placeholder language value
    if ($value != '') {
        $variables = array(
            'id' => 'variable:' . $id,
            'name' => $key,
            'value' => $value,
            'language' => $language->language,
        );
        drupal_write_record('matterhorn_domain_domain_variables', $variables);
        matterhorn_domain_log('placeholder_values', $domain_name, $key, 'edit', $value, $form_state['values']['name_old_value']);
    }
    // redirect to the Placeholders Overview page
    $form_state['redirect'] = 'admin/config/framework/domain/variables';

    return;
}

/**
 * Matterhorn domain database delete
 *
 */

/**
 * Processes the Delete Domain form upon submit
 *
 */
function matterhorn_domain_delete_domains_submit($form, &$form_state) {
    // check if the domain id to be deleted was passed
    if (isset($form_state['values']['id'])) {
        // get the domain to be deleted
        $id = $form_state['values']['id'];
        $domain = _matterhorn_domain_get_domain_name($id);
        // delete the domain
        db_delete('matterhorn_domain_domains')->condition('id', $id)->execute();
        // delete the domain variables
        $did = 'domain:' . $id;
        db_delete('matterhorn_domain_domain_variables')->condition('id', $did)->execute();
        matterhorn_domain_log('domain', $domain, 'domain_name', 'delete');
        // set the success message
        drupal_set_message(t('The domain %domain has been deleted.', array('%domain' => $domain)));
    }

    // redirect to overview page
    $form_state['redirect'] = 'admin/config/framework/domain';

    return;
}

/**
 * Processes the Delete Domain Group form upon submit
 *
 */
function matterhorn_domain_delete_groups_submit($form, &$form_state) {
    if (isset($form_state['values']['id']) && $form_state['values']['id'] != 1) {
        // get the domain group
        $id = $form_state['values']['id'];
        $group = _matterhorn_domain_get_group_name($id);

        // delete the domain group
        db_delete('matterhorn_domain_groups')->condition('id', $id)->execute();
        matterhorn_domain_log('domain_group', $group, 'group_name', 'delete');
        // move the domains under this domain group to the MAIN domain group
        db_update('matterhorn_domain_domains')->fields(array('group_id' => 1))->condition('group_id', $id, '=')->execute();
        // set the success message
        drupal_set_message(t('The domain group %group has been deleted.', array('%group' => $group)));
    }

    // set the redirect URL
    $form_state['redirect'] = 'admin/config/framework/domain';

    return;
}

/**
 * Processes the Delete Placeholder form upon submit
 *
 */
function matterhorn_domain_delete_variables_submit($form, &$form_state) {

    // check if the id of the variable for deletion was passed
    if (isset($form_state['values']['id'])) {
        // fetch the variable from database
        $id = $form_state['values']['id'];
        $key = _matterhorn_domain_get_variable_name($id);

        // delete the variable
        db_delete('matterhorn_domain_variables')->condition('id', $id)->execute();
        matterhorn_domain_log('placeholder', 'default', $key, 'delete', '', '');

        // delete domain and domain group variables
        db_delete('matterhorn_domain_domain_variables')->condition('name', $key)->execute();
        matterhorn_domain_log('placeholder_values', 'default', $key, 'delete', '', '');

        // set success message
        drupal_set_message(t('The placeholder %key has been deleted.', array('%key' => $key)));
    }

    // set redirect URL
    $form_state['redirect'] = 'admin/config/framework/domain/variables';

    return;
}
