<?php

/**
 * Function for managing MAPPING
 *
 */
function matterhorn_domain_admin_mapping() {
    $form['matterhorn_domain_mapping_enable'] = array(
        '#type' => 'checkbox',
        '#title' => t('Enable Domain Mapping from Cookie'),
        '#default_value' => variable_get('matterhorn_domain_mapping_enable', false),
        '#description' => t('Enable domain mapping for the specified domains below.'),
    );
    $form['matterhorn_domain_mapping'] = array(
        '#type' => 'textarea',
        '#title' => t('Domain Mapping'),
        '#default_value' => variable_get('matterhorn_domain_mapping'),
        '#description' => t('The domains wherein domain mapping will be enabled. One item per line.'),
    );

    return system_settings_form($form);
}

/**
 * Function for managing SETTINGS
 *
 */
function matterhorn_domain_admin_settings() {
    $form['matterhorn_domain_legacy'] = array(
        '#type' => 'checkbox',
        '#title' => t('Legacy Matterhorn Domain'),
        '#default_value' => variable_get('matterhorn_domain_legacy', TRUE),
        '#description' => t('Enabling this option will allow entire Matterhorn Domains to use the old behavior and schema.'),
    );
    $form['matterhorn_domain_token'] = array(
        '#type' => 'textfield',
        '#title' => t('Domain Token'),
        '#default_value' => variable_get('matterhorn_domain_token', 'matterhorn'),
        '#description' => t('A text that can be placed into larger documents via simple placeholders, like [site]'),
    );
    $form['matterhorn_domain_row_limit'] = array(
        '#type' => 'select',
        '#title' => t('Discard log entries above the following row limit'),
        '#default_value' => variable_get('matterhorn_domain_row_limit', 1000),
        '#options' => drupal_map_assoc(array(100, 1000, 10000, 100000, 1000000)),
        '#description' => t('The maximum number of rows to keep in the database log. Older entries will be automatically discarded. (Requires a correctly configured <a href="@cron">cron maintenance task</a>.)', array('@cron' => url('admin/reports/status')))
    );

    return system_settings_form($form);
}

/**
 * Function for managing DOMAINS
 *
 */

/**
 * Displays the domain overview page
 *
 * The overview page allows users to add new domains, edit/delete domains and domain groups,
 * and re-assign domains to other domain groups.
 *
 */
function matterhorn_domain_domains() {
    $group_add = drupal_get_form('matterhorn_domain_add_groups');
    $domain_add = drupal_get_form('matterhorn_domain_add_domains');
    $domain_list = drupal_get_form('matterhorn_domain_list_domains');
    return drupal_render($group_add) . drupal_render($domain_add) . drupal_render($domain_list);
}

/**
 * Displays the Add Domain form
 *
 */
function matterhorn_domain_add_domains() {
    $form = array();

    $form['matterhorn_domain'] = array(
        '#type' => 'fieldset',
        '#title' => t('Add Domain'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );
    $form['matterhorn_domain']['group_id'] = array(
        '#type' => 'select',
        '#title' => t('Domain Group'),
        '#default_value' => 1,
        '#options' => _matterhorn_domain_get_domain_groups(),
        '#description' => t('Specify the domain group.'),
        '#required' => TRUE,
    );
    $form['matterhorn_domain']['name'] = array(
        '#type' => 'textfield',
        '#title' => t('Domain Name'),
        '#default_value' => '',
        '#description' => t('Specify the domain name, e.g. example.org or domain.com'),
        '#required' => TRUE,
    );
    $form['matterhorn_domain']['submit'] = array('#type' => 'submit', '#value' => t('Add Domain'));
    $form['#validate'][] = 'matterhorn_domain_domains_validate';
    $form['#submit'][] = 'matterhorn_domain_add_domains_submit';
    $form['#tree'] = TRUE;
    return $form;
}

/**
 * Displays the Domain List form (allows assignment of domains to other groups)
 *
 */
function matterhorn_domain_list_domains() {

    $form = array();

    // use block.css for additional style
    $form['#attached']['css'] = array(drupal_get_path('module', 'matterhorn_domain') . '/assets/matterhorn_domain.css');

    $form['domains'] = array(
        '#tree' => TRUE
    );

    // get the list of domain groups for the dropdown field
    $groups = _matterhorn_domain_get_domain_groups();

    // get the domain groups and domains
    $domains = _matterhorn_domain_get_domain_groups_with_domains();

    // options for weight dropdown field
    $weights = array();
    for ($a = (0 - $domains['count']); $a <= $domains['count']; $a++) {
        $weights[$a] = $a;
    }

    // build the dropdown field for each domain
    $count = 1;
    foreach ($domains['groups'] as $group) {
        foreach ($group['domains'] as $domain) {

            $form['domains'][$domain['id']]['id'] = array(
                '#type' => 'value',
                '#value' => $domain['id'],
            );
            $form['domains'][$domain['id']]['name'] = array(
                '#value' => $domain['domain'],
            );
            $form['domains'][$domain['id']]['group'] = array(
                '#type' => 'select',
                '#options' => $groups,
                '#default_value' => $group['id'],
            );
            $form['domains'][$domain['id']]['old_group'] = array(
                '#type' => 'hidden',
                '#default_value' => $group['id'],
            );
            $form['domains'][$domain['id']]['weight'] = array(
                '#type' => 'select',
                '#options' => $weights,
                '#default_value' => $domain['weight'],
                '#weight' => $count++,
            );
            $form['domains'][$domain['id']]['edit'] = array(
                '#type' => 'link',
                '#title' => t('edit'),
                '#href' => 'admin/config/framework/domain/domains/edit/' . $domain['id'],
            );
            $form['domains'][$domain['id']]['delete'] = array(
                '#type' => 'link',
                '#title' => t('delete'),
                '#href' => 'admin/config/framework/domain/domains/delete/' . $domain['id'],
            );
        }
    }

    $form['submit'] = array('#type' => 'submit', '#value' => t('Save Domains'));

    return $form;
}

/**
 * Processes variables for matterhorn-domain-list-domains.tpl.php
 *
 * The $variables array contains the following arguments:
 * - $form
 *
 * @see matterhorn-domain-list-domains.tpl.php
 * @see matterhorn_domain_list_domains()
 */
function template_preprocess_matterhorn_domain_list_domains(&$variables) {

    $groups = _matterhorn_domain_get_domain_groups();
    $variables['groups'] = array();
    // Initialize an groups.
    foreach ($groups as $key => $value) {
        $variables['groups'][$key]['title'] = $value;
        $variables['groups'][$key]['edit_link'] = l(t('edit'), 'admin/config/framework/domain/groups/edit/' . $key);
        $variables['groups'][$key]['delete_link'] = '';
        if ($key != 2) {
            $variables['groups'][$key]['delete_link'] = l(t('delete'), 'admin/config/framework/domain/groups/delete/' . $key);
        }
    }

    // Add each domain in the form to the appropriate place in the domain listing.
    foreach (element_children($variables['form']['domains']) as $i) {
        $domain = &$variables['form']['domains'][$i];

        // Fetch the group for the current domain.
        $group = $domain['group']['#default_value'];

        // Set special classes needed for table drag and drop.
        $domain['group']['#attributes']['class'] = array('block-region-select', 'block-region-' . $group);
        $domain['weight']['#attributes']['class'] = array('block-weight', 'block-weight-' . $group);

        $variables['domains'][$group][$i] = new stdClass();
        $variables['domains'][$group][$i]->row_class = !empty($domain['#attributes']['class']) ? implode(' ', $domain['#attributes']['class']) : '';
        $variables['domains'][$group][$i]->domain_modified = !empty($domain['#attributes']['class']) && in_array('block-modified', $domain['#attributes']['class']);
        $variables['domains'][$group][$i]->name = $domain['name']['#value'];
        $variables['domains'][$group][$i]->domain_select = drupal_render($domain['group']) . drupal_render($domain['theme']);
        $variables['domains'][$group][$i]->weight_select = drupal_render($domain['weight']);
        $variables['domains'][$group][$i]->edit_link = drupal_render($domain['edit']);
        $variables['domains'][$group][$i]->delete_link = !empty($domain['delete']) ? drupal_render($domain['delete']) : '';
    }

    $variables['form_submit'] = drupal_render_children($variables['form']);
}

/**
 * Displays the Delete Domain form
 *
 */
function matterhorn_domain_delete_domains($form, &$form_state, $id) {

    // check if the domain exists
    $domain = _matterhorn_domain_get_domain_name($id);

    if ($domain) {
        // build the form
        $form['matterhorn_domain']['id'] = array('#type' => 'value', '#value' => $id);

        return confirm_form(
                $form, t('Are you sure you want to delete the domain %domain?', array('%domain' => $domain)), 'admin/config/framework/domain', '<p>' . t('This action cannot be undone.') . '</p>', t('Delete'), t('Cancel')
        );
    } else {
        drupal_not_found();
        exit;
    }
}

/**
 * Function for managing GROUPS
 *
 */

/**
 * Displays the Add Domain Group form
 *
 */
function matterhorn_domain_add_groups() {

    $form = array();

    $form['matterhorn_domain_group'] = array(
        '#type' => 'fieldset',
        '#title' => t('Add Domain Group'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
        '#weight' => 0
    );
    $form['matterhorn_domain_group']['name'] = array(
        '#type' => 'textfield',
        '#title' => t('Domain Group Name'),
        '#description' => t('Specify the name of the new domain group'),
        '#required' => TRUE,
    );

    $form['matterhorn_domain_group']['matterhorn_domain_submit'] = array('#type' => 'submit', '#value' => t('Add Domain Group'), '#weight' => 10);

    $form['#validate'][] = 'matterhorn_domain_groups_validate';
    $form['#submit'][] = 'matterhorn_domain_groups_submit';
    $form['#tree'] = TRUE;
    return $form;
}

/**
 * Displays the Delete Domain Group form
 *
 */
function matterhorn_domain_delete_groups($form, &$form_state, $id) {

    // check if the domain group exists
    $group = _matterhorn_domain_get_group_name($id);

    if ($id != 1 && $group) {
        // build the form!
        $form['matterhorn_domain']['id'] = array('#type' => 'value', '#value' => $id);

        return confirm_form(
                $form, t('Are you sure you want to delete %group?', array('%group' => $group)), 'admin/config/framework/domain', '<p>' . t('Deleting a domain group will move all groups under it to the MAIN domain group. This action cannot be undone.') . '</p>', t('Delete'), t('Cancel')
        );
    } else {
        drupal_not_found();
        exit;
    }
}

/**
 * Function for managing VARIABLES
 *
 */

/**
 * Displays the Placeholders Overview page
 *
 */
function matterhorn_domain_variables() {

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
    $form['matterhorn_domain_variable'] = array(
        '#type' => 'fieldset',
        '#title' => t('Add Placeholder'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );
    $form['matterhorn_domain_variable']['name'] = array(
        '#type' => 'textfield',
        '#title' => t('Placeholder Key'),
        '#default_value' => '',
        '#description' => t('Unique identifier for the placeholder. Use only numbers, letters, -, and _.'),
        '#required' => TRUE,
        '#weight' => 0
    );
    $form['matterhorn_domain_variable']['value'] = array(
        '#type' => 'textarea',
        '#title' => t('Default Value'),
        '#default_value' => '',
        '#rows' => 3,
        '#weight' => 5
    );
    $form['matterhorn_domain_variable']['description'] = array(
        '#type' => 'textarea',
        '#title' => t('Description'),
        '#default_value' => '',
        '#rows' => 3,
        '#description' => t('Describe what this placeholder is used for, e.g. for GA codes, or for CDN paths'),
        '#weight' => 10
    );
    $form['matterhorn_domain_variable']['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Add Placeholder'),
        '#weight' => 15,
    );

    $form['#validate'][] = 'matterhorn_domain_variables_validate';
    $form['#submit'][] = 'matterhorn_domain_variables_submit';
    $form['#theme'] = 'matterhorn_domain_variables';

    return $form;
}

/**
 * Theme for the Placeholders Overview page
 *
 * Adds the Add Placeholder form at the start of the page
 *
 */
function theme_matterhorn_domain_variables($variables) {
    global $language;

    $form = $variables['form'];

    // get the list of placeholders
    $variables = _matterhorn_domain_get_all_variables();

    // populate the rows for the table
    if (empty($variables)) {
        $output = t('There are no defined placeholders.');
    } else {
        $rows = array();
        foreach ($variables as $var) {
            //get value by language
            $vid = 1;

            // get legacy option
            if ($legacy = variable_get('matterhorn_domain_legacy', TRUE))
                $vid = 'variable:' . $var['id'];

            $value = _matterhorn_domain_get_variables_by_id($vid, $language->language);

            $rows[] = array(
                '<strong>' . $var['name'] . '</strong>',
                (isset($value[$var['name']]['value'])) ? $value[$var['name']]['value'] : '',
                l(t('edit'), 'admin/config/framework/domain/variables/edit/' . $var['id']) .
                ' &nbsp; ' . l(t('delete'), 'admin/config/framework/domain/variables/delete/' . $var['id']),
            );
        }

        $header = array(
            array('data' => 'Key'),
            array('data' => 'Default Value'),
            array('data' => 'Operations')
        );

        $output = t('The following are the available placeholder(s):');
        // build the table
        $output .= theme('table', array('header' => $header, 'rows' => $rows));
    }

    // add the form before the table
    return drupal_render_children($form) . $output;
}

/**
 * Displays the Delete Placeholder form
 *
 */
function matterhorn_domain_delete_variables($form, &$form_state, $id) {

    $variable = _matterhorn_domain_get_variable_name($id);

    if ($variable) {
        // build the form!
        $form['matterhorn_domain']['id'] = array('#type' => 'value', '#value' => $id);

        return confirm_form(
                $form, t('Are you sure you want to delete the placeholder %var?', array('%var' => $variable)), 'admin/config/framework/domain/variables', '<p>' . t('This action cannot be undone.') . '</p>', t('Delete'), t('Cancel')
        );
    } else {
        drupal_not_found();
        exit;
    }
}

/**
 * Function for managing Import and Export
 *
 */

/**
 * Form callback for Domain import
 *
 */
function matterhorn_domain_import() {

    // Import form
    $form['matterhorn_domain_import'] = array(
        '#type' => 'fieldset',
        '#title' => t('Import from excel'),
        '#description' => t('Allows an excel file containing values for Matterhorn domain to be imported. To edit current domains using excel, use the export function to generate an excel file then use this tab to import edited excel file.'),
    );
    $form['matterhorn_domain_import']['file'] = array(
        '#type' => 'file',
        '#title' => t('Choose an excel file'),
        '#title_display' => 'invisible',
        '#attributes' => array(
            'accept' => '.xls, .xlsx',
        ),
        '#description' => t('Allowed excel extensions: xls, xlsx'),
    );
    $form['matterhorn_domain_import']['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Import'),
        '#submit' => array('matterhorn_domain_import_batch_upload'),
    );
    $form['matterhorn_domain_import']['#attributes'] = array(
        'enctype' => 'multipart/form-data'
    );

    // Revert form
    $form['matterhorn_domain_import_revert'] = array(
        '#type' => 'fieldset',
        '#title' => t('Revert last import'),
        '#description' => t('Allows you to revert to the data before the last import operation has been made.'),
    );

    // Shows a message notifying user that revert is disabled
    if (variable_get('matterhorn_domain_reverted', FALSE)) {
        $form['matterhorn_domain_import_revert']['label'] = array(
            '#markup' => '<p class="error">A revert operation was previously initiated.</p>',
        );
    } else {
        $time = variable_get('matterhorn_domain_last_import_time', 'No Import done yet');
        $form['matterhorn_domain_import_revert']['label'] = array(
            '#markup' => "<div class='description'><p><span><b>Last date of import:</b> </span> {$time} </p></div>",
        );
    }

    $form['matterhorn_domain_import_revert']['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Revert'),
        '#submit' => array('matterhorn_domain_import_revert'),
    );

    // Prevents running the revert command on a reverted domain
    if (variable_get('matterhorn_domain_reverted', FALSE)) {
        $form['matterhorn_domain_import_revert']['submit']['#attributes'] = array(
            'class' => array('form-button-disabled'),
            'disabled' => array('disabled'),
        );
    }

    return $form;
}

/**
 * Processes the file upload submit operation
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 *
 */
function matterhorn_domain_import_batch_upload() {

    // check if a file has been selected
    if (empty($_FILES['files']['name']['file'])) {
        drupal_set_message(t('No files selected.'), 'error');
        return;
    }

    // check if an import operation is ongoing
    $lock = matterhorn_domain_import_lock();
    if (!$lock) {
        drupal_set_message(t('Import operation cancelled! There is an ongoing import operation.'), 'error');
        return;
    }

    // define file upload validators
    $validators = array(
        'file_validate_extensions' => array('xls xlsx'),
        'file_validate_size' => array(10000000), // 10 megabytes
    );

    // attempt to save uploaded file to server
    $file = file_save_upload('file', $validators, FALSE, FILE_EXISTS_REPLACE);
    if ($file) {
        // get the real server path of the file
        $filename = $_FILES['files']['name']['file'];
        // $filename = 'matterhorn_domain_excel.xlsx';
        $real_path = file_directory_temp() . '//' . $filename;

        // execute import operation on uploaded excel file using batch processing
        matterhorn_domain_import_batch_process($real_path);
        return;
    }

    // something went wrong
    drupal_set_message('Cannot save uploaded file', 'error');
}

/**
 * Processes the revert submit operation
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 *
 */
function matterhorn_domain_import_revert() {
    // prevents running the revert command on a reverted domain
    if (variable_get('matterhorn_domain_reverted', FALSE)) {
        drupal_set_message(t('Revert operation cancelled. A revert operation was already initiated.'), 'error');
        return;
    }
    // initiate revert operation
    $result = matterhorn_domain_import_revert_domains();
    // check status of revert operation
    if ($result) {
        drupal_set_message(t('Matterhorn Domains was reverted succesfully.'));
        variable_set('matterhorn_domain_reverted', TRUE);
    } else {
        drupal_set_message(t('Matterhorn Domains Revert operation was not successful. Please see logs for details.'), 'error');
    }
}

/**
 * Form callback for Domain export
 *
 */
function matterhorn_domain_export() {

    $legacy = variable_get('matterhorn_domain_legacy', TRUE);

    // Revert form
    $form['matterhorn_domain_export'] = array(
        '#type' => 'fieldset',
        '#title' => t('Export Domains'),
        '#description' => t('Allows you to export all domain data to an editable spreadsheet file.'),
    );
    $form['matterhorn_domain_export']['label'] = array(
        '#markup' => '<p></p>',
    );
    $form['matterhorn_domain_export']['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Export'),
        '#submit' => array('matterhorn_domain_export_excel'),
    );

    if ($legacy) {
        // set form controls to legacy
        $form['matterhorn_domain_export']['#title'] = t('Export Domains (Legacy)');
        $form['matterhorn_domain_export']['submit']['#submit'] = array('matterhorn_domain_legacy_export_excel');
    }

    return $form;
}

/**
 * Function for managing LOGS
 *
 */
function matterhorn_domain_list_log() {

    $search_log = drupal_get_form('matterhorn_domain_search_log');
    $html = drupal_render($search_log);

    $header = array(
        array('data' => 'Scope', 'field' => 'log.scope'),
        array('data' => 'User', 'field' => 'user.name'),
        array('data' => 'Domain/Domain Group', 'field' => 'log.parent_name'),
        array('data' => 'Field', 'field' => 'log.field_name'),
        array('data' => 'Lang', 'field' => 'log.language'),
        array('data' => 'Action', 'field' => 'log.action'),
        array('data' => 'Old Value', 'field' => 'log.old_value'),
        array('data' => 'New Value', 'field' => 'log.new_value'),
        array('data' => 'Timestamp', 'field' => 'log.created', 'sort' => 'desc')
    );

    $query = db_select('matterhorn_domain_log', 'log')->extend('PagerDefault')->extend('TableSort');
    $query->join('users', 'user', 'user.uid = log.uid');
    $query->fields('log')->fields('user', array('name'));

    if (isset($_GET['scope']))
        $query->condition('log.scope', $_GET['scope']);
    if (isset($_GET['name']))
        $query->condition('user.name', $_GET['name']);
    if (isset($_GET['domain']))
        $query->condition('log.parent_name', $_GET['domain']);
    if (isset($_GET['field']))
        $query->condition('log.field_name', $_GET['field']);
    if (isset($_GET['lang']))
        $query->condition('log.language', $_GET['lang']);
    if (isset($_GET['action']))
        $query->condition('log.action', $_GET['action']);
    if (isset($_GET['value'])) {
        $or_statement = db_or()
                ->condition('log.old_value', '%' . db_like($_GET['value']) . '%', 'LIKE')
                ->condition('log.new_value', '%' . db_like($_GET['value']) . '%', 'LIKE');
        $query->condition($or_statement);
    }

    $result = $query->limit(20)->orderByHeader($header)->execute();

    $rows = array();
    foreach ($result as $row) {
        $rows[] = array(
            $row->scope, $row->name, $row->parent_name, $row->field_name, $row->language, $row->action,
            $row->old_value, $row->new_value, format_date($row->created, 'small')
        );
    }
    $html .= theme('table', array('header' => $header, 'rows' => $rows));
    //$output = theme('table', $header, $data);
    $html .= theme('pager');

    return $html;
}

/**
 * Form for searching LOGS
 *
 */
function matterhorn_domain_search_log() {
    $form['#attributes'] = array('class' => 'container-inline');

    $form['scope'] = array(
        '#type' => 'textfield',
        '#title' => t('Scope'),
        '#default_value' => (isset($_GET['scope'])) ? $_GET['scope'] : '',
        '#autocomplete_path' => 'admin/config/framework/domain/changelog/scope',
        '#size' => 15,
    );
    $form['user'] = array(
        '#type' => 'textfield',
        '#title' => t('User'),
        '#default_value' => (isset($_GET['user'])) ? $_GET['user'] : '',
        '#autocomplete_path' => 'admin/config/framework/domain/changelog/user',
        '#size' => 15,
    );
    $form['domain'] = array(
        '#type' => 'textfield',
        '#title' => t('Domain/Group'),
        '#default_value' => (isset($_GET['domain'])) ? $_GET['domain'] : '',
        '#autocomplete_path' => 'admin/config/framework/domain/changelog/domain',
        '#size' => 15,
    );
    $form['field'] = array(
        '#type' => 'textfield',
        '#title' => t('Field'),
        '#default_value' => (isset($_GET['field'])) ? $_GET['field'] : '',
        '#autocomplete_path' => 'admin/config/framework/domain/changelog/field',
        '#size' => 15,
    );
    $form['lang'] = array(
        '#type' => 'textfield',
        '#title' => t('Lang'),
        '#default_value' => (isset($_GET['lang'])) ? $_GET['lang'] : '',
        '#autocomplete_path' => 'admin/config/framework/domain/changelog/lang',
        '#size' => 5,
    );
    $form['action'] = array(
        '#type' => 'textfield',
        '#title' => t('Action'),
        '#default_value' => (isset($_GET['action'])) ? $_GET['action'] : '',
        '#autocomplete_path' => 'admin/config/framework/domain/changelog/action',
        '#size' => 10,
    );
    $form['value'] = array(
        '#type' => 'textfield',
        '#title' => t('Value'),
        '#default_value' => (isset($_GET['value'])) ? $_GET['value'] : '',
        '#size' => 30,
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Show Logs'),
    );
    return $form;
}

/**
 * Function for searching LOGS submit
 *
 */
function matterhorn_domain_search_log_submit($form, &$form_state) {

    $value = $form_state['values'];
    $queries = array();
    if ($value['scope'])
        $queries['scope'] = $value['scope'];
    if ($value['user'])
        $queries['user'] = $value['user'];
    if ($value['domain'])
        $queries['domain'] = $value['domain'];
    if ($value['field'])
        $queries['field'] = $value['field'];
    if ($value['lang'])
        $queries['lang'] = $value['lang'];
    if ($value['action'])
        $queries['action'] = $value['action'];
    if ($value['value'])
        $queries['value'] = $value['value'];

    drupal_goto('admin/config/framework/domain/changelog', array('query' => $queries));
}
