<?php

namespace Drupal\webcomposer_domains_configuration_v2\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Language\LanguageManager;
use Drupal\language\ConfigurableLanguageManager;
use Drupal\webcomposer_domains_configuration_v2\Storage\StorageService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiController.
 */
class ApiController extends ControllerBase {

  /**
   * Drupal\language\ConfigurableLanguageManager definition.
   *
   * @var LanguageManager
   */
  protected $languageManager;
  /**
   * Drupal\webcomposer_domains_configuration_v2\Storage\StorageService definition.
   *
   * @var StorageService
   */
  protected $storageService;

  /**
   * Constructs a new ApiController object.
   */
  public function __construct(
    ConfigurableLanguageManager $language_manager,
    StorageService $storageService
  )
  {
    $this->languageManager = $language_manager;
    $this->storageService = $storageService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('language_manager'),
      $container->get('webcomposer_domains_configuration_v2.storage')
    );
  }

  /**
   * Get the domain details from the provided domain param
   *
   * @param $domain
   * @return JsonResponse
   */
  public function getDomain($domain)
  {
    $lang = $this->languageManager->getCurrentLanguage()->getId();
    $domainDetails = $this->storageService->get("domains:" . $domain, $lang);
    if ($domainDetails) {
      $masterToken = $this->storageService->get("tokens", "");
      array_walk(
        $domainDetails,
        function (&$value, $token) use ($masterToken) {
          if (empty($value)) {
            $value = $masterToken[$token] ?? "";
          }
        }
      );
    }

    return new JsonResponse(($domainDetails) ? $domainDetails : ['message' => "domain not found"]);
  }

}
