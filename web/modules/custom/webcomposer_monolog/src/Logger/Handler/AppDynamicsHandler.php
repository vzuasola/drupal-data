<?php

namespace Drupal\webcomposer_monolog\Logger\Handler;

/**
 * Custom monolog handler for AppDynamics.
 * 
 * Allows to log error/info/notice to AppDynamics.
 * Extension of Monolog library to use AppDynamics as destination.
 */
use Monolog\Logger;
use Monolog\Formatter\NormalizerFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;

/*
 * A custom handler written for sending log events to AppDynamics
 */

class AppDynamicsHandler extends AbstractProcessingHandler {

  /**
   * The static event key
   */
  const EVENT_TYPE = 'CUSTOM';

  /**
   * AppDynamics host from environment settings
   *
   * @var string
   */
  protected $appDynamicsHost;

  /**
   * Public constructor.
   *
   * @param integer $level The monolog log level
   * @param boolean $bubble Flag to enable bubbling
   * @param string $appDynamicsHost The AppDynamics server host
   * @param string $appDynamicsUsername The AppDynamics server username
   * @param string $appDynamicsAccountName The AppDynamics server account name
   * @param string $appDynamicsPassword The AppDynamics server credential password
   */
  public function __construct(
  $appDynamicsclient, $level = Logger::INFO, bool $bubble = true
  ) {
    parent::__construct($level, $bubble);
    $this->client = $appDynamicsclient;
  }

  /**
   * {@inheritdoc}
   *
   * @param array $record
   * @return string
   */
  protected function write(array $record) {
    if (!empty($record['message'])) {
      // Construct the query parameter which are mandatory by AppDynamics
      $this->query['eventtype'] = static::EVENT_TYPE;
      $this->query['severity'] = $record['level_name'];
      $this->query['summary'] = $record['context']['message'] ?? $record['message'];
      $this->query['customeventtype'] = $record['context']['event'] ?? $record['message'];
      $this->query['comment'] = $record['formatted'] ?? 'No formatted log response.';
      // Initialize the request
      $curlResponse = $this->client->request(
          'POST', 'controller/rest/applications/Lobby/events', ['query' => $this->query]
      );

      $responseBody = $curlResponse->getBody()->getContents();
      $response = json_decode($responseBody, true);
    }
  }

}
