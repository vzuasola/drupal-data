<?php

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\webcomposer_rest_extra\Plugin\rest\resource\utils\LegacyDomainResource;
use Drupal\webcomposer_rest_extra\Plugin\rest\resource\utils\DomainResource;
/**
 * Provides a resource to get view domains,domain groups and master placeholder.
 *
 * @RestResource(
 *   id = "domain_placeholder",
 *   label = @Translation("Domain Placeholder"),
 *   uri_paths = {
 *     "canonical" = "/api/domain/{domain}"
 *   }
 * )
 */
class DomainPlaceholderResource extends ResourceBase {
  /**
   * @var string $currentLanguage
   *    Current language
   */
  protected $currentLanguage;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The query object that can query the given entity type.
   *
   * @var \Drupal\Core\Entity\Query\QueryInterface
   */
  protected $entityQuery;

  /**
   * The query object for getting legacy token resource.
   * @var Drupal\webcomposer_rest_extra\Plugin\rest\resource\utils\LegacyDomainResource
   */
  protected $legacyDomain;

  /**
   * The query object for getting new token resource.
   * @var Drupal\webcomposer_rest_extra\Plugin\rest\resource\utils\DomainResource
   */
  protected $NewResource;

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
    $language_manager,$entityTypeManager, $entityQuery
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->currentUser = $current_user;
    $this->currentLanguage = $language_manager->getCurrentLanguage()->getId();
    $this->entityTypeManager = $entityTypeManager;
    $this->entityQuery = $entityQuery;
    $this->legacyDomain = new LegacyDomainResource(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $serializer_formats,
      $logger,
      $current_user,
      $language_manager,
      $entityTypeManager,
      $entityQuery
      );
    $this->NewResource = new DomainResource(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $serializer_formats,
      $logger,
      $current_user,
      $language_manager,
      $entityTypeManager,
      $entityQuery
      );

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
      $container->get('language_manager'),
      $container->get('entity_type.manager'),
      $container->get('entity.query')
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
  public function get($domain) {

      $toggle = \Drupal::config('webcomposer_config.toggle_configuration')->get('domain_toggle');

      if(is_null($toggle) || $toggle === 0) {
        // if toggle is off  use the legacy system
        $data = $this->legacyDomain->get($domain);
      }
      else {
        // If toggle is on use the new system
        $data = $this->NewResource->get($domain);
      }

      if (!$data) {
          throw new NotFoundHttpException(t('Term name with ID @id was not found', array('@id' => $domain)));
      }

      return $data;
  }

}
