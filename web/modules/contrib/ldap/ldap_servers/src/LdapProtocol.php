<?php

namespace Drupal\ldap_servers;

/**
 *
 */
interface LdapProtocol {

  const LDAP_FAIL = -1;
  const LDAP_SUCCESS = 0x00;
  const LDAP_OPERATIONS_ERROR = 0x01;
  const LDAP_PROTOCOL_ERROR = 0x02;
  const LDAP_TIMELIMIT_EXCEEDED = 0x03;
  const LDAP_SIZELIMIT_EXCEEDED = 0x04;
  const LDAP_COMPARE_FALSE = 0x05;
  const LDAP_COMPARE_TRUE = 0x06;
  const LDAP_AUTH_METHOD_NOT_SUPPORTED = 0x07;
  const LDAP_STRONG_AUTH_REQUIRED = 0x08;

  // NotusedinLDAPv3;.
  const LDAP_PARTIAL_RESULTS = 0x09;

  // Next5newinLDAPv3;.
  const LDAP_REFERRAL = 0x0a;
  const LDAP_ADMINLIMIT_EXCEEDED = 0x0b;
  const LDAP_UNAVAILABLE_CRITICAL_EXTENSION = 0x0c;
  const LDAP_CONFIDENTIALITY_REQUIRED = 0x0d;
  const LDAP_SASL_BIND_INPROGRESS = 0x0e;

  const LDAP_NO_SUCH_ATTRIBUTE = 0x10;
  const LDAP_UNDEFINED_TYPE = 0x11;
  const LDAP_INAPPROPRIATE_MATCHING = 0x12;
  const LDAP_CONSTRAINT_VIOLATION = 0x13;
  const LDAP_TYPE_OR_VALUE_EXISTS = 0x14;
  const LDAP_INVALID_SYNTAX = 0x15;

  const LDAP_NO_SUCH_OBJECT = 0x20;
  const LDAP_ALIAS_PROBLEM = 0x21;
  const LDAP_INVALID_DN_SYNTAX = 0x22;

  const LDAP_IS_LEAF = 0x23;
  const LDAP_ALIAS_DEREF_PROBLEM = 0x24;

  const LDAP_INAPPROPRIATE_AUTH = 0x30;
  const LDAP_INVALID_CREDENTIALS = 0x31;
  const LDAP_INSUFFICIENT_ACCESS = 0x32;
  const LDAP_BUSY = 0x33;
  const LDAP_UNAVAILABLE = 0x34;
  const LDAP_UNWILLING_TO_PERFORM = 0x35;
  const LDAP_LOOP_DETECT = 0x36;

  const LDAP_SORT_CONTROL_MISSING = 0x3C;
  const LDAP_INDEX_RANGE_ERROR = 0x3D;

  const LDAP_NAMING_VIOLATION = 0x40;
  const LDAP_OBJECT_CLASS_VIOLATION = 0x41;
  const LDAP_NOT_ALLOWED_ON_NONLEAF = 0x42;
  const LDAP_NOT_ALLOWED_ON_RDN = 0x43;
  const LDAP_ALREADY_EXISTS = 0x44;
  const LDAP_NO_OBJECT_CLASS_MODS = 0x45;
  const LDAP_RESULTS_TOO_LARGE = 0x46;
  // NexttwoforLDAPv3;.
  const LDAP_AFFECTS_MULTIPLE_DSAS = 0x47;
  const LDAP_OTHER = 0x50;

  // UsedbysomeAPIs;.
  const LDAP_SERVER_DOWN = 0x51;
  const LDAP_LOCAL_ERROR = 0x52;
  const LDAP_ENCODING_ERROR = 0x53;
  const LDAP_DECODING_ERROR = 0x54;
  const LDAP_TIMEOUT = 0x55;
  const LDAP_AUTH_UNKNOWN = 0x56;
  const LDAP_FILTER_ERROR = 0x57;
  const LDAP_USER_CANCELLED = 0x58;
  const LDAP_PARAM_ERROR = 0x59;
  const LDAP_NO_MEMORY = 0x5a;

  // PreliminaryLDAPv3codes;.
  const LDAP_CONNECT_ERROR = 0x5b;
  const LDAP_NOT_SUPPORTED = 0x5c;
  const LDAP_CONTROL_NOT_FOUND = 0x5d;
  const LDAP_NO_RESULTS_RETURNED = 0x5e;
  const LDAP_MORE_RESULTS_TO_RETURN = 0x5f;
  const LDAP_CLIENT_LOOP = 0x60;
  const LDAP_REFERRAL_LIMIT_EXCEEDED = 0x61;

}
