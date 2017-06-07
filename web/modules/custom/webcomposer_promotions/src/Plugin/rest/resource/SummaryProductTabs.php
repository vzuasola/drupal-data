<?php

namespace Drupal\webcomposer_promotions\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "product_tabs",
 *   label = @Translation("Product Tabs"),
 *   uri_paths = {
 *     "canonical" = "/api/product_tabs"
 *   }
 * )
 */
class SummaryProductTabs extends ResourceBase {


  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get() {


     $build = array(
          '#cache' => array(
            'max-age' => 0,
          ),
        );

    $data = $this->getProductTabs();

    if (!$data) {
      throw new NotFoundHttpException(t('Term name with ID @id was not found'));
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
  private function getProductTabs()
  {
    $definition = array();

    // You must to implement the logic of your REST Resource here.
    $query = \Drupal::entityQuery('taxonomy_term');
      $query->condition('vid', "products");
      $query->condition('field_enable_disable', '1');
      $query->sort('weight', 'ASC');
      $tids = $query->execute();
      $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);
    if (empty($terms)) {
      throw new NotFoundHttpException(t('Term name with ID @id was not found'));
    }


      $langCode = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
      $defaultLang = \Drupal::service('language_manager')->getDefaultLanguage()->getId();

      if ($terms) {
            foreach ($terms as $getEntity) {
              if ($getEntity->hasTranslation($langCode)) {
                $translation = $getEntity->getTranslation($langCode);
                $check_enable = $translation->field_enable_disable->value;
                if($check_enable == '1') {
                  $key = $translation->id();
                  $data[] = [
                   'name' => $translation->getName(),
                   'id' => $key,
                   'count' => 'promotion count',
                  ];
                }
                else {
                  $translation = $getEntity->getTranslation($defaultLang);
                   $check_enable = $translation->field_enable_disable->value;
                  if($check_enable == '1') {
                    $key = $translation->id();
                    $data[] = [
                     'name' => $translation->getName(),
                     'id' => $key,
                     'count' => 'promotion count',
                    ];
                  }
                }
              }

            }
          }

    return $data;
  }


  /**
 * { returns all the placeholder list from domain group and placeholder list }
 *
 * @param      <index>  $key    The key
 *
 * @return     <array>  ( fallback array of domain and master placeholder list )
 */
    private function webcomposerPlaceholderFallback($vid) {

      $field = !empty(($vid == 'domain_groups')) ? 'field_add_placeholder' : 'field_add_master_placeholder';
      $definition = array();
      $query = \Drupal::entityQuery('taxonomy_term');
      $query->condition('vid', "$vid");
      $tids = $query->execute();
      $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);

      $term = reset($terms);

      $getEntities = $term->get("$field")->referencedEntities();
      $lang_code = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
      foreach ($getEntities as $getEntity) {
      if ($getEntity->hasTranslation($lang_code)) {
        $translation = $getEntity->getTranslation($lang_code);
      }

      $key = $translation->field_placeholder_key->value;
      $value = $translation->field_default_value->value;


      $definition[$key] = $value;

    }

    return $definition;
  }

}
