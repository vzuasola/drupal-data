<?php

namespace Drupal\casino_language_fetcher\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get the languages enabled for the Site.
 *
 * @RestResource(
 *   id = "language_rest_resource",
 *   label = @Translation("Language Fetcher Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/language"
 *   }
 * )
 */
class LanguageRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;
  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

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
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user,
    LanguageManagerInterface $language_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->languageManager = $language_manager;
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
      $container->get('current_user'),
      $container->get('language_manager')
    );
  }

  /**
   * Responds to GET requests.
   *
   * Returns a list of enalbled Languages.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get() {
    $data = array();
    try {
      $lang_obj = $this->languageManager->getLanguages();
      if ($lang_obj) {
        foreach ($lang_obj as $lang_array) {
          $key = $lang_array->getId();
          $data[$key] = [
            'name' => $lang_array->getName(),
            'id'   => $key,
          ];
        }
        $data['default'] = [
          'name' => $this->languageManager->getDefaultLanguage()->getId(),
          'id' => $this->languageManager->getDefaultLanguage()->getName(),
        ];
      }
    }
    catch (\Exception $e) {
      $this->logger->error('Language not found.');
      $data = array(
        'error' => $this->t('Language not found.'),
      );
    }
    $build = array(
      '#cache' => array(
        'max-age' => 0,
      ),
    );
    return (new ResourceResponse($data))->addCacheableDependency($build);
  }

}
