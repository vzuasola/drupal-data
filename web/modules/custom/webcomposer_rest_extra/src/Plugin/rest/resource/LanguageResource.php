<?php

/**
 * @file
 * Definition of Drupal\webcomposer_rest_extra\Plugin\rest\resource\LanguageResource.
 */

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

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
 *   label = @Translation("Language list"),
 *   uri_paths = {
 *     "canonical" = "/api/language"
 *   }
 * )
 */
class LanguageResource extends ResourceBase {
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
   * Config factory instance
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $config;

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
    LanguageManagerInterface $language_manager,
    $config
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->languageManager = $language_manager;
    $this->currentUser = $current_user;
    $this->config = $config;
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
      $container->get('language_manager'),
      $container->get('config.factory')
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
    $data = [];

    try {
      $lang_obj = $this->languageManager->getLanguages();

      // get the language negotiation URL prefixes
      $config = $this->config->get('language.negotiation');
      $prefixes = $config->get('url.prefixes');

      if ($lang_obj) {
        foreach ($lang_obj as $lang_array) {
          $key = $lang_array->getId();
          $customLabel = $this->getCustomLabel($key);

          $data[$key] = [
            'name' => $customLabel ?? $lang_array->getName(),
            'id' => $key,
            'prefix' => $prefixes[$key]
          ];
        }

        $default_lang_key = $this->languageManager->getDefaultLanguage()->getId();
        $customLabel = $this->getCustomLabel($default_lang_key);

        $data['default'] = [
          'id' => $default_lang_key,
          'name' => $customLabel ?? $this->languageManager->getDefaultLanguage()->getName(),
          'prefix' => $prefixes[$default_lang_key]
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

  /**
   * Gets the language custom label from Third Party Setting
   *
   * @param string $langKey
   *
   * @return mixed
   */
  private function getCustomLabel($langKey) {
    $configManager = \Drupal::entityTypeManager()->getStorage('configurable_language');
    $languageConfigEntity= $configManager->load($langKey);
    $customLabel = $languageConfigEntity->getThirdPartySetting('webcomposer_language_hierarchy', 'webcomposer_language_custom_label');

    return $customLabel;
  }
}
