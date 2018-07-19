<?php

namespace Drupal\webcomposer_mailer\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Psr\Log\LoggerInterface;
use Drupal\Core\Flood\FloodInterface;
use Drupal\Component\Utility\Html;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "mailer_rest_resource",
 *   label = @Translation("Mailer rest resource"),
 *   uri_paths = {
 *     "canonical" = "/email/submission"
 *   }
 * )
 */
class MailerRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The flood control mechanism.
   *
   * @var \Drupal\Core\Flood\FloodInterface
   */
  protected $flood;

  /**
   * Constructs a new MailerRestResource object.
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
   * @param \Drupal\Core\Flood\FloodInterface $flood
   *   The flood control mechanism.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user,
    FloodInterface $flood) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->flood = $flood;
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
      $container->get('logger.factory')->get('webcomposer_mailer'),
      $container->get('current_user'),
      $container->get('flood')
    );
  }

   /**
   * Responds to entity POST requests and email by Drupal mail.
   *
   * @param array $data
   *   Mail field data.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function post(array $data) {

    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    $langCode = $data['langcode'];
    $from = filter_var(Html::escape($data['from']), FILTER_SANITIZE_EMAIL);
    $to = filter_var(Html::escape($data['to']), FILTER_SANITIZE_EMAIL);
    $module = $data['module'];
    $key = $data['key'];
    $params = $data['params'];

    $config = \Drupal::config('webcomposer_config.mailer_configuration')->get();
    $limit = $config['antispam_limit'];
    $interval = $config['antispam_interval'];
    $mailEnable = (bool) $config['mail_enable'];
    $antiSpamEnable = (bool) $config['antispam_enable'];

    $build = [
      '#cache' => [
      'max-age' => 0,
      ],
    ];

    if ($this->flood->isAllowed($module, $limit, $interval)) {
      // Send email with drupal_mail.
      $mail = \Drupal::service('plugin.manager.mail')->mail($module, $key, $to, $langCode, $params, $from, $mailEnable);
      // Register email flood
      if($antiSpamEnable && $mailEnable) {
        $this->flood->register($module, $interval);
      }
      // Check Mail if success
      if ($mail['result']) {
        $data = [
          'success' => $this->t($config['mailer_success']),
        ];
        return (new ResourceResponse($data))->addCacheableDependency($build);
      }
    } else {
      $data = [
        'error' => $this->t($config['antispam_error'], [
                     '@limit' => $limit,
                     '@interval' => $interval,
                   ]),
      ];
      return (new ResourceResponse($data))->addCacheableDependency($build);
    }
    // Mail failed
    $data = [
      'error' => $this->t($config['mailer_error']),
    ];
    return (new ResourceResponse($data))->addCacheableDependency($build);
  }
}
