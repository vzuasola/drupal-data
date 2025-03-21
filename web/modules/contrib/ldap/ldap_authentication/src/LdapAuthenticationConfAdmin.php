<?php

namespace Drupal\ldap_authentication;

use Drupal\Core\Url;
use Drupal\ldap_servers\Entity\Server;

/**
 *
 */
class LdapAuthenticationConfAdmin extends LdapAuthenticationConf {

  /**
   *
   */
  protected function setTranslatableProperties() {

    /**
     * 0.  Logon Options
     */

    $values['authenticationModeOptions']  = array(
      LdapAuthenticationConf::$mode_mixed => t('Mixed mode. Drupal authentication is tried first.  On failure, LDAP authentication is performed.'),
      LdapAuthenticationConf::$mode_exclusive => t('Only LDAP Authentication is allowed except for user 1.
        If selected, (1) reset password links will be replaced with links to ldap end user documentation below.
        (2) The reset password form will be left available at user/password for user 1; but no links to it
        will be provided to anonymous users.
        (3) Password fields in user profile form will be removed except for user 1.'),
    );

    $values['authenticationServersDescription'] = t('Check all LDAP server configurations to use in authentication.
     Each will be tested for authentication until successful or
     until each is exhausted.  In most cases only one server configuration is selected.');

    /**
     * User Login Interface
     */
    $values['loginUIUsernameTxtDescription'] = t('Text to be displayed to user below the username field of
     the user login screen.');

    $values['loginUIPasswordTxtDescription'] = t('Text to be displayed to user below the password field of
     the user login screen.');

    $values['ldapUserHelpLinkUrlDescription'] = t('URL to LDAP user help/documentation for users resetting
     passwords etc. Should be of form http://domain.com/. Could be the institutions ldap password support page
     or a page within this drupal site that is available to anonymous users.');

    $values['ldapUserHelpLinkTextDescription']  = t('Text for above link e.g. Account Help or Campus Password Help Page');

    /**
     * LDAP User Restrictions
     */

    $values['allowOnlyIfTextInDnDescription'] = t('A list of text such as ou=education
      or cn=barclay that at least one of be found in user\'s dn string.  Enter one per line
      such as <pre>ou=education') . "\n" . t('ou=engineering</pre>   This test will be case insensitive.');

    $values['excludeIfTextInDnDescription'] = t('A list of text such as ou=evil
      or cn=bad that if found in a user\'s dn, exclude them from ldap authentication.
      Enter one per line such as <pre>ou=evil') . "\n" . t('cn=bad</pre> This test will be case insensitive.');

    // @FIXME
    // $values['excludeIfNoAuthorizationsDescription'] = t('If the user is not granted any drupal roles,
    //   organic groups, etc. by LDAP Authorization, login will be denied.  LDAP Authorization must be
    //   enabled for this to work.');
    $values['excludeIfNoAuthorizationsDescription'] = 'If the user is not granted any drupal roles,
      organic groups, etc. by LDAP Authorization, login will be denied.  LDAP Authorization must be
      enabled for this to work.';

    /**
    * Email
    */

    $values['emailOptionOptions'] = array(
      LdapAuthenticationConf::$emailFieldRemove => t('Don\'t show an email field on user forms.  LDAP derived email will be used for user and connot be changed by user'),
      LdapAuthenticationConf::$emailFieldDisable => t('Show disabled email field on user forms with LDAP derived email.  LDAP derived email will be used for user and connot be changed by user'),
      LdapAuthenticationConf::$emailFieldAllow => t('Leave email field on user forms enabled.  Generally used when provisioning to LDAP or not using email derived from LDAP.'),
    );

    $values['emailUpdateOptions'] = array(
      LdapAuthenticationConf::$emailUpdateOnLdapChangeEnableNotify => t('Update stored email if LDAP email differs at login and notify user.'),
      LdapAuthenticationConf::$emailUpdateOnLdapChangeEnable => t('Update stored email if LDAP email differs at login but don\'t notify user.'),
      LdapAuthenticationConf::$emailUpdateOnLdapChangeDisable => t('Don\'t update stored email if LDAP email differs at login.'),
    );

    /**
    * Password
    */

    $values['passwordUpdateOptions'] = array(
      LdapAuthenticationConf::$passwordFieldShow => t('Display password field disabled (Prevents password updates).'),
      LdapAuthenticationConf::$passwordFieldHide => t('Don\'t show password field on user forms except login form.'),
      LdapAuthenticationConf::$passwordFieldAllow => t('Display password field and allow updating it. In order to change password in LDAP, LDAP provisioning for this field must be enabled.'),
    );

    /**
     *  Single Sign-On / Seamless Sign-On
     */

    $values['ldapImplementationOptions'] = array(
      'mod_auth_sspi' => t('mod_auth_sspi'),
      'mod_auth_kerb' => t('mod_auth_kerb'),
    );

    // @FIXME
    // $values['cookieExpirePeriod'] = array(-1 => t('Session'), 0 => t('Immediately')) +
    //   array_combine(array(3600, 86400, 604800, 2592000, 31536000, 315360000, 630720000), 'format_interval');
    $values['cookieExpirePeriod'] = array(-1 => t('Session'), 0 => t('Immediately'));

    // @FIXME
    // $values['ssoEnabledDescription'] = '<strong>' . t('Single Sign on is enabled.') .
    //   '</strong> ' . t('To disable it, disable the LDAP SSO Module on the') . ' ' . \Drupal::l(t('Modules Form'), \Drupal\Core\Url::fromRoute('system.modules_list')) . '.<p>' .
    //   t('Single Sign-On enables ' .
    //   'users of this site to be authenticated by visiting the URL ' .
    //   '"user/login/sso, or automatically if selecting "automated ' .
    //   'single sign-on" below. Set up of LDAP authentication must be ' .
    //   'performed on the web server. Please review the !readme file ' .
    //   'for more information.', array('!readme' =>
    //   l(t('README.txt'), drupal_get_path('module', 'ldap_sso') . '/README.txt')))
    //   . '</p>';
    $values['ssoEnabledDescription'] = '<strong>' . t('Single Sign on is enabled.') .
      '</strong> ' . t('To disable it, disable the LDAP SSO Module on the') . ' ' . \Drupal::l(t('Modules Form'), Url::fromRoute('system.modules_list')) . '.<p>' .
      t('Single Sign-On enables ' .
      'users of this site to be authenticated by visiting the URL ' .
      '"user/login/sso, or automatically if selecting "automated ' .
      'single sign-on" below. Set up of LDAP authentication must be ' .
      'performed on the web server. Please review the readme file ' .
      'for more information.') . '</p>';

    $values['ssoExcludedPathsDescription'] = '<p>' .
      t("Which paths will not check for SSO? cron.php is common example.  Specify pages by using their paths. Enter one path per line. The '*' character is a wildcard.
        Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.",
        array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>'));
    '</p>';

    $values['ssoExcludedHostsDescription'] = '<p>' .
      t('If your site is accessible via multiple hostnames, you may only want
        the LDAP SSO module to authenticate against some of them. To exclude
        any hostnames from SSO, enter them here. Enter one host per line.');
    '</p>';

    // @FIXME
    // $values['ssoRemoteUserStripDomainNameDescription'] = t('Useful when the ' .
    //   'WWW server provides authentication in the form of user@realm and you ' .
    //   'want to have both SSO and regular forms based authentication ' .
    //   'available. Otherwise duplicate accounts with conflicting e-mail ' .
    //   'addresses may be created.');
    $values['ssoRemoteUserStripDomainNameDescription'] = 'Useful when the ' .
      'WWW server provides authentication in the form of user@realm and you ' .
      'want to have both SSO and regular forms based authentication ' .
      'available. Otherwise duplicate accounts with conflicting e-mail ' .
      'addresses may be created.';
    // @FIXME
    // $values['seamlessLogInDescription'] = t('This requires that you ' .
    //   'have operational NTLM or Kerberos authentication turned on for at least ' .
    //   'the path user/login/sso, or for the whole domain.');
    $values['seamlessLogInDescription'] = 'This requires that you ' .
      'have operational NTLM or Kerberos authentication turned on for at least ' .
      'the path user/login/sso, or for the whole domain.';
    // @FIXME
    // $values['cookieExpireDescription'] = t('If using the seamless login, a ' .
    //   'cookie is necessary to prevent automatic login after a user ' .
    //   'manually logs out. Select the lifetime of the cookie.');
    $values['cookieExpireDescription'] = 'If using the seamless login, a ' .
      'cookie is necessary to prevent automatic login after a user ' .
      'manually logs out. Select the lifetime of the cookie.';
    // @FIXME
    // $values['ldapImplementationDescription'] = t('Select the type of ' .
    //   'authentication mechanism you are using.');
    $values['ldapImplementationDescription'] = 'Select the type of ' .
      'authentication mechanism you are using.';

    foreach ($values as $property => $default_value) {
      $this->$property = $default_value;
    }
  }

  /**
   * 0.  Logon Options.
   */
  public $authenticationModeDefault;
  public $authenticationModeOptions;

  protected $authenticationServersDescription;
  protected $authenticationServersOptions = array();

  /**
   * 1.  User Login Interface.
   */
  protected $loginUIUsernameTxtDescription;
  protected $loginUIPasswordTxtDescription;
  protected $ldapUserHelpLinkUrlDescription;
  protected $ldapUserHelpLinkTextDescription;


  /**
   * 2.  LDAP User Restrictions.
   */

  protected $allowOnlyIfTextInDnDescription;
  protected $excludeIfTextInDnDescription;
  protected $allowTestPhpDescription;

  /**
   * 4. Email.
   */

  public $emailOptionDefault;
  public $emailOptionOptions;

  public $emailUpdateDefault;
  public $emailUpdateOptions;


  /**
   * 5. Single Sign-On / Seamless Sign-On.
   */

  public $ssoEnabledDescription;
  public $ssoRemoteUserStripDomainNameDescription;
  public $ldapImplementationOptions;
  public $cookieExpirePeriod;
  public $seamlessLogInDescription;
  public $cookieExpireDescription;
  public $ldapImplementationDescription;


  public $errorMsg = NULL;
  public $hasError = FALSE;
  public $errorName = NULL;

  /**
   *
   */
  public function clearError() {
    $this->hasError = FALSE;
    $this->errorMsg = NULL;
    $this->errorName = NULL;
  }

  /**
   *
   */
  public function save() {
    foreach ($this->saveable as $property) {
      $save[$property] = $this->{$property};
    }
    \Drupal::configFactory()->getEditable('ldap_authentication.settings')->set('ldap_authentication_conf', $save)->save();
    $this->load();
  }

  /**
   *
   */
  static public function getSaveableProperty($property) {
    $ldap_authentication_conf = \Drupal::config('ldap_authentication.settings')->get('ldap_authentication_conf');
    return isset($ldap_authentication_conf[$property]) ? $ldap_authentication_conf[$property] : FALSE;

  }

  /**
   *
   */
  static public function uninstall() {
    \Drupal::config('ldap_authentication.settings')->clear('ldap_authentication_conf')->save();
  }

  /**
   *
   */
  public function __construct() {
    parent::__construct();
    $this->emailUpdateDefault = self::$emailUpdateOnLdapChangeEnableNotify;
    $this->emailOptionDefault = self::$emailFieldRemove;
    $this->authenticationModeDefault = self::$mode_mixed;

    $this->setTranslatableProperties();
    $factory = \Drupal::service('ldap.servers');
    $servers = $factory->getEnabledServers();
    if ($servers) {
      foreach ($servers as $sid => $ldap_server) {
        $enabled = ($ldap_server->get('status')) ? 'Enabled' : 'Disabled';
        $this->authenticationServersOptions[$sid] = $ldap_server->get('label') . ' (' . $ldap_server->get('address') . ') Status: ' . $enabled;
      }
    }
  }

  /**
   *
   */
  public function drupalForm() {
    if (count($this->authenticationServersOptions) == 0) {

      $url = Url::fromRoute('entity.ldap_server.collection');
      $edit_server_link = \Drupal::l(t('@path', array('@path' => 'LDAP Servers')), $url);

      $message = t('At least one LDAP server must configured and <em>enabled</em>
 before configuring LDAP authentication. Please go to @link to configure an LDAP server.',
        ['@link' => $edit_server_link]
      );

      $form['intro'] = array(
        '#type' => 'item',
        '#markup' => t('<h1>LDAP Authentication Settings</h1>') . $message,
      );
      return $form;
    }

    // Not sure what the tokens would be for this form?
    $tokens = array();

    $form['intro'] = array(
      '#type' => 'item',
      '#markup' => t('<h1>LDAP Authentication Settings</h1>'),
    );

    $form['logon'] = array(
      '#type' => 'fieldset',
      '#title' => t('Logon Options'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    );

    $form['logon']['authenticationMode'] = array(
      '#type' => 'radios',
      '#title' => t('Allowable Authentications'),
      '#required' => 1,
      '#default_value' => $this->authenticationMode,
      '#options' => $this->authenticationModeOptions,
    );

    $form['logon']['authenticationServers'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Authentication LDAP Server Configurations'),
      '#required' => FALSE,
      '#default_value' => $this->sids,
      '#options' => $this->authenticationServersOptions,
      '#description' => $this->authenticationServersDescription,
    );

    $form['login_UI'] = array(
      '#type' => 'fieldset',
      '#title' => t('User Login Interface'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    );

    $form['login_UI']['loginUIUsernameTxt'] = array(
      '#type' => 'textfield',
      '#title' => t('Username Description Text'),
      '#required' => 0,
      '#default_value' => $this->loginUIUsernameTxt,
      '#description' => $this->loginUIUsernameTxtDescription,
    );

    $form['login_UI']['loginUIPasswordTxt'] = array(
      '#type' => 'textfield',
      '#title' => t('Password Description Text'),
      '#required' => 0,
      '#default_value' => $this->loginUIPasswordTxt,
      '#description' => $this->loginUIPasswordTxtDescription,
    );

    $form['login_UI']['ldapUserHelpLinkUrl'] = array(
      '#type' => 'textfield',
      '#title' => t('LDAP Account User Help URL'),
      '#required' => 0,
      '#default_value' => $this->ldapUserHelpLinkUrl,
      '#description' => $this->ldapUserHelpLinkUrlDescription,
    );

    $form['login_UI']['ldapUserHelpLinkText'] = array(
      '#type' => 'textfield',
      '#title' => t('LDAP Account User Help Link Text'),
      '#required' => 0,
      '#default_value' => $this->ldapUserHelpLinkText,
      '#description' => $this->ldapUserHelpLinkTextDescription,
    );

    $form['restrictions'] = array(
      '#type' => 'fieldset',
      '#title' => t('LDAP User "Whitelists" and Restrictions'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    );

    $form['restrictions']['allowOnlyIfTextInDn'] = array(
      '#type' => 'textarea',
      '#title' => t('Allow Only Text Test'),
      '#default_value' => $this->arrayToLines($this->allowOnlyIfTextInDn),
      '#cols' => 50,
      '#rows' => 3,
      '#description' => t($this->allowOnlyIfTextInDnDescription, $tokens),
    );

    $form['restrictions']['excludeIfTextInDn'] = array(
      '#type' => 'textarea',
      '#title' => t('Excluded Text Test'),
      '#default_value' => $this->arrayToLines($this->excludeIfTextInDn),
      '#cols' => 50,
      '#rows' => 3,
      '#description' => t($this->excludeIfTextInDnDescription, $tokens),
    );

    $form['restrictions']['excludeIfNoAuthorizations'] = array(
      '#type' => 'checkbox',
      '#title' => t('Deny access to users without Ldap Authorization Module
        authorization mappings such as Drupal roles.
        Requires LDAP Authorization to be enabled and configured!'),
      '#default_value' => $this->excludeIfNoAuthorizations,
      '#description' => t($this->excludeIfNoAuthorizationsDescription, $tokens),
      '#disabled' => (boolean) (!\Drupal::moduleHandler()->moduleExists('ldap_authorization')),
    );

    $form['email'] = array(
      '#type' => 'fieldset',
      '#title' => t('Email'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    );

    $form['email']['emailOption'] = array(
      '#type' => 'radios',
      '#title' => t('Email Behavior'),
      '#required' => 1,
      '#default_value' => $this->emailOption,
      '#options' => $this->emailOptionOptions,
    );

    $form['email']['emailUpdate'] = array(
      '#type' => 'radios',
      '#title' => t('Email Update'),
      '#required' => 1,
      '#default_value' => $this->emailUpdate,
      '#options' => $this->emailUpdateOptions,
    );

    $form['password'] = array(
      '#type' => 'fieldset',
      '#title' => t('Password'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    );
    $form['password']['passwordOption'] = array(
      '#type' => 'radios',
      '#title' => t('Password Behavior'),
      '#required' => 1,
      '#default_value' => $this->passwordOption,
      '#options' => $this->passwordUpdateOptions,
    );

    /**
     * Begin single sign-on settings
     */
    $form['sso'] = array(
      '#type' => 'fieldset',
      '#title' => t('Single Sign-On'),
      '#collapsible' => TRUE,
      '#collapsed' => (boolean) (!$this->ssoEnabled),
    );

    if ($this->ssoEnabled) {
      $form['sso']['enabled'] = array(
        '#type' => 'markup',
        '#markup' => $this->ssoEnabledDescription,
      );
    }
    else {
      $form['sso']['disabled'] = array(
        '#type' => 'markup',
        '#markup' => '<p><em>' . t('LDAP Single Sign-On module must be enabled for options below to work.')
        . ' ' . t('It is currently disabled.')
        . ' ' . \Drupal::l(t('See modules form'), Url::fromRoute('system.modules_list')) . '</p></em>',
      );
    }

    $form['sso']['ssoRemoteUserStripDomainName'] = array(
      '#type' => 'checkbox',
      '#title' => t('Strip REMOTE_USER domain name'),
      '#description' => t($this->ssoRemoteUserStripDomainNameDescription),
      '#default_value' => $this->ssoRemoteUserStripDomainName,
      '#disabled' => (boolean) (!$this->ssoEnabled),
    );

    $form['sso']['seamlessLogin'] = array(
      '#type' => 'checkbox',
      '#title' => t('Turn on automated single sign-on'),
      '#description' => t($this->seamlessLogInDescription),
      '#default_value' => $this->seamlessLogin,
      '#disabled' => (boolean) (!$this->ssoEnabled),
    );

    $form['sso']['cookieExpire'] = array(
      '#type' => 'select',
      '#title' => t('Cookie Lifetime'),
      '#description' => t($this->cookieExpireDescription),
      '#default_value' => $this->cookieExpire,
      '#options' => $this->cookieExpirePeriod,
      '#disabled' => (boolean) (!$this->ssoEnabled),
    );

    $form['sso']['ldapImplementation'] = array(
      '#type' => 'select',
      '#title' => t('Authentication Mechanism'),
      '#description' => t($this->ldapImplementationDescription),
      '#default_value' => $this->ldapImplementation,
      '#options' => $this->ldapImplementationOptions,
      '#disabled' => (boolean) (!$this->ssoEnabled),
    );

    $form['sso']['ssoExcludedPaths'] = array(
      '#type' => 'textarea',
      '#title' => t('SSO Excluded Paths'),
      '#description' => t($this->ssoExcludedPathsDescription),
      '#default_value' => $this->arrayToLines($this->ssoExcludedPaths),
      '#disabled' => (boolean) (!$this->ssoEnabled),
    );

    $form['sso']['ssoExcludedHosts'] = array(
      '#type' => 'textarea',
      '#title' => t('SSO Excluded Hosts'),
      '#description' => t($this->ssoExcludedHostsDescription),
      '#default_value' => $this->arrayToLines($this->ssoExcludedHosts),
      '#disabled' => (boolean) (!$this->ssoEnabled),
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Save',
    );

    return $form;
  }

  /**
   * Validate form, not object.
   */
  public function drupalFormValidate($values) {

    $this->populateFromDrupalForm($values);

    $errors = $this->validate();
    return $errors;
  }

  /**
   * Validate object, not form.
   */
  public function validate() {
    $errors = array();

    $factory = \Drupal::service('ldap.servers');
    $enabled_servers = $factory->getEnabledServers();

    if ($this->ssoEnabled) {
      foreach ($this->sids as $sid => $discard) {
        if ($enabled_servers[$sid]->get('bind_method') == Server::$bindMethodUser || $enabled_servers[$sid]->get('bind_method') == Server::$bindMethodAnonUser) {
          $methods = array(
            Server::$bindMethodUser => 'Bind with Users Credentials',
            Server::$bindMethodAnonUser => 'Anonymous Bind for search, then Bind with Users Credentials',
          );
          $tokens = array(
            '%edit' => \Drupal::l($enabled_servers[$sid]->name, Url::fromUri('/admin/config/people/ldap/servers/edit/' . $sid)),
            '%sid' => $sid,
            '%bind_method' => $methods[$enabled_servers[$sid]->get('bind_method')],
          );

          $errors['ssoEnabled'] = t('Single Sign On is not valid with the server !edit (id=%sid) because that server configuration uses %bind_method.  Since the user\'s credentials are never available to this module with single sign on enabled, there is no way for the ldap module to bind to the ldap server with credentials.', $tokens);
        }
      }
    }
    return $errors;
  }

  /**
   *
   */
  protected function populateFromDrupalForm($values) {

    $this->authenticationMode = ($values['authenticationMode']) ? (int) $values['authenticationMode'] : NULL;
    $this->sids = $values['authenticationServers'];
    $this->allowOnlyIfTextInDn = $this->linesToArray($values['allowOnlyIfTextInDn']);
    $this->excludeIfTextInDn = $this->linesToArray($values['excludeIfTextInDn']);
    $this->loginUIUsernameTxt = ($values['loginUIUsernameTxt']) ? (string) $values['loginUIUsernameTxt'] : NULL;
    $this->loginUIPasswordTxt = ($values['loginUIPasswordTxt']) ? (string) $values['loginUIPasswordTxt'] : NULL;
    $this->ldapUserHelpLinkUrl = ($values['ldapUserHelpLinkUrl']) ? (string) $values['ldapUserHelpLinkUrl'] : NULL;
    $this->ldapUserHelpLinkText = ($values['ldapUserHelpLinkText']) ? (string) $values['ldapUserHelpLinkText'] : NULL;
    $this->excludeIfNoAuthorizations = ($values['excludeIfNoAuthorizations']) ? (int) $values['excludeIfNoAuthorizations'] : NULL;
    $this->emailOption  = ($values['emailOption']) ? (int) $values['emailOption'] : NULL;
    $this->emailUpdate  = ($values['emailUpdate']) ? (int) $values['emailUpdate'] : NULL;
    $this->passwordOption  = ($values['passwordOption']) ? (int) $values['passwordOption'] : NULL;
    $this->ssoExcludedPaths = $this->linesToArray($values['ssoExcludedPaths']);
    $this->ssoExcludedHosts = $this->linesToArray($values['ssoExcludedHosts']);
    $this->ssoRemoteUserStripDomainName = ($values['ssoRemoteUserStripDomainName']) ? (int) $values['ssoRemoteUserStripDomainName'] : NULL;
    $this->seamlessLogin = ($values['seamlessLogin']) ? (int) $values['seamlessLogin'] : NULL;
    $this->cookieExpire = ($values['cookieExpire']) ? (int) $values['cookieExpire'] : NULL;
    $this->ldapImplementation = ($values['ldapImplementation']) ? (string) $values['ldapImplementation'] : NULL;

    foreach ($values['authenticationServers'] as $sid => $enabled) {
      if ($enabled) {
        $this->enabledAuthenticationServers[$sid] = $enabled;
      }
    };
  }

  /**
   *
   */
  public function drupalFormSubmit($values) {

    $this->populateFromDrupalForm($values);
    try {
      $save_result = $this->save();
    }
    catch (\Exception $e) {
      $this->errorName = 'Save Error';
      $this->errorMsg = t('Failed to save object.  Your form data was not saved.');
      $this->hasError = TRUE;
    }

  }

  /**
   *
   */
  protected function arrayToLines($array) {
    $lines = "";
    if (is_array($array)) {
      $lines = join("\n", $array);
    }
    elseif (is_array(@unserialize($array))) {
      $lines = join("\n", unserialize($array));
    }
    return $lines;
  }

  /**
   *
   */
  protected function linesToArray($lines) {
    $lines = trim($lines);

    if ($lines) {
      $array = preg_split('/[\n\r]+/', $lines);
      foreach ($array as $i => $value) {
        $array[$i] = trim($value);
      }
    }
    else {
      $array = array();
    }
    return $array;
  }

}
