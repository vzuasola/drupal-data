<?php

/**
 * Initializes the import operation using batch processing
 *
 * @param string $path - the server path of the excel file
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 *
 */
function matterhorn_domain_import_batch_process($path) {
	// initialize operation context
	$operation = array(
        'title' => t('Matterhorn Domain Import Operation'),
        'init_message' => t('Initializing import operation...'),
        'finished' => 'matterhorn_domain_import_batch_finish',
        'file' => 'matterhorn_domain.import.batch.inc',
    );

	// define operations to do on batch
	$operation['operations'][] = array(
		'matterhorn_domain_import_get_parsed_data_batch', array($path),
	);

	$operation['operations'][] = array(
		'matterhorn_domain_import_groups_domains', array(),
	);

	foreach ( language_list() as $language => $languages ) {
		$operation['operations'][] = array(
			'matterhorn_domain_import_placeholders', array($language),
		);
	}

	foreach ( language_list() as $language => $languages ) {
		$operation['operations'][] = array(
			'matterhorn_domain_import_tokens', array($language),
		);
	}

	matterhorn_domain_import_truncate_table();
	matterhorn_domain_import_set_defaults();
	batch_set($operation);
}

/**
 * Initializes the import migration using batch processing
 *
 * @param string $path - the server path of the excel file
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 *
 */
function matterhorn_domain_import_batch_migrate($data) {
	// initialize operation context
	$operation = array(
        'title' => t('Matterhorn Domain Import Operation'),
        'init_message' => t('Initializing migrate operation...'),
        'finished' => 'matterhorn_domain_import_batch_finish',
        'file' => 'matterhorn_domain.import.batch.inc',
    );

	// define operations to do on batch
	$operation['operations'][] = array(
		'matterhorn_domain_import_set_parsed_data_migrate', array($data),
	);

	$operation['operations'][] = array(
		'matterhorn_domain_import_groups_domains', array(),
	);

	foreach ( language_list() as $language => $languages ) {
		$operation['operations'][] = array(
			'matterhorn_domain_import_placeholders', array($language),
		);
	}

	foreach ( language_list() as $language => $languages ) {
		$operation['operations'][] = array(
			'matterhorn_domain_import_tokens', array($language),
		);
	}

	matterhorn_domain_import_truncate_table();
	matterhorn_domain_import_set_defaults();
	batch_set($operation);
}

/**
 * Switches the contents of the original domains table with the temporary table
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @return boolean
 *
 */
function matterhorn_domain_import_switch_domains() {
	try {
		// rename live table as temporary table
		db_rename_table('new_matterhorn_domain_domain_variables', 'x_matterhorn_domain_domain_variables');
		db_rename_table('new_matterhorn_domain_domains', 'x_matterhorn_domain_domains');
		db_rename_table('new_matterhorn_domain_variables', 'x_matterhorn_domain_variables');
		// rename temp table as live table
		db_rename_table('temp_matterhorn_domain_domain_variables', 'new_matterhorn_domain_domain_variables');
		db_rename_table('temp_matterhorn_domain_domains', 'new_matterhorn_domain_domains');
		db_rename_table('temp_matterhorn_domain_variables', 'new_matterhorn_domain_variables');
		// rename temporary table as backup table
		db_rename_table('x_matterhorn_domain_domain_variables', 'temp_matterhorn_domain_domain_variables');
		db_rename_table('x_matterhorn_domain_domains', 'temp_matterhorn_domain_domains');
		db_rename_table('x_matterhorn_domain_variables', 'temp_matterhorn_domain_variables');
		// operation successful
		return TRUE;
	} catch (Exception $e) {
		// exception has occured
		return FALSE;
	}
}

/**
 * Reverts to the last backed up domains table
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @return array $result
 *
 */
function matterhorn_domain_import_revert_domains() {
	try {
		// rename live table as temporary table
		db_rename_table('new_matterhorn_domain_domain_variables', 'x_matterhorn_domain_domain_variables');
		db_rename_table('new_matterhorn_domain_domains', 'x_matterhorn_domain_domains');
		db_rename_table('new_matterhorn_domain_variables', 'x_matterhorn_domain_variables');
		// rename temp table as live table
		db_rename_table('backup_matterhorn_domain_domain_variables', 'new_matterhorn_domain_domain_variables');
		db_rename_table('backup_matterhorn_domain_domains', 'new_matterhorn_domain_domains');
		db_rename_table('backup_matterhorn_domain_variables', 'new_matterhorn_domain_variables');
		// rename temporary table as backup table
		db_rename_table('x_matterhorn_domain_domain_variables', 'backup_matterhorn_domain_domain_variables');
		db_rename_table('x_matterhorn_domain_domains', 'backup_matterhorn_domain_domains');
		db_rename_table('x_matterhorn_domain_variables', 'backup_matterhorn_domain_variables');
		// operation successful
		$time = format_date( time() , 'custom', 'm-d-Y h:i:A');
		variable_set('matterhorn_domain_last_revert_time', $time);
		return TRUE;
	} catch (Exception $e) {
		// exception has occured
		return FALSE;
	}
}

/**
 * Backup the live table to the backup table
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @return array $result
 *
 */
function matterhorn_domain_import_backup_domains() {
	try {
		// rename live table as temporary table
		db_rename_table('new_matterhorn_domain_domain_variables', 'x_matterhorn_domain_domain_variables');
		db_rename_table('new_matterhorn_domain_domains', 'x_matterhorn_domain_domains');
		db_rename_table('new_matterhorn_domain_variables', 'x_matterhorn_domain_variables');
		// rename temp table as live table
		db_rename_table('backup_matterhorn_domain_domain_variables', 'new_matterhorn_domain_domain_variables');
		db_rename_table('backup_matterhorn_domain_domains', 'new_matterhorn_domain_domains');
		db_rename_table('backup_matterhorn_domain_variables', 'new_matterhorn_domain_variables');
		// rename temporary table as backup table
		db_rename_table('x_matterhorn_domain_domain_variables', 'backup_matterhorn_domain_domain_variables');
		db_rename_table('x_matterhorn_domain_domains', 'backup_matterhorn_domain_domains');
		db_rename_table('x_matterhorn_domain_variables', 'backup_matterhorn_domain_variables');
		// operation successful
		return TRUE;
	} catch (Exception $e) {
		// exception has occured
		return FALSE;
	}
}

/**
 * Truncates the temporary domains table
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @return array $result
 *
 */
function matterhorn_domain_import_truncate_table() {
	$result = array();

	try {
		// try to truncate temp table
		db_delete('temp_matterhorn_domain_domain_variables')->execute();
		db_delete('temp_matterhorn_domain_variables')->execute();
		db_delete('temp_matterhorn_domain_domains')->execute();
		// $result['temp_matterhorn_domain_domain_variables'] = db_truncate('temp_matterhorn_domain_domain_variables')->execute();
		// $result['temp_matterhorn_domain_variables'] = db_truncate('temp_matterhorn_domain_variables')->execute();
		// $result['temp_matterhorn_domain_domains'] = db_truncate('temp_matterhorn_domain_domains')->execute();

	} catch (Exception $e) {
		// failed
		// log error to database
		return FALSE;
	}

	return $result;
}

/**
 * Presets the Domain tables with the necessary default data
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 *
 */
function matterhorn_domain_import_set_defaults() {
	// default variable group data
	$variable = array(
		'id' => 1,
    	'group_id' => NULL,
    	'type_id' => 1,
    	'name' => 'variable',
    	'weight' => 0
    );

    $main = array(
    	'id' => 2,
        'group_id' => NULL,
        'type_id' => 2,
        'name' => 'main',
        'weight' => 0
    );

	// insert values to database
	drupal_write_record('temp_matterhorn_domain_domains', $variable);
	drupal_write_record('temp_matterhorn_domain_domains', $main);
}

/**
 * Handles the locking mechanism for the Import operation
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param string $action - the action to be executed
 * @param float $time - the duration of the lock before it expires
 * @return boolean $lock
 *
 */
function matterhorn_domain_import_lock($action = 'LOCK', $time = 15.0) {
	// acquire lock from Drupal
	if ($action = 'LOCK') {
		$lock = lock_acquire('matterhorn_domain_import', $time);
		return $lock;
	}
	// release lock from Drupal
	if ($action = 'RELEASE') {
		lock_release('matterhorn_domain_import');
		return;
	}

	return FALSE;
}

/**
 * Matterhorn Domain Import Helper functions
 *
 */

/**
 * Parses the data of an excel file into a readable object format
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $path
 * @return array $sheets
 *
 */
function _matterhorn_domain_import_read_excel($path) {
	$parser = new Matterhorn\Domains\ExcelParser;
	$sheets = $parser->read_excel($path);

	// delete excel file after reading
	if (file_exists($path)) {
		file_unmanaged_delete($path);
	}

	return $sheets;
}

/**
 * Comment
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $path
 * @return array $sheets
 *
 */
function _matterhorn_domain_import_check_excel($sheets) {
	// check if core worksheets exist
	switch (TRUE) {
		case !isset($sheets['Languages']):
		case !isset($sheets['Domains']):
		case !isset($sheets['Tokens']):
		case !isset($sheets['en']):
			return FALSE;
			break;
	}

	return TRUE;
}

/**
 * Gets the specified domain data on the database
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $domain
 * @return array $result
 *
 */
function _matterhorn_domain_import_check_domain($domain) {
	$result = db_select('temp_matterhorn_domain_domains', 'domain')
	    ->fields('domain')
	    ->condition('name', $domain)
	    ->execute();

	return $result->fetchAssoc();
}

/**
 * Gets the domain id of a specified domain
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $domain
 * @return integer
 *
 */
function _matterhorn_domain_import_get_domain_id($domain) {

	// trim domain to be searched
    $domain = trim($domain);
    $domain = str_replace(' ', '', $domain);

	$groups = _matterhorn_domain_import_get_all_groups();
	$result = array_search($domain, $groups);

	if ($result) {
		return $result;
	}

	$groups = _matterhorn_domain_import_get_all_domains();
	$result =  array_search($domain, $groups);

	return $result;
}

/**
 * Gets the domain id of a specified domain
 *
 * @author alex <alexandernikko.tenepere@bayviewtechnology.com>
 * @param array $domain
 * @return integer
 *
 */
function _matterhorn_domain_import_get_variable_id($variable) {
	$result = db_select('temp_matterhorn_domain_variables', 'var')
            ->fields('var')
            ->condition('var.name', $variable, '=')
            ->execute();

    foreach ($result as $row) {
        return $row->id;
    }

	return FALSE;
}

/**
 * Matterhorn Domain Import DB functions
 *
 */

/**
 * Returns an array of all domain groups, where the index is the primary key `id` for domains temp table
 *
 * @return array $groups
 *
 */
function _matterhorn_domain_import_get_all_groups() {
	$groups	 = array();

	$result = db_select('temp_matterhorn_domain_domains', 'groups')
            ->fields('groups')
            ->condition('groups.type_id', 2, '=')
            ->execute();

	foreach($result as $row){
		$groups[$row->id] = $row->name;
	}

	return $groups;
}

/**
 * Returns an array of all domains, where the index is the primary key `id` for domains temp table
 *
 * @return array $groups
 *
 */
function _matterhorn_domain_import_get_all_domains() {
	$domains = array();

	$result = db_select('temp_matterhorn_domain_domains', 'domains')
            ->fields('domains')
            ->condition('domains.type_id', 3, '=')
            ->execute();

	foreach($result as $row){
		$groups[$row->id] = $row->name;
	}

	return $groups;
}

/**
 * Processes the Add Domain Group form upon submit for domains temp table
 *
 * @param array $data
 *
 */
function _matterhorn_domain_import_groups_submit($data) {
	$query = db_insert('temp_matterhorn_domain_domains');

	// create new domain group and get its id
	foreach ($data as $name) {

		// trim variable and remove whitespaces
	    $name = trim($name);
	    $name = str_replace(' ', '', $name);

		// skip main group
		if ($name == 'main') {
			continue;
		}

		$groups = array(
	    	'type_id' => 2,
	    	'name' => $name,
	    	'weight' => 0,
	    );

	    $query->fields(array_keys($groups));
		$query->values($groups);
	}
	// insert values to database
	$query->execute();
	return;
}

/**
 * Processes the Add Domain form upon submit for domains temp table
 *
 * @param array $data
 */
function _matterhorn_domain_import_add_domains_submit($data) {
	$weight = 0;

	$query = db_insert('temp_matterhorn_domain_domains');

	// import domains per domain group
	foreach ($data as $group => $domains) {
		// get domain on each domain group
		foreach ($domains as $domain) {
			// check if data fetched from excel is blank
			if (!empty($domain)) {
				$id = _matterhorn_domain_import_get_domain_id($group);
				$domain = $domain;

				// trim variable and remove whitespaces
			    $domain = trim($domain);
			    $domain = str_replace(' ', '', $domain);

				// increment weight
				$weight = $weight + 1;

				// prepare data
				$variable = array(
					'group_id' => $id,
					'type_id' => 3,
					'name' => $domain,
					'weight' => $weight
				);

				$query->fields(array_keys($variable));
				$query->values($variable);
			}
		}
	}

	// only execute query if values are not empty
	if ($weight) {
		$query->execute();
	}

	return;
}

/**
 * Processes the Add Placeholder form upon submit for domains temp table
 *
 * @param array $data
 * @param string $language
 *
 */
function _matterhorn_domain_import_variables_submit($data, $language) {
	// terminate operation if language does not exist
	if (!isset( $data[$language])) {
		return;
	}

	$check = FALSE;
	$query_token = db_insert('temp_matterhorn_domain_domain_variables');

	foreach ($data[$language] as $placeholders => $placeholder) {

		$key = $placeholders;
		$value = $placeholder['name'];
		$description = $placeholder['description'];

		// trim variable and remove whitespaces
	    $key = trim($key);
	    $key = str_replace(' ', '', $key);
	    $value = trim($value);

		// check if existing placholder is already on the database
		$existing = db_select('temp_matterhorn_domain_variables', 'var')
			->fields('var', array('id'))
			->condition('var.name', $key, '=')
			->execute()
			->fetchAssoc();

		if ($existing) {
			// get id of existing placeholder
			$id = $existing['id'];
		}

		if (empty($existing)) {
			// construct placeholder data
			$variable = array(
			  'name' => $key,
			  'description'	=> $description,
			);

			// insert data at once into the database
			// we do this to get the id of the inserted record
			$query_placeholder = db_insert('temp_matterhorn_domain_variables');
			$query_placeholder->fields(array_keys($variable));
			$query_placeholder->values($variable);
			$id = $query_placeholder->execute();
		}

		// update the placeholder language value
		if (!empty($value)) {
			// construct token
			$variables = array(
	            'variable_id' => $id,
	            'domain_id' => 1,
	            'value' => $value,
	            'language' => $language,
	        );

			$check = TRUE;
	        $query_token->fields(array_keys($variables));
			$query_token->values($variables);
		}
	}

	// only execute query if values are not empty
	if ($check) {
		$query_token->execute();
	}

	return;
}

/**
 * Processes the Edit Domain and Edit Domain Groups forms for domains temp table
 *
 * @param array $data
 * @param string $language
 *
 */
function _matterhorn_domain_import_edit_domain_variables_submit($data, $language) {
	// terminate operation if language does not exist
	if (!isset($data[$language])) {
		return;
	}

	$check = FALSE;
	$query = db_insert('temp_matterhorn_domain_domain_variables');

	foreach ($data[$language] as $domain => $tokens) {

		// trim variable and remove whitespaces
	    $domain = trim($domain);
	    $domain = str_replace(' ', '', $domain);

		// get the details of the current domain
		$id = _matterhorn_domain_import_get_domain_id($domain);
		$type = $tokens['type'];
		$variables = $tokens['variables'];
		$name = $tokens['name'];

		foreach ($variables as $key => $value) {

			// skip iteration if key is empty
			if (empty($value)) {
				continue;
			}

			// trim variable and remove whitespaces
		    $key = trim($key);
		    $key = str_replace(' ', '', $key);
		    $value = trim($value);

			$vid = _matterhorn_domain_import_get_variable_id($key);

			// construct token
			$variable = array(
				'variable_id' => $vid,
				'domain_id' => $id,
				'value' => $value,
				'language' => $language,
			);

			$check = TRUE;
			$query->fields(array_keys($variable));
			$query->values($variable);
		}
	}

	// only execute query if values are not empty
	if ($check) {
		$query->execute();
	}

	return;
}