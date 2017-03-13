<?php

namespace Drupal\webcomposer_form\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;
use Drupal\field\Entity\FieldConfig;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "form_resource",
 *   label = @Translation("Form resource"),
 *   uri_paths = {
 *     "canonical" = "/api/form/{id}"
 *   }
 * )
 */
class FormResource extends ResourceBase {

  /**
   * A current user instance.
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
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
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
      $container->get('logger.factory')->get('webcomposer_form'),
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

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    $build = array(
      '#cache' => array(
        'max-age' => 0,
      ),
    );

    kint_require();
    $data = $this->getFieldDefinition($id);
    ddd($data);

    if (!$data) {
      throw new NotFoundHttpException(t('Contact form with ID @id was not found', array('@id' => $id)));
    }

    return (new ResourceResponse($data))->addCacheableDependency($build);
  }

  /**
   * Gets the form definition of a contact form by bundle ID
   *
   * @param string $id
   * @return array
   */
  private function getFieldDefinition($id)
  {
    $definition = array();

    $formDisplay = entity_get_form_display('contact_message', $id, 'default');
    $components = $formDisplay->getComponents();

    $ids = \Drupal::entityQuery('field_config')
      ->condition('id', "contact_message.$id.", 'STARTS_WITH')
      ->execute();

    $field_configs = FieldConfig::loadMultiple($ids);

    foreach ($components as $key => $component) {
      if (isset($field_configs["contact_message.$id.$key"])) {
        $config = $field_configs["contact_message.$id.$key"];
        
        $definition[$key] = $config->toArray() + $component + [
          'storage' => $config->getFieldStorageDefinition()
        ];

        // remove redundancy of having two type definitions
        unset($definition[$key]['type']);
      }
    }

    return $definition;
  }
}
