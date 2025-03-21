
provisioning = creating or syncing ... to drupal or to ldap



==========================================
LDAP User Data Structures in Drupal User Object
==========================================


'data' => 
  array (
    'ldap_user' => 
    array (
      'init' => 
      array (
        'sid' => 'activedirectory1',
        'dn' => 'cn=hpotter,ou=people,dc=hogwarts,dc=edu',
        'mail' => 'hpotter@hogwarts.edu',
      ),
    ),
    'ldap_authorizations' => 
    array (
      'drupal_role' => 
      array (
        'cn=gryffindor,ou=groups,dc=hogwarts,dc=edu' => 
        array (
          'date_granted' => 1351194052,
        ),
        'cn=honors students,ou=groups,dc=hogwarts,dc=edu' => 
        array (
          'date_granted' => 1351194052,
        ),
        'students' => 
        array (
          'date_granted' => 1351194052,
        ),
      ),
    ),
  ),

 'ldap_user_puid_sid' => 
  array (
    'und' => 
    array (
      0 => 
      array (
        'value' => 'activedirectory1',
        'format' => NULL,
        'safe_value' => 'activedirectory1',
      ),
    ),
  ),
   'ldap_user_puid' => 
  array (
    'und' => 
    array (
      0 => 
      array (
        'value' => '101',
        'format' => NULL,
        'safe_value' => '101',
      ),
    ),
  ),
   'ldap_user_puid_property' => 
  array (
    'und' => 
    array (
      0 => 
      array (
        'value' => 'guid',
        'format' => NULL,
        'safe_value' => 'guid',
      ),
    ),
  ),
   'ldap_user_current_dn' => 
  array (
    'und' => 
    array (
      0 => 
      array (
        'value' => 'cn=hpotter,ou=people,dc=hogwarts,dc=edu',
        'format' => NULL,
        'safe_value' => 'cn=hpotter,ou=people,dc=hogwarts,dc=edu',
      ),
    ),
  ),
   'ldap_user_prov_entries' => 
  array (
  ),
   'ldap_user_last_checked' => 
  array (
  ),
   'ldap_authorizations' => 
  array (
  ),




==========================================
Rough Summary of provisioning configuration and controls
==========================================

1. configured triggers (admin/config/people/ldap/user) or configuration of other modules
determine when provisioning happens.

// configurable drupal acct provision triggers
see LdapUserConf

// configurable ldap entry provision triggers 
see LdapUserConf


2. hook_user_* functions (and elsewere such as ldap_authentication) will check if appropriate triggers are enabled and initiate calls to ldapUserConf methods:

ldapUserConf::provisionDrupalAccount()
ldapUserConf::syncToDrupalAccount()
ldapUserConf::ldapAssociateDrupalAccount()
ldapUserConf::deleteDrupalAccount()

ldapUserConf::provisionLdapEntry()
ldapUserConf::syncToLdapEntry()
ldapUserConf::deleteProvisionedLdapEntries()

3. to get mappings and determine which attributes are needed "ldap_contexts" and "prov_events" are passed into 
ServerFactory::getUserDataFromServerByAccount()
ldapUserConf::drupalUserToLdapEntry()


4.  Should provisioning happen?

------------
4.A.  Server Level: Does an ldap server configuration support provisioning?
ldapUserConf::drupalAcctProvisionServer = <sid> | LdapUserConf::$noServerSID;  // servers used for to drupal acct provisioning
ldapUserConf::ldapEntryProvisionServer =  <sid> | LdapUserConf::$noServerSID;  // servers used for provisioning to ldap

This is directly configured at config/people/ldap/user

------------
4.B.  Trigger Level: Does provisioning occur for a given trigger?
ldapUserConf::provisionEnabled($direction, $provision_trigger)
    
This method is based on the configuration of two sets of checkboxes at config/people/ldap/user

ldapUserConf::drupalAcctProvisionTriggers (see "LDAP Entry Provisioning Options"), contains:
  see LdapUserConf

ldapUserConf::ldapEntryProvisionTriggers (see "Drupal Account Provisioning Options"), contains:
  see LdapUserConf

@todo.  A hook to allow other modules to intervene here 

------------
4.C  Field Level: Does provisioning occur for a given field and ldap server for a given "prov_event" and "ldap _context"?

ldapUserConf::isSynced($field, $prov_event, $direction)

This depends on: 
ldapUserConf::syncMapping[$direction][$field]['prov_events']
which is populated by various ldap and possibly other modules.

"ldap_contexts" (any module can provide its own context which is just a string)
  ldap_user_insert_drupal_user
  ldap_user_update_drupal_user
  ldap_authentication_authenticate
  ldap_user_delete_drupal_user
  ldap_user_disable_drupal_user
  all

"prov_events"
  see LdapUserConf
