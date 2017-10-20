<?php

namespace Drupal\webcomposer_affilates\Plugin\rest\resource;

use Drupal\taxonomy\Entity\Term;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "affilate_group_list",
 *   label = @Translation("Affilate Group List"),
 *   uri_paths = {
 *     "canonical" = "/api/affilate"
 *   }
 * )
 */
class AffilatesGroupList extends ResourceBase {

  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get() {

    $build = [
      '#cache' => [
        'max-age' => 0,
      ],
    ];

    $data = $this->getFieldDefinition();

    if (!$data) {
      $errorMessage = t('No Affilate has been added');
      \Drupal::logger('wbc_rest_resource')->error($errorMessage);
      throw new NotFoundHttpException($errorMessage);
    }

    return (new ResourceResponse($data))->addCacheableDependency($build);

  }

  /**
   * Gets the field definition.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
   *   It term do not get loaded.
   *
   * @return mixed
   *   The field definition.
   */
  private function getFieldDefinition() {

    // You must to implement the logic of your REST Resource here.
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', "affiliates_parameters");
    $query->condition('field_active', '1');
    $query->sort('weight', 'ASC');
    $tids = $query->execute();
    $terms = Term::loadMultiple($tids);

    if (empty($terms)) {
      throw new NotFoundHttpException(t('No Affilate has been added'));
    }

    foreach ($terms as $term) {
      $getEntities = $term->get('field_select_affiliates_group')->referencedEntities();
      foreach ($getEntities as $getEntity) {
        $name = $getEntity->getName();
      }

      $key = $term->id();
      $data[] = [
        'parameter_name' => $term->getName(),
        'id' => $key,
        'weight' => $term->getWeight(),
        'group_name' => $name,
      ];
    }

    return $data;
  }

}
