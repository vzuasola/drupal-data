<?php

namespace Drupal\webcomposer_marketing_script\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntity;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "marketing_script",
 *   label = @Translation("Marketing Script Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/marketing_script"
 *   }
 * )
 */
class MarketingScriptResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */

  protected $currentUser;

  /**
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */

  protected $currentRequest;

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
    AccountProxyInterface $current_user, Request $current_request) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->currentRequest = $current_request;
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
      $container->get('request_stack')->getCurrentRequest()
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
  public function get() {

    $route = $this->currentRequest->query->get('route');
    $response = [];

    $results = MarketingScriptEntity::loadMultiple();

    foreach ($results as $value) {
      $result = $value->toArray();   
      $data = explode(PHP_EOL, $result['field_per_page_configuratiion'][0]['value']);

      foreach ($data as $key) {
        $trimmed_key = trim($key);

        if (fnmatch($trimmed_key, $route)) {
          $response[] = $result;
          break;
        }
      }
    } 

    $build = array( 
      '#cache' => array( 
        'max-age' => 0, 
      ),
    ); 

    return (new ResourceResponse($response))->addCacheableDependency($build);
  }

}
