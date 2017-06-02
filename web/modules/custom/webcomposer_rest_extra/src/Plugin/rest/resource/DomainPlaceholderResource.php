<?php

namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


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
class DomainPlaceholderResource extends ResourceBase {


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
   * @param      <string>                                                         $domain  The domain
   *
   * @throws     \Symfony\Component\HttpKernel\Exception\NotFoundHttpException  (if term do not get loaded)
   *
   * @return     array                                                          The field definition.
   */
  private function getFieldDefinition($domain)
  {
    $definition = array();

    // You must to implement the logic of your REST Resource here.
    $term = \Drupal::entityTypeManager()
        ->getStorage('taxonomy_term')
        ->loadByProperties(['name' => $domain]);

    if (empty($term)) {
      throw new NotFoundHttpException(t('Term name with ID @id was not found', array('@id' => $domain)));
    }

    $lang_code = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    $term = reset($term);
    $getEntities = $term->get('field_add_placeholder')->referencedEntities();

    foreach ($getEntities as $getEntity) {
      if ($getEntity->hasTranslation($lang_code)) {
        $translation = $getEntity->getTranslation($lang_code);
      }

      $key = $translation->field_placeholder_key->value;
      $value = $translation->field_default_value->value;


      $definition[$key] = $value;

      if(empty($value)) {
        //check in master placeholder list
        $masterPlaceholderList = 'master_placeholder';
        $fallback = $this->webcomposerPlaceholderFallback($masterPlaceholderList);

      }

   }

    return $definition;
  }


  /**
 * { function_description }
 *
 * @param      <type>  $key    The key
 *
 * @return     <type>  ( description_of_the_return_value )
 */
    private function webcomposerPlaceholderFallback($vid) {
      $definition = array();
      $query = \Drupal::entityQuery('taxonomy_term');
      $query->condition('vid', "$vid");
      $tids = $query->execute();
      $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);

      $term = reset($terms);

     $getEntities = $term->get('field_add_master_placeholder')->referencedEntities();
       $lang_code = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
      foreach ($getEntities as $getEntity) {
      if ($getEntity->hasTranslation($lang_code)) {
        $translation = $getEntity->getTranslation($lang_code);
         // kint($translation);die();
      }

      $key = $translation->field_placeholder_key->value;
      $value = $translation->field_default_value->value;


      $definition[$key] = $value;

    }

    return $definition;
}

}
