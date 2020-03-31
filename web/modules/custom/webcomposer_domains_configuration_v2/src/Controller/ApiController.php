<?php

namespace Drupal\webcomposer_domains_configuration_v2\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\language\ConfigurableLanguageManager;
use Drupal\webcomposer_domains_configuration_v2\Storage\StorageService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiController.
 */
class ApiController extends ControllerBase {

  /**
   * Drupal\language\ConfigurableLanguageManager definition.
   *
   * @var \Drupal\language\ConfigurableLanguageManager
   */
  protected $languageManager;
  /**
   * Drupal\webcomposer_domains_configuration_v2\Storage\StorageService definition.
   *
   * @var \Drupal\webcomposer_domains_configuration_v2\Storage\StorageService
   */
  protected $webcomposerDomainsConfigurationV2Storage;

  /**
   * Constructs a new ApiController object.
   */
  public function __construct(ConfigurableLanguageManager $language_manager, StorageService $webcomposer_domains_configuration_v2_storage) {
    $this->languageManager = $language_manager;
    $this->webcomposerDomainsConfigurationV2Storage = $webcomposer_domains_configuration_v2_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('language_manager'),
      $container->get('webcomposer_domains_configuration_v2.storage')
    );
  }

  /**
   * Getdomain.
   *
   * @return string
   *   Return Hello string.
   */
  public function getDomain($domain) {
    $lang = $this->languageManager->getCurrentLanguage()->getId();
    return new JsonResponse(["Implement method: getDomain with parameter(s): $domain, $lang"]);
  }

}
