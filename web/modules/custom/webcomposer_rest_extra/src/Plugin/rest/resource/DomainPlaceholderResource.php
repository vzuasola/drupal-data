<?php

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "domain_placeholder",
 *   label = @Translation("Domain Placeholder"),
 *   uri_paths = {
 *     "canonical" = "/api/domain/{domain}"
 *   }
 * )
 */
class DomainPlaceholderResource extends ResourceBase
{
  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($domain)
  {
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
    private function getFieldDefinition($domain)
    {
      $definition = array();

      // You must to implement the logic of your REST Resource here.
      $term = \Drupal::entityTypeManager()
      ->getStorage('taxonomy_term')
      ->loadByProperties(['name' => $domain]);

      if (empty($term)) {
          throw new NotFoundHttpException(t('Term namex with ID @id was not found', array('@id' => $domain)));
      }

      // Append master placeholder list
      $definition = $this->getMasterPlaceholder();

      $term = reset($term);

      // Append placeholder from domain group
      $group = $term->get('field_select_domain_group')->referencedEntities();
      $domainGroupPlaceholder = $this->getGroupDomainPlaceholder($group[0]->id());
      $definition = array_merge($definition, $domainGroupPlaceholder);

      $getEntities = $term->get('field_add_placeholder')->referencedEntities();
      foreach ($getEntities as $getEntity) {

        $key = $getEntity->field_placeholder_key->value;
        $value = $getEntity->field_default_value->value;

        $definition[$key] = $value;

        if(empty($value)) {
          // check the value in domain group
          $domainGroup = 'domain_groups';
          $fallback = $this->webcomposerPlaceholderFallback($domainGroup);
          $checkIfKeyExits = array_key_exists($key, $fallback) ? true : false;
          if ($checkIfKeyExits == true) {
            $definition = array_merge($definition, $fallback);
          }

          // check in master placeholder list
          $masterPlaceholderList = 'master_placeholder';
          $fallback = $this->webcomposerPlaceholderFallback($masterPlaceholderList);
          $checkIfKeyExits = array_key_exists($key, $fallback) ? true : false;

          if ($checkIfKeyExits == true) {
            $definition = array_merge($definition, $fallback);
          }
        }
      }

      return $definition;
    }


    /**
     * { returns all the placeholder list from domain group and placeholder list }
     *
     * @param <index> $key The key
     *
     * @return <array>  ( fallback array of domain and master placeholder list )
     */
    private function webcomposerPlaceholderFallback($vid)
    {

      $field = !empty(($vid == 'domain_groups')) ? 'field_add_placeholder' : 'field_add_master_placeholder';
      $definition = array();
      $query = \Drupal::entityQuery('taxonomy_term');
      $query->condition('vid', "$vid");
      $tids = $query->execute();
      $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);

      if ($terms) {
        $term = reset($terms);
        $getEntities = $term->get("$field")->referencedEntities();

        foreach ($getEntities as $getEntity) {
          $key = $getEntity->field_placeholder_key->value;
          $value = $getEntity->field_default_value->value;

          $definition[$key] = $value;
        }
      }

      return $definition;
    }


    /**
     * Get Master Placeholder Lists
     */
    private function getMasterPlaceholder()
    {
      $masterLists = [];
      $masterQuery = \Drupal::entityQuery('taxonomy_term');
      $masterQuery->condition('vid', 'master_placeholder');
      $masterPlaceholderTids = $masterQuery->execute();

      $masterTerms = Term::loadMultiple($masterPlaceholderTids);

      foreach ($masterTerms as $masterTerm) {
        $termEntities = $masterTerm->get('field_add_master_placeholder')->referencedEntities();

        foreach ($termEntities as $termEntity) {
          $masterLists[$termEntity->field_placeholder_key->value] = $termEntity->field_default_value->value;
        }
      }

      return $masterLists;
    }


    /**
     * @var int $tid
     *    Taxonomy term ID
     */
    private function getGroupDomainPlaceholder($tid)
    {
      $placeHolder = [];

      $term = Term::load($tid);
      $termEntities = $term->get('field_add_placeholder')->referencedEntities();

      foreach ($termEntities as $termEntity) {
        $placeHolder[$termEntity->field_placeholder_key->value] = $termEntity->field_default_value->value;
      }

      return $placeHolder;
    }
}
