<?php

/**
 * @file
 * Contains Drupal\webcomposer_rest_extra\Plugin\rest\resource\entity_rest_extra.
 */

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\field\Entity\FieldConfig;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get view modes by entity,bundle and fields.
 *
 * @RestResource(
 *   id = "entity_bundle_fields_resource",
 *   label = @Translation("Entity Bundle Resource Label"),
 *   uri_paths = {
 *     "canonical" = "entity/{entity}/{bundle}/fields"
 *   }
 * )
 */
class EntityBundleFieldsResource extends ResourceBase {
  /**
   *  A curent user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The query object that can query the given entity type.
   *
   * @var \Drupal\Core\Entity\Query\QueryInterface
   */
  protected $entityQuery;

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
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user, $entityQuery) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->entityQuery = $entityQuery;
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
      $container->get('logger.factory')->get('rest'),
      $container->get('current_user'),
      $container->get('entity.query')
    );
  }

  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing a reponse HTML.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function get($entity = NULL, $bundle = NULL) {
    if ($entity && $bundle) {
      // Query by filtering on the ID by entity and bundle.
      $ids = $this->entityQuery->get('field_config', 'AND')
        ->condition('id', $entity . '.' . $bundle . '.', 'STARTS_WITH')
        ->execute();

      // Fetch all fields and key them by field name.
      $field_configs = FieldConfig::loadMultiple($ids);

      $build = array(
        '#cache' => array(
          'max-age' => 0,
        ),
      );

      $fields = array();
      foreach ($field_configs as $field_instance) {
        $fields[$field_instance->getName()] = $field_instance;
      }

      if (!empty($fields)) {
        return (new ResourceResponse($fields))->addCacheableDependency($build);
      }

      throw new NotFoundHttpException(t('Field for entity @entity and bundle @bundle were not found', array('@entity' => $entity, '@bundle' => $bundle)));
    }

    // Throw an exception if it is required.
    throw new HttpException(t('Entity and Bundle weren\'t provided'));
  }

}
