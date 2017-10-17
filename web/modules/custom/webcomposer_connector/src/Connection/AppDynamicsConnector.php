<?php

namespace Drupal\webcomposer_connector\Connection;

/**
 * AppDynamics Connection as service.
 *
 * Class is to expose connection to AppDynamics as service.
 */
use GuzzleHttp\Client;

/**
 * AppDynamics connector for logging.
 */
class AppDynamicsConnector {

  /**
   * The static event key.
   */
  const EVENT_TYPE = 'CUSTOM';

  /**
   * AppDynamics host from environment settings.
   *
   * @var string
   */
  static protected $appDynamicsHost;

  /**
   * AppDynamics API authentication username.
   *
   * @var string
   */
  static protected $appDynamicsUsername;

  /**
   * AppDynamics API authentication account name.
   *
   * @var string
   */
  static protected $appDynamicsAccountName;

  /**
   * AppDynamics API authentication password.
   *
   * @var string
   */
  static protected $appDynamicsPassword;

  /**
   * Guzzle client object.
   *
   * @var object
   */
  static protected $client;

  /**
   * Returns AppDynamics connection object.
   *
   * @return object
   *   The connection.
   */
  public static function getConnection() {
    // Set connection parameters.
    self::setConnectionParameters();
    $client = self::getClient();
    return $client;
  }

  /**
   * Setter Method.
   *
   * Set Appdyanmics connection variables.
   * Get the variables from environment.
   */
  private static function setConnectionParameters() {
    $env = getenv();
    // Get connection paramaters from enviornment variables.
    if (isset($env['APPDYNAMICS_HOST']) &&
        isset($env['APPDYNAMICS_USERNAME']) &&
        isset($env['APPDYNAMICS_ACCOUNTNAME']) &&
        isset($env['APPDYNAMICS_PASSWORD'])
    ) {
      self::$appDynamicsHost = $env['APPDYNAMICS_HOST'];
      self::$appDynamicsUsername = $env['APPDYNAMICS_USERNAME'];
      self::$appDynamicsAccountName = $env['APPDYNAMICS_ACCOUNTNAME'];
      self::$appDynamicsPassword = $env['APPDYNAMICS_ACCOUNTNAME'];
    }
    else {
      // Get connection parameters from Drupal config
      // if not stored in env varibales.
      self::$appDynamicsHost = \Drupal::config('webcomposer_connector.appdynamics')->get('host');
      self::$appDynamicsUsername = \Drupal::config('webcomposer_connector.appdynamics')->get('username');
      self::$appDynamicsAccountName = \Drupal::config('webcomposer_connector.appdynamics')->get('account_name');
      self::$appDynamicsPassword = \Drupal::config('webcomposer_connector.appdynamics')->get('password');
    }
  }

  /**
   * Get Guzzle client instantiation.
   *
   * @param array $options
   *   Additional options.
   *
   * @return GuzzleClient
   *   Guzzel client object.
   */
  private function getClient(array $options = []) {
    // We have to manually create the base64 encoded signature,
    // as the built-in auth by Guzzle is not working.
    $credentials = base64_encode(
        self::$appDynamicsUsername . '@' . self::$appDynamicsAccountName . ':' . self::$appDynamicsPassword
    );

    $options += [
      'base_uri' => self::$appDynamicsHost,
      'headers' => [
        'Content-Type' => 'application/json',
        'Authorization' => 'Basic ' . $credentials,
      ],
    ];

    return new Client($options);
  }

}
