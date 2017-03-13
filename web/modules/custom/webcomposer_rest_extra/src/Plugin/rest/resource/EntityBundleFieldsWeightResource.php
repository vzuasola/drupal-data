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
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "Entity Bundle Weight Resource",
 *   label = @Translation("entity_bundle_weight_resource"),
 *   uri_paths = {
 *     "canonical" = "/entity/{entity}/{bundle}/fields/weights"
 *   }
 * )
 */
class EntityBundleFieldsWeightResource extends ResourceBase
{

  /**
   *  A curent user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

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
    AccountProxyInterface $current_user) {
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
      $container->get('logger.factory')->get('rest'),
      $container->get('current_user')
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

      if (!empty($bundle)) {
        $weights = entity_get_form_display($entity, $bundle, 'default');
        return new ResourceResponse($weights);
      }

      throw new NotFoundHttpException(t('Field for entity @entity and bundle @bundle were not found', array('@entity' => $entity, '@bundle' => $bundle)));
    }

    // Throw an exception if it is required.
    throw new HttpException(t('Entity and Bundle weren\'t provided'));
  }

}
