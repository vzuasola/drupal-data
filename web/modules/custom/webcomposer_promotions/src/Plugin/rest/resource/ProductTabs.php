<?php

namespace Drupal\webcomposer_promotions\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Drupal\node\Entity\Node;


/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * TODO This can be refined
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
   *  A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $currentRequest;

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
   *   The current user instance.
   * @param Symfony\Component\HttpFoundation\Request $current_request
   *   The current request
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, array $serializer_formats, LoggerInterface $logger, AccountProxyInterface $current_user, Request $current_request) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->currentUser = $current_user;
    $this->currentRequest = $current_request;
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
      $container->get('logger.factory')->get('rest'),
      $container->get('current_user'),
      $container->get('request_stack')->getCurrentRequest()
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
  public function get() {
    $build = array(
      '#cache' => array(
        'max-age' => 0,
        ),
      );

    $state = $this->currentRequest->query->get('state');
    $type = $this->currentRequest->query->get('type');

    $data = $this->getProductTabs($state, $type);

    if (!$data) {
      $errorMessage = t('No Product tabs are configured. Please configure the products and translation in product taxonomy.');
      \Drupal::logger('wbc_rest_resource')->error($errorMessage);
      throw new NotFoundHttpException($errorMessage);
    }

    return (new ResourceResponse($data))->addCacheableDependency($build);
  }

  /**
   * Gets the product tabs.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException  (description)
   *
   * @return <json> The product tabs.
   */
  private function getProductTabs($state, $type)
  {
    //You must to implement the logic of your REST Resource here.
    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', "products");
    $query->sort('weight', 'ASC');
    $tids = $query->execute();
    $terms = \Drupal\taxonomy\Entity\Term::loadMultiple($tids);

    if (empty($terms)) {
      $errorMessage = t('No Product tabs are configured. Please configure the
        products and translation in product taxonomy.');
      \Drupal::logger('wbc_rest_resource')->error($errorMessage);
      throw new NotFoundHttpException($errorMessage);
    }

    // Get current and default language for fall back.
    $langCode = \Drupal::service('language_manager')->getCurrentLanguage()->getId();
    $defaultLang = \Drupal::service('language_manager')->getDefaultLanguage()->getId();

    if ($terms) {
      foreach ($terms as $getEntity) {
        try {
          $translation = $getEntity->getTranslation($langCode);
        } catch (\Exception $e) {
          $translation = $getEntity->getTranslation($defaultLang);
        }

        $check_enable = $translation->field_enable_disable->value;

        // Get count of promotions tagged with product.
        if ($check_enable === '1') {

          $filters = [];
          $productId = $getEntity->field_product_id->value;
          $class = isset($translation->field_class->value) ? $translation->field_class->value : NULL;
          $target = isset($translation->field_target->value) ? $translation->field_target->value : NULL;
          $tag = isset($translation->field_menu_tag->value) ? $translation->field_menu_tag->value : NULL;

          $key = $translation->Id();

          // Find the sub filter of product term
          $findChildren = \Drupal::entityTypeManager()
            ->getStorage('taxonomy_term')
            ->loadTree('products', $parent = $key, $max_depth = NULL, $load_entities = FALSE);

          foreach ($findChildren as $value) {
            if (in_array($key, $value->parents)) {

              // get term translation
              $term = \Drupal\taxonomy\Entity\Term::load($value->tid);

              try {
                $filterTranslated = $term->getTranslation($langCode);
              } catch (\Exception $e) {
                $filterTranslated = $term->getTranslation($defaultLang);
              }

              $filters[] = [
                'filter_name' => $filterTranslated->name->value,
                'id' => $value->tid ,
                'parent' => $value->parents,
                'subfilter_id' => $term->field_product_id->value,
              ];
            }
          }

          // get a separate count for the All featured tab
          if ($productId == 'all') {
            $count = $this->getAllFeaturedPromotionCount($langCode, $state);
          } else {
            $count = $this->getProductPromotionCount($key, $langCode, $state, $type);
          }

          $productAttribute = ['class'=> $class , 'target' => $target, 'tag' => $tag];

          $data[] = [
            'product_name' => $translation->getName(),
            'product_id' => $productId,
            'id' => $key,
            'count' => $count,
            'product_attribute' => $productAttribute,
            'filters' => $filters,
          ];
        }
      }
    }

    return $data;
  }

  /**
   * Gets the product promotion count.
   *
   * @param <array> $tids The tids
   *
   * @return <string> The product promotion count.
   */
  private function getProductPromotionCount($tids , $langCode, $state, $type) {
    $count = 0;

    switch ($state) {
      case '0':
        $count = $this->getPromotionCount($tids , $langCode, $state);
        if ($type == 'featured') {
          $count = $this->getFeaturedPromotionCount($tids , $langCode, $state, $type);
        }
        break;

      case '1':
        $count = $this->getPromotionCount($tids , $langCode, $state);
        if ($type == 'featured') {
          $count = $this->getFeaturedPromotionCount($tids , $langCode, $state, $type);
        }
        break;

      case 'all':
        $count = $this->getAllPromotionCount($tids , $langCode);
        break;

      case 'hidden':
        $count = $this->getHiddenPromotionCount($tids, $langCode);
        break;
    }

    return $count;
  }

  /**
   * Gets the product specific promotion count.
   *
   * @param <array> $tids The tids
   *
   * @return <string> The product promotion count.
   */
  private function getPromotionCount($tids, $langCode, $state) {
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'promotion')
      ->condition('field_product', "$tids")
      ->condition('field_hide_promotion', "0")
      ->condition('field_log_in_state', array("$state", '2'), 'IN')
      ->condition('langcode' , "$langCode");

    $countNids = $query->count('processes')->execute();
    $countNids = !empty($countNids) ? $countNids : "0";

    return $countNids;
  }

  /**
   * Gets All the product promotion count.
   *
   * @param <array> $tids The tids
   *
   * @return <string> The product promotion count.
   */
  private function getAllPromotionCount($tids , $langCode) {
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'promotion')
      ->condition('field_product', "$tids")
      ->condition('langcode' , "$langCode");

    $countNids = $query->count('processes')->execute();
    $countNids = !empty($countNids) ? $countNids : "0";

    return $countNids;
  }

  /**
   * Gets the Featured product promotion count for all products.
   *
   * @return <string> The product promotion count.
   */
  private function getAllFeaturedPromotionCount($langCode, $state) {
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'promotion')
      ->condition('field_hide_promotion', "0")
      ->condition('field_log_in_state', array("$state", '2') , 'IN')
      ->condition('field_mark_as_featured', "1")
      ->condition('langcode' , "$langCode");

    $countNids = $query->count('processes')->execute();
    $countNids = !empty($countNids) ? $countNids : "0";

    return $countNids;
  }

  /**
   * Gets the Featured product promotion count.
   *
   * @param <array> $tids The tids
   *
   * @return <string> The product promotion count.
   */
  private function getFeaturedPromotionCount($tids , $langCode, $state) {
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'promotion')
      ->condition('field_product', "$tids")
      ->condition('field_hide_promotion', "0")
      ->condition('field_log_in_state', array("$state", '2') , 'IN')
      ->condition('field_mark_as_featured', "1")
      ->condition('langcode' , "$langCode");

    $countNids = $query->count('processes')->execute();
    $countNids = !empty($countNids) ? $countNids : "0";

    return $countNids;
  }

  /**
   * Gets the Hidden product promotion count.
   *
   * @param <array> $tids The tids
   *
   * @return <string> The product promotion count.
   */
  private function getHiddenPromotionCount($tids , $langCode) {
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'promotion')
      ->condition('field_product', "$tids")
      ->condition('field_hide_promotion', "1")
      ->condition('langcode' , "$langCode");

    $countNids = $query->count('processes')->execute();
    $countNids = !empty($countNids) ? $countNids : "0";

    return $countNids;
  }
}
