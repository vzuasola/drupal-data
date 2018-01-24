<?php

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a resource to get view domains,domain groups and master placeholder.
 *
 * @RestResource(
 *   id = "domain_placeholder",
 *   label = @Translation("Domain Placeholder"),
 *   uri_paths = {
 *     "canonical" = "/api/domain/{domain}"
 *   }
 * )
 */
class DomainPlaceholderResource extends ResourceBase {
  /**
   * @var string $currentLanguage
   *    Current language
   */
  protected $currentLanguage;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The query object that can query the given entity type.
   *
   * @var \Drupal\Core\Entity\Query\QueryInterface
   */
  protected $entityQuery;

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
    $language_manager,$entityTypeManager, $entityQuery
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->currentUser = $current_user;
    $this->currentLanguage = $language_manager->getCurrentLanguage()->getId();
    $this->entityTypeManager = $entityTypeManager;
    $this->entityQuery = $entityQuery;
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
      $container->get('logger.factory')->get('custom_rest'),
      $container->get('current_user'),
      $container->get('language_manager'),
      $container->get('entity_type.manager'),
      $container->get('entity.query')
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
  public function get($domain) {
      $build = array(
        '#cache' => array(
          'max-age' => 0,
        ),
      );

      $data = $this->getFieldDefinition($domain);

      if (!$data) {
          throw new NotFoundHttpException(t('Term name with ID @id was not found', array('@id' => $domain)));
      }

      return (new ResourceResponse($data))->addCacheableDependency($build);
  }

  /**
   * Gets the field definition.
   *
   * @param <string> $domain The domain
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException  (if term do not get loaded)
   *
   * @return array                                                          The field definition.
   */
  private function getFieldDefinition($domain) {
    $definition = array();

    // You must to implement the logic of your REST Resource here.
    $term = $this->entityTypeManager->getStorage('taxonomy_term')->loadByProperties(['name' => $domain]);

    if (empty($term)) {
        throw new NotFoundHttpException(t('Term namex with ID @id was not found', array('@id' => $domain)));
    }

    // Append master placeholder list
    $definition = $this->getMasterPlaceholder();
    $term = reset($term);
    $group = $term->get('field_select_domain_group')->referencedEntities();
    $domainGroupPlaceholder = $this->getGroupDomainPlaceholder($group[0]->id());
    $definition = array_merge($definition, $domainGroupPlaceholder);
    $getID = $term->id();

    if(!empty($term)) {
      $query = \Drupal::database()->select('taxonomy_term__field_add_placeholder', 'p');
      $query->fields('p', ['field_add_placeholder_target_id', 'langcode']);
      $query->condition('p.entity_id', $getID, '=');
      $query->condition('p.langcode', $this->currentLanguage, '=');
      $result = $query->execute()->fetchAll();
    }

    foreach ($result as $getEntity) {
      $value = NULL;
      if ($getEntity->langcode === $this->currentLanguage) {
        $translatedEntity  = \Drupal\paragraphs\Entity\Paragraph::load($getEntity->field_add_placeholder_target_id);
        $value = $translatedEntity->field_default_value->value;
        $definition[$translatedEntity->field_placeholder_key->value] = $translatedEntity->field_default_value->value;
      }

      if (empty($value)) {
        // check the value in domain group
        $key = $translatedEntity->field_placeholder_key->value;
        $domainGroup = 'domain_groups';
        $fallback = $this->webcomposerPlaceholderFallback($domainGroup, $key);

        $checkIfKeyExits = array_key_exists($key, $fallback) ? true : false;
        if ($checkIfKeyExits == true) {
          $definition = array_merge($definition, $fallback);
        }

        // check in master placeholder list
        $masterPlaceholderList = 'master_placeholder';
        $fallback = $this->webcomposerPlaceholderFallback($masterPlaceholderList, $key);

        $checkIfKeyExits = array_key_exists($key, $fallback) ? true : false;
        if ($checkIfKeyExits == true) {
          $definition = array_merge($definition, $fallback);
        }
      }
    }

    return $definition;
  }

  /**
   * Returns all the placeholder list from domain group and placeholder list
   *
   * @param <index> $key The key
   *
   * @return <array> fallback array of domain and master placeholder list
   */
  private function webcomposerPlaceholderFallback($vid, $term) {
    $table = !empty(($vid == 'domain_groups')) ? 'field_add_placeholder' : 'field_add_master_placeholder';
    $field = !empty(($vid == 'domain_groups')) ? 'field_add_placeholder_target_id' : 'field_add_master_placeholder_target_id';
     $term = $this->entityTypeManager->getStorage('taxonomy_term')->loadByProperties(['name' => $term]);
     $term = reset($term);

     $getID = $term->id();

    if(!empty($term)) {
      $query = \Drupal::database()->select("taxonomy_term__$table", 'p');
      $query->fields('p', ["$field", 'langcode']);
      $query->condition('p.entity_id', $getID, '=');
      $query->condition('p.langcode', $this->currentLanguage, '=');
      $result = $query->execute()->fetchAll();

    }

    foreach ($result as $getEntity) {
      # code...
      $translatedEntity  = \Drupal\paragraphs\Entity\Paragraph::load($getEntity->$field);
      $key = $translatedEntity->field_placeholder_key->value;
      $value = $translatedEntity->field_default_value->value;

      $definition[$key] = $value;

    }

    return $definition;
  }

  /**
   * Get Master Placeholder Lists
   */
  private function getMasterPlaceholder() {
    $masterLists = [];
    $placeholders = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('master_placeholder');

    foreach ($placeholders as $value) {
      $token = taxonomy_term_load($value->tid);

      if ($token->hasTranslation($this->currentLanguage)) {
        $getTranslation = $token->getTranslation($this->currentLanguage);
        $paragraph = $getTranslation->get('field_add_master_placeholder')->getValue(FALSE)[0]['target_id'];
        $paragraphs = \Drupal::entityManager()->getStorage('paragraph')->load($paragraph);

        if ($paragraphs->hasTranslation($this->currentLanguage)) {
          $translated = $paragraphs->getTranslation($this->currentLanguage);
          $placeholder_key = $translated->field_placeholder_key->value;
          $placeholder_desc = $translated->field_default_value->value;
          $masterLists[$placeholder_key] = $placeholder_desc;
        }
      }
    }

    return $masterLists;
  }

  /**
   * @var int $tid Taxonomy term ID
   */
  private function getGroupDomainPlaceholder($tid) {
    $placeHolder = [];

    $term = Term::load($tid);
    $termEntities = $term->get('field_add_placeholder')->referencedEntities();

    foreach ($termEntities as $termEntity) {
      if ($termEntity->hasTranslation($this->currentLanguage)) {
        $translatedEntity = $termEntity->getTranslation($this->currentLanguage);
        $placeHolder[$translatedEntity->field_placeholder_key->value] = $translatedEntity->field_default_value->value;
      }
    }

    return $placeHolder;
  }
}
