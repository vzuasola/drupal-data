<?php

namespace Drupal\webcomposer_mailer\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
 *     "canonical" = "/email/submission",
 *     "https://www.drupal.org/link-relations/create" = "/email/submission"
 *   }
 * )
 */
class MailerRestResource extends ResourceBase {

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
   * @param \Drupal\Core\Flood\FloodInterface $flood
   *   The flood control mechanism.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    FloodInterface $flood) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

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

    $langCode = $data['langcode'];
    $from = filter_var(Html::escape($data['from']), FILTER_SANITIZE_EMAIL);
    $to = filter_var(Html::escape($data['to']), FILTER_SANITIZE_EMAIL);
    $module = $data['module'];
    $key = $data['key'];
    $params = $data['params'];

    $config = \Drupal::config('webcomposer_config.mailer_configuration');
    $limit = $config->get('antispam_limit');
    $interval = $config->get('antispam_interval');
    $mailEnable = (bool) $config->get('mail_enable');
    $antiSpamEnable = (bool) $config->get('antispam_enable');

    $build = [
      '#cache' => [
      'max-age' => 0,
      ],
    ];

    if ($this->flood->isAllowed($module, $limit, $interval)) {
      // Send email with drupal_mail.
      $mail = \Drupal::service('plugin.manager.mail')->mail($module, $key, $to, $langCode, $params, $from, $mailEnable);
      // Register email flood
      if ($antiSpamEnable && $mailEnable) {
        $this->flood->register($module, $interval);
      }
      // Check Mail if success
      if ($mail['result']) {
        $data = [
          'success' => $this->t($config->get('mailer_success')),
        ];
        return (new ResourceResponse($data))->addCacheableDependency($build);
      }
    } else {
      $data = [
        'error' => $this->t($config->get('antispam_error'), [
                     '@limit' => $limit,
                     '@interval' => $interval,
                   ]),
      ];
      return (new ResourceResponse($data))->addCacheableDependency($build);
    }
    // Mail failed
    $data = [
      'error' => $this->t($config->get('mailer_error')),
    ];
    return (new ResourceResponse($data))->addCacheableDependency($build);
  }
}
