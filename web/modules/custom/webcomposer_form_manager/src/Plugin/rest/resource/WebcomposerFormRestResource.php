<?php

namespace Drupal\webcomposer_form_manager\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get data of Webcomposer Forms.
 *
 * @RestResource(
 *   id = "webcomposer_form_rest_resource",
 *   label = @Translation("Webcomposer Form Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/webcomposer_forms/form/{id}"
 *   }
 * )
 */
class WebcomposerFormRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Webcomposer Instance.
   *
   * @var Drupal\webcomposer_form_manager\WebcomposerForm
   */
  protected $formManager;

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
    $formManager
    ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->formManager = $formManager;
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
      $container->get('logger.factory')->get('webcomposer_form_manager'),
      $container->get('current_user'),
      $container->get('webcomposer_form_manager.form_manager')
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
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    $data = [];

    try {
      $config = \Drupal::config("webcomposer_form_manager.form.$id");
      $data = $config->get();
    } catch (\Exception $e) {
      $data = ['error' => $this->t('Form not found')];
    }

    // @todo Form fields should be sorted based on weights at this point, so
    // that FE won't need to sort it
    $formFields = $this->formManager->getFormById($id)->getFields();

    foreach ($formFields as $key => $value) {
      $config = \Drupal::config("webcomposer_form_manager.form.$id.$key");
      $data['fields'][$key] = $config->get();
      $data['fields'][$key]['type'] = $value->getType();
    }

    $build = array(
      '#cache' => array(
        'max-age' => 0,
      ),
    );

    return (new ResourceResponse($data))->addCacheableDependency($build);
  }

}
