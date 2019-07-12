<?php

namespace Drupal\redis\Client;

use Drupal\redis\ClientInterface;
use Predis\Client;


/**
 * Predis client specific implementation.
 */
class Predis implements ClientInterface {

  public function getClient($host = NULL, $base = NULL, $password = NULL, $options = NULL) {
    // I'm not sure why but the error handler is driven crazy if timezone
    // is not set at this point.
    // Hopefully Drupal will restore the right one this once the current
    // account has logged in.
    date_default_timezone_set(@date_default_timezone_get());

    $client = new Client($host, $options);

    return $client;
  }

  public function getName() {
    return 'Predis';
  }
}
