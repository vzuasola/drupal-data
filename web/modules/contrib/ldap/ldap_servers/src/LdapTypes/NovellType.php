<?php

namespace Drupal\ldap_servers\LdapTypes;

/**
 *
 */
class NovellType extends AbstractType {

  public $documentation = 'http://www.novell.com/documentation/edir873/index.html?page=/documentation/edir873/edir873/data/h0000007.html';
  public $name = 'Novell eDirectory LDAP';
  public $typeId = 'Novell';
  public $description = 'Novell eDirectory LDAP';
  public $port = 389;
  public $tls = 1;
  public $encrypted = 0;
  public $user_attr = 'uid';
  public $mail_attr = 'mail';

  public $groupObjectClassDefault = 'groupOfNames';

  public $groupDerivationModelDefault = self::DERIVE_GROUP_FROM_ENTRY;

  public $groupUserMembershipsAttrExistsEntryAttrDefault = 'members';
  public $groupUserMembershipsAttrExistsEntryUserIdDefault = 'dn';

}
