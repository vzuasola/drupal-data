<?php

namespace Drupal\webcomposer_dropdown_menu\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get data of Webcomposer Dropdown entries
 *
 * @RestResource(
 *   id = "webcomposer_dropdown_menu_rest_resource",
 *   label = @Translation("Webcomposer Dropdown Menu Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/webcomposer_dropdown_menu"
 *   }
 * )
 */
class WebcomposerFormRestResource extends ResourceBase {
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
    $manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->manager = $manager;
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
      $container->get('logger.factory')->get('webcomposer_dropdown_menu'),
      $container->get('current_user'),
      $container->get('webcomposer_dropdown_menu.dropdown_menu_manager')
    );
  }

  /**
   * Responds to GET requests.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get() {
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    $data = $this->manager->getEnabledSections();

    $build = [
      '#cache' => [
        'max-age' => 0,
      ],
    ];

    return (new ResourceResponse($data))->addCacheableDependency($build);
  }

}
