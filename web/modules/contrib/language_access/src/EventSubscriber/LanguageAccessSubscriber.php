<?php

namespace Drupal\language_access\EventSubscriber;

use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Redirect .html pages to corresponding Node page.
 */
class LanguageAccessSubscriber implements EventSubscriberInterface {

  /**
   * The current active user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructs LanguageAccess Subscriber.
   *
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   */
  public function __construct(
    AccountInterface $current_user,
    LanguageManagerInterface $language_manager,
    RequestStack $request_stack
  ) {
    $this->currentUser = $current_user;
    $this->languageManager = $language_manager;
    $this->requestStack = $request_stack;
  }

  /**
   * Redirect pattern based url.
   *
   * @param Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   A GetResponseEvent instance.
   */
  public function customLanguageAccess(GetResponseEvent $event) {

    $request = $this->requestStack->getCurrentRequest();
    $requestUrl = $request->server->get('REQUEST_URI', NULL);
    $language = $this->languageManager->getCurrentLanguage();

    // Allow user path.
    if (strpos($requestUrl, '/user/') === FALSE) {
      // Check access to language.
      $route_match = \Drupal::routeMatch();
      $current_route = $route_match->getRouteName();
      if (strpos($requestUrl, '/api') <= -1) {
        if (!$this->currentUser->hasPermission('access language ' . $language->getId())) {
          if (PHP_SAPI != 'cli') {
            // Display the default access denied page.
            if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
              throw new AccessDeniedHttpException();
            }
          }
        }
      }

      // fix for entities but show pages for translations
      if (!preg_match('/^([a-za-zA-Z0-9_\-.]*)(overview|translation)([a-za-zA-Z0-9_\-.]*)$/', $current_route)) {
        $entity = $this->get_page_entity();
        if ($entity !== NULL) {
          $langcode = $entity->language()->getId();
          if (!$this->currentUser->hasPermission('access language ' . $langcode)) {
            throw new AccessDeniedHttpException();
          }
        }
      }
    }
  }

  /**
   * Helper function to check if current route is an entity or not
   *
   * @return mixed
   *   Entity or NULL
   */
  private function get_page_entity() {
    $current_route = \Drupal::routeMatch();
    foreach ($current_route->getParameters() as $param) {
      if ($param instanceof \Drupal\Core\Entity\EntityInterface) {
        $page_entity = $param;
        break;
      }
    }

    if (!isset($page_entity)) {
      // Some routes don't properly define entity parameters.
      // Thus, try to load them by its raw Id, if given.
      $entity_type_manager = \Drupal::entityTypeManager();
      $types = $entity_type_manager->getDefinitions();
      foreach ($current_route->getParameters()->keys() as $param_key) {
        if (!isset($types[$param_key])) {
          continue;
        }

        if ($param = $current_route->getParameter($param_key)) {
          if (is_string($param) || is_numeric($param)) {
            try {
              $page_entity = $entity_type_manager->getStorage($param_key)->load($param);
            }
            catch (\Exception $e) {
            }
          }
          break;
        }
      }
    }

    if (!isset($page_entity) || !$page_entity->access('view')) {
      $page_entity = FALSE;
      return NULL;
    }
    return $page_entity;
  }

  /**
   * Listen to kernel.request events and call customRedirection.
   *
   * @return array
   *   Event names to listen to (key) and methods to call (value).
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['customLanguageAccess'];
    return $events;
  }

}
