<?php

namespace Drupal\webcomposer_blocks\Plugin\rest\resource;

use Drupal\block\Entity\Block;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "custom_block_resource",
 *   label = @Translation("Custom Block resource"),
 *   uri_paths = {
 *     "canonical" = "/api/custom_block/{id}"
 *   }
 * )
 */
class BlockResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

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
    AccountProxyInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

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
      $container->get('logger.factory')->get('webcomposer_blocks'),
      $container->get('current_user')
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
    // You must to implement the logic of your REST Resource here.
    // Use current user after pass authentication to validate access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    $block = $this->getBlockDefinition($id);

    if (!$block) {
      throw new NotFoundHttpException(t('Block with ID of @id was not found', array('@id' => $id)));
    }

    $build = array(
      '#cache' => array(
        'max-age' => 0,
      ),
    );

    return (new ResourceResponse($block))->addCacheableDependency($build);
  }

  /**
   * Get block definition by machine name
   *
   * @param string $id
   *   The block machine name
   *
   * @return object
   */
  private function getBlockDefinition($id)
  {
    $block = \Drupal::entityTypeManager()
      ->getStorage('block')
      ->load($id);

    if ($block) {
      $uuid = $block->getPlugin()->getDerivativeId();
      $block_content = \Drupal::service('entity.repository')->loadEntityByUuid('block_content', $uuid);

      $block_return['block_content'] = $block_content;
      foreach ($block_content as $field => $fieldValue) {
        if ( is_null($fieldValue->value) ){
          $ttt = $block_content->getFieldDefinition($field)->getSettings();
          if($ttt['target_type'] == 'paragraph'){
            $block_return['paragraph'] = $this->getParagraphDetails($block_content->$field);
          }
        }
      }
      return $block_return;
    }
  }

  /**
   * Load multiple paragraph
   *
   * @param array $itemCollection
   * - ID of paragraph stored in array
   *
   * @return object
   */
  public function loadMultipleParagraph($itemCollection = [])
  {
    $paragraph = \Drupal::entityManager()->getStorage('paragraph')->loadMultiple($itemCollection);
    return $paragraph;
  }

  /**
   * Get Sponsorship Details
   *
   * @param array $paragraphs
   * - ID of paragraph stored in array
   *
   * @return array
   */
  private function getParagraphDetails($paragraphs = [])
  {
    foreach ($paragraphs as $item) {
      $paragraphItemCollection[] = $item->target_id;
    }
    return $this->loadMultipleParagraph($paragraphItemCollection);
  }
}
