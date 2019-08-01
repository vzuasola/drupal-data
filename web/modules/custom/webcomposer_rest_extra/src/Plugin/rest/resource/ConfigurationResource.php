<?php

/**
 * @file
 * Contains Drupal\webcomposer_rest_extra\Plugin\rest\resource\entity_rest_extra.
 */

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\file\Entity\File;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;
use Drupal\webcomposer_rest_extra\Event\ConfigurationResourceEvent;

/**
 * Provides a resource to get view of configuration.
 *
 * @RestResource(
 *   id = "configuration_resource",
 *   label = @Translation("General Configuration Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/general/configuration/{id}"
 *   }
 * )
 */
class ConfigurationResource extends ResourceBase {
  use FilterHtmlTrait;

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Config Factory Object.
   *
   * @var core/lib/Drupal/Core/Config/ConfigFactory.php
   */
  protected $configFactory;

  /**
   * Event Dispatcher Object.
   *
   * @var core/lib/Drupal/Component/EventDispatcher/ContainerAwareEventDispatcher.php
   */
  protected $eventDispatcher;

  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user,
    $configFactory,
    $eventDispatcher) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->configFactory = $configFactory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('custom_rest'),
      $container->get('current_user'),
      $container->get('config.factory'),
      $container->get('event_dispatcher')
    );
  }

  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($id) {
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    $data = [];

    try {
      $config = $this->configFactory->get("webcomposer_config.$id");

      $data = $config->get();

      $this->eventDispatcher->dispatch(
        ConfigurationResourceEvent::EVENT_NAME,
        new ConfigurationResourceEvent($data)
      );

      $this->resolveFieldImages($id, $data);
      $this->resolveRecursive($data);
    } catch (\Exception $e) {
      $data = [
        'error' => $this->t('Configuration not found')
      ];
    }

    $build = [
      '#cache' => [
        'max-age' => 0,
      ],
    ];

    return (new ResourceResponse($data))->addCacheableDependency($build);
  }

  /**
   * Temporary solution for fields not using standard naming schemes.
   *
   * @param string $id
   *   The configuration resource ID.
   * @param array $data
   *   The configuration data.
   */
  private function resolveFieldImages($id, &$data) {
    switch ($id) {
        case 'footer_configuration':
          $file_id = $data['partners_logo'][0];
          $data['partners_image_url'] = $this->getFileRelativePath($file_id);

        case 'page_not_found':
          $file_id = $data['page_not_found_image'][0];

          $file = File::load($file_id);
          if ($file) {
            $data['page_not_found_image_url'] = $this->generateUrlFromFile($file);
          }
          break;
      }
  }

  /**
   * Resolve images do their respective absolute URLs.
   *
   * @param array $data
   *   The configuration data.
   */
  private function resolveRecursive(&$data) {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $this->resolveRecursive($value);
      }

      // replacements for field with uploaded images
      if (0 === strpos($key, 'file_image') && isset($value[0])) {
        $file = File::load($value[0]);
        if ($file) {
          $data[$key] = $this->generateUrlFromFile($file);
        }
      }

      // replacement for configs with HTML markup field formats
      if (isset($value['value']) &&
        isset($value['format']) &&
        $value['format'] == 'basic_html'
      ) {
        $data[$key]['value'] = $this->filterHtml($value['value']);
      }
    }
  }
}
