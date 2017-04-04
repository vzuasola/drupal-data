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
use Drupal\block_content\Entity\BlockContent;
use Drupal\file\Entity\File;

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

  protected $entityRepository;
  protected $entity_manager;
  protected $current_language;

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
    $entity_repository,
    $entity_manager,
    $language_manager ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->currentUser = $current_user;
    $this->entityRepository = $entity_repository;
    $this->entityManager = $entity_manager;
    $this->current_language = $language_manager->getCurrentLanguage()->getId();
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
      $container->get('current_user'),
      $container->get('entity.repository'),
      $container->get('entity.manager'),
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
    $block = $this->entityManager->getStorage('block')->load($id);

    if ($block) {
      $uuid = $block->getPlugin()->getDerivativeId();
      $block_content = $this->entityRepository->loadEntityByUuid('block_content', $uuid);

      $translatedBlocked = $block_content->getTranslation($this->current_language);
      $block_content_array = $translatedBlocked->toArray();

      foreach ($block_content as $fieldType => $field) {
        $fieldSettings = $field->getSettings();

        if (isset($fieldSettings['target_type'])) {
          if ($fieldSettings['target_type'] == 'paragraph') {
            foreach ($block_content_array[$fieldType] as $key => $value) {
              $block_content_array[$fieldType][$key]['paragraph'] = $this->loadParagraphByID($value['target_id']);
            }
          }
          else if ($fieldSettings['target_type'] == 'file') {
            foreach ($block_content_array[$fieldType] as $key => $value) {
              $block_content_array[$fieldType][$key]['uri'] = $this->getFileURI($value['target_id']);
            }
          }
        }
      }
      return $block_content_array;
    }
  }


  private function loadParagraphByID($target_id){
    $paragraph = $this->entityManager->getStorage('paragraph')->load($target_id);
    $translatedParagraph = $paragraph->getTranslation($this->current_language);
    return $translatedParagraph;
  }

  private function getFileURI($target_id){
    $file = File::load($target_id);
    $url = file_create_url($file->getFileUri());
    $url = parse_url($url);
    return $url['path'];
  }
}
