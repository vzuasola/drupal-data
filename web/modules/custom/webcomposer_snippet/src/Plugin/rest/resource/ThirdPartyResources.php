<?php

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\Core\Entity;


/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "external_resources",
 *   label = @Translation("External Resources"),
 *   uri_paths = {
 *     "canonical" = "/api/external_resources/{route}"
 *   }
 * )
 */
class ThirdPartyResources extends ResourceBase {


  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($route) {


     $build = array(
          '#cache' => array(
            'max-age' => 0,
          ),
        );

    $data = $this->getFieldDefinition($route);

    if (!$data) {
      throw new NotFoundHttpException(t('No Script found for given Route @id', array('@id' => $route)));
    }

    return (new ResourceResponse($data))->addCacheableDependency($build);


  }

  /**
   * Gets the field definition.
   *
   * @param      <string>                                                         $route  The route name mention in node
   *
   * @throws     \Symfony\Component\HttpKernel\Exception\NotFoundHttpException  (if route do not get loaded)
   *
   * @return     array                                                          The field definition.
   */
  private function getFieldDefinition($route)
  {
    $definition = array();


     // You must to implement the logic of your REST Resource here.

    if($route == '*') {
      $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'third_party_css_and_javascript');
     $entity_ids = $query->execute();
    }
    else {
      $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'third_party_css_and_javascript')
      ->condition('field_route_name', $route);
     $entity_ids = $query->execute();
    }

    if (empty($entity_ids)) {
      throw new NotFoundHttpException(t('No Script found for given Route @id', array('@id' => $route)));
    }


    $lang_code = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
    foreach ($entity_ids as $value) {
       $getEntity = \Drupal::entityTypeManager()->getStorage('node')->load($value);
       if ($getEntity->hasTranslation($lang_code)) {
         $definition[] = $getEntity->getTranslation($lang_code);
       }
    }

    return $definition;
  }


}
