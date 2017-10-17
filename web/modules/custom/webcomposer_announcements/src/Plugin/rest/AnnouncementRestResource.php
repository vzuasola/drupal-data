<?php

namespace Drupal\webcomposer_announcements\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\webcomposer_announcements\Entity\AnnouncementEntity;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "announcement_rest_resource",
 *   label = @Translation("Announcement rest resource"),
 *   uri_paths = {
 *     "canonical" = "/api/announcementss"
 *   }
 * )
 */
class AnnouncementRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * @var string $currentLanguage
   *    Current language
   */
  protected $currentLanguage;

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
    $language_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->currentLanguage = $language_manager->getCurrentLanguage()->getId();
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
      $container->get('logger.factory')->get('webcomposer_announcements'),
      $container->get('current_user'),
      $container->get('language_manager')
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
    $results = AnnouncementEntity::loadMultiple();
    $response = [];

    foreach ($results as $value) {
      echo '<pre>';
      var_dump(new DrupalDateTime('UTC'));
      echo '<br>';
      if ($value->hasTranslation($this->currentLanguage)) {
        $translatedEntity = $value->getTranslation($this->currentLanguage);
        $result = $translatedEntity->toArray();
        // $publishDate = new DrupalDateTime($result['field_publish_date'][0]['value']);
        echo '<pre>';
        var_dump($result['field_publish_date']);
        exit;
      }
      // 
      // 

      
      // var_dump($publishDate)
      exit;

      $response[] = $result;
    }

    $build = array( 
      '#cache' => array( 
        'max-age' => 0, 
      ), 
    ); 

    return (new ResourceResponse($response))->addCacheableDependency($build);
  }

}
