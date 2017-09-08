<?php

/**
 * Matterhorn Domain Import Batch operation functions
 *
 */

/**
 * Fetches and validates the parsed excel data from the uploaded excel
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $path
 * @param array $context
 *
 */
function matterhorn_domain_import_get_parsed_data_batch($path, &$context) {
	$message = 'Checking excel file';
	matterhorn_domain_import_check_batch($message, $context);

	// prepare data
	$data = array();

	// check if excel parsing is successful
	$sheets = _matterhorn_domain_import_read_excel($path);
	if (empty($sheets)) {
		_matterhorn_domain_import_batch_stop('EXCEL_ERROR_PARSING', $context);
		return;
	}

	// check if excel file is valid
	$valid = _matterhorn_domain_import_check_excel($sheets);
	if (empty($valid)) {
		_matterhorn_domain_import_batch_stop('EXCEL_INVALID_FILE', $context);
		return;
	}

	// throw raw data to parser object
	$parser = new Matterhorn\Domains\ImportParser($sheets);

	// check if excel format is valid
	$valid = $parser->validate();
	if ($valid !== 'EXCEL_FORMAT_OK') {
		_matterhorn_domain_import_batch_stop($valid, $context);
		return;
	}

	// gets the data from parser object
	$context['results']['data']['groups'] = $parser->excel_get_domain_groups();
	$context['results']['data']['domains'] = $parser->excel_get_domains();
	$context['results']['data']['languages'] = $parser->excel_get_languages();
	// $context['results']['data']['tokens'] = $parser->excel_get_placeholders_description();

	// gets the variable values per language
	foreach ($context['results']['data']['languages'] as $lang) {
		$context['results']['data']['placeholders'][$lang] = $parser->excel_get_placeholders($lang);
		$context['results']['data']['variables'][$lang] = $parser->excel_get_variables($lang);
	}

	return;
}

/**
 * Parses the excel data from a migration attempt
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $path
 * @param array $context
 *
 */
function matterhorn_domain_import_set_parsed_data_migrate($data, &$context) {

	$message = 'Starting Matterhorn Domain migration';
	matterhorn_domain_import_check_batch($message, $context);

	$parser = new Matterhorn\Domains\ImportParser($data);

	// gets the data from parser object
	$context['results']['data']['groups'] = $parser->excel_get_domain_groups();
	$context['results']['data']['domains'] = $parser->excel_get_domains();
	$context['results']['data']['languages'] = $parser->excel_get_languages();
	// $context['results']['data']['tokens'] = $parser->excel_get_placeholders_description();

	// gets the variable values per language
	foreach ($context['results']['data']['languages'] as $lang) {
		$context['results']['data']['placeholders'][$lang] = $parser->excel_get_placeholders($lang);
		$context['results']['data']['variables'][$lang] = $parser->excel_get_variables($lang);
	}

	return;
}

/**
 * Process import of domain groups and domains
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $context
 *
 */
function matterhorn_domain_import_groups_domains(&$context) {
	$message = 'Importing domain and domain groups';
	$check = matterhorn_domain_import_check_batch($message, $context);

	// terminate script on error
	if (empty($check)) {
		return;
	}

	// construct domain data
	$groups = $context['results']['data']['groups'];
	$domains = $context['results']['data']['domains'];

	// import domain groups and domains
	_matterhorn_domain_import_groups_submit($groups);
	_matterhorn_domain_import_add_domains_submit($domains);
}

/**
 * Process import of placeholders per language
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $lang
 * @param array $context
 *
 */
function matterhorn_domain_import_placeholders($lang, &$context) {
	$message = 'Importing placholders on language ' . strtoupper($lang);
	$check = matterhorn_domain_import_check_batch($message, $context);

	// terminate script on error
	if (empty($check)) {
		return;
	}

	// construct placeholder data
	$placeholders = $context['results']['data']['placeholders'];

	// import placeholders
	_matterhorn_domain_import_variables_submit($placeholders, $lang);
}

/**
 * Process import of tokens per domain and per language
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $lang
 * @param array $context
 *
 */
function matterhorn_domain_import_tokens($lang, &$context) {
	$message = 'Importing tokens on language ' . strtoupper($lang);
	$check = matterhorn_domain_import_check_batch($message, $context);

	// terminate script on error
	if (empty($check)) {
		return;
	}

	// construct token data
	$domains = $context['results']['data']['variables'];

	// import tokens epr domain
	_matterhorn_domain_import_edit_domain_variables_submit($domains, $lang);
}

/**
 * Callback function for batch process finished
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $success
 * @param array $results
 * @param array $operations
 *
 */
function matterhorn_domain_import_batch_finish($success, $results, $operations) {
	// capture if operation was not successful
	if (!$success || isset($results['error'])) {
		// check if an error occured within the batch processing
		if (isset($results['error']) && $results['error']['status'] == 1) {
			// handle error scenarios based on error code
			$code = $results['error']['message'];
			switch ($code) {
				case 'EXCEL_INVALID_FILE':
					drupal_set_message('The excel file you uploaded is invalid, please check your file and try again', 'error');
					return;
					break;
				case 'EXCEL_IMPROPER_FORMAT':
					drupal_set_message('The excel file you uploaded is valid but is not formatted properly, please check your file and try again', 'error');
					return;
					break;
				case 'EXCEL_FORMAT_INVALID_COLUMNS':
					drupal_set_message('The excel file you uploaded is valid but the tokens are not same across all languages, please check your file and try again', 'error');
					return;
					break;
				case 'EXCEL_FORMAT_DOMAINS_MISMATCH':
					drupal_set_message('The excel file you uploaded is valid but the domains are not the same across all languages, please check your file and try again', 'error');
					return;
					break;
				case 'EXCEL_FORMAT_COLUMNS_DUPLICATES':
					drupal_set_message('The excel file you uploaded is valid but there are duplicate token entries detected, please check your file and try again', 'error');
					return;
					break;
				case 'EXCEL_FORMAT_DOMAINS_DUPLICATES':
					drupal_set_message('The excel file you uploaded is valid but there are duplicate domain entries detected, please check your file and try again', 'error');
					return;
					break;
			}
		}

		drupal_set_message('Import operation returned an error, please see logs for further details', 'error');
		return;
	}

	// Invoke domain backup first
	matterhorn_domain_import_backup_domains();
	// switch temporary matterhorn_data as live
	matterhorn_domain_import_switch_domains();

	// allow revert to be initiated
	$time = format_date( time() , 'custom', 'm-d-Y h:i:A');
	variable_set('matterhorn_domain_reverted', FALSE);
	variable_set('matterhorn_domain_last_import_time', $time);

	// relase lock
	matterhorn_domain_import_lock('RELEASE');

	// inform user the operation has completed
	drupal_set_message();
	drupal_set_message('Import operation has been completed!');
	return;
}

/**
 * Matterhorn Domain Import Batch helper functions
 *
 */

/**
 * Checks the status of the entire batch
 * Assures that each batch import operation acquires proper locking
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $message - the message to be shown on the loading screen
 * @param array $context
 *
 */
function matterhorn_domain_import_check_batch($message, &$context) {
	// acquire lock
	matterhorn_domain_import_lock();

	// check if error has occurred
	// stop the rest of the batch process upon error
	if (isset($context['results']['error']) && $context['results']['error']['status'] == 1) {
		$context['message'] = 'Cancelling import operation';
		$context['finished'] = 1;
		$context['success'] = FALSE;
		return FALSE;
	}

	$context['message'] = $message;
	return TRUE;
}

/**
 * Stops the entire batch operation
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $message - the error code
 * @param array $context
 *
 */
function _matterhorn_domain_import_batch_stop($message, &$context) {
	$context['finished'] = 1;
	$context['success'] = FALSE;
	$context['results']['error']['status'] = 1;
	$context['results']['error']['message'] = $message;
	return;
}