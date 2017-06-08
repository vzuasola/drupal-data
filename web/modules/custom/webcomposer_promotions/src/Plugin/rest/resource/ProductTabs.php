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
class ProductTabs extends ResourceBase {


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
      $errorMessage = t('No Product tabs are configured. Please configure the products and translation in product taxonomy.');
      \Drupal::logger('wbc_rest_resoruce')->error($errorMessage);
      throw new NotFoundHttpException($errorMessage);
    }

    return (new ResourceResponse($data))->addCacheableDependency($build);


  }

/**
 * Gets the product tabs.
 *
 * @throws     \Symfony\Component\HttpKernel\Exception\NotFoundHttpException  (description)
 *
 * @return     <json>                                                         The product tabs.
 */
  private function getProductTabs()
  {

    // You must to implement the logic of your REST Resource here.
    $query = \Drupal::entityQuery('taxonomy_term');
      $query->condition('vid', "products");
      $query->condition('field_enable_disable', '1');
      $query->sort('weight', 'ASC');
      $tids = $query->execute();
      $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);
    if (empty($terms)) {
      $errorMessage = t('No Product tabs are configured. Please configure the products and translation in product taxonomy.');
      \Drupal::logger('wbc_rest_resoruce')->error($errorMessage);
      throw new NotFoundHttpException($errorMessage);
    }

    // Get current and default language for fallback.
      $langCode = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
      $defaultLang = \Drupal::service('language_manager')->getDefaultLanguage()->getId();

      if ($terms) {
        foreach ($terms as $getEntity) {
          if ($getEntity->hasTranslation($langCode)) {
            $translation = $getEntity->getTranslation($langCode);
            $check_enable = $translation->field_enable_disable->value;
            $class = $translation->field_class->value;
            $target = $translation->field_target->value;
            $tag = $translation->field_menu_tag->value;
            // Get count of promotions tagged with product.

            if($check_enable == '1') {
              $key = $translation->id();
              $count = $this->getProductPromotionCount($key, $langCode);

              $productAttribute = ['class'=> $class , 'target' => $target, 'tag' => $tag];
              $data[] = [
               'product_name' => $translation->getName(),
               'id' => $key,
               'count' => $count,
               'product_attribute' => $productAttribute,
              ];
            }
            else {
              $translation = $getEntity->getTranslation($defaultLang);
               $check_enable = $translation->field_enable_disable->value;
              if($check_enable == '1') {
                $key = $translation->id();
                $data[] = [
                 'product_name' => $translation->getName(),
                 'id' => $key,
                 'product_attribute' => $productAttribute,
                ];
              }
            }
          }

        }
      }

    return $data;

  }


/**
 * Gets the product promotion count.
 *
 * @param      <array>  $tids   The tids
 *
 * @return     <string>  The product promotion count.
 */
    private function getProductPromotionCount($tids , $langCode) {

     $query = \Drupal::entityQuery('node')
    ->condition('status', 1)
    ->condition('type', 'promotion')
    ->condition('field_product', "$tids")
    ->condition('langcode' , "$langCode");

    $countNids = $query->count('processes')->execute();
    $countNids = !empty($countNids) ? $countNids : "0";

    return $countNids;
   }

}
