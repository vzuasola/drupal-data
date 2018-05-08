<?php

namespace Drupal\virtual_config\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "virtual_config_rest_resource",
 *   label = @Translation("Virtual Config Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class VirtualRestResource extends ResourceBase {

  use FilterHtmlTrait;
  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array                                      $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string                                     $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed                                      $plugin_definition
   *   The plugin implementation definition.
   * @param array                                      $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface                   $logger
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
    AccountProxyInterface $current_user
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
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
      $container->get('current_user')
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
      $config = \Drupal::config("virtual_config.$id");
      $data = $config->get();
      foreach ($data as $key => $value) {
        // replace the images src for text formats
        if (isset($value['format']) && isset($value['value'])) {
            $data[$key]['value'] = $this->filterHtml($value['value']);
        }
      }

      // Get relative path for the configuration images.
      // @todo To be standardized
      switch ($id) {
        case 'virtual_configuration':
          $file_id = $data['virtuals_background'][0];
          $data['virtuals_background_image_url'] = $this->getFileRelativePath($file_id);
          break;
      }

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
}
