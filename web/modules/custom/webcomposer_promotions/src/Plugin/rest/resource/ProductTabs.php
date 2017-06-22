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
  private function getProductTabs($state, $type) {
    // You must to implement the logic of your REST Resource here.
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

        $checkEnable = $translation->field_enable_disable->value;

        // Get count of promotions tagged with product.
        if ($checkEnable === '1') {
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
            $count = $this->getPromotionCount($key, $langCode, $state);
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
   * Gets the product specific promotion count.
   *
   * @param <array> $tids The tids
   *
   * @return <string> The product promotion count.
   */
  private function getPromotionCount($productId, $langCode, $state) {
    $query = \Drupal::entityQuery('node')->condition('type', 'promotion');

    $countNids = $query->execute();

    if ($countNids) {
      // Get a node storage object.
      $nodeStorage = \Drupal::entityManager()
        ->getStorage('node')
        ->loadMultiple((array) $countNids);

      if ($nodeStorage) {
        $countNid = [];

        foreach ($nodeStorage as $getEntity) {
          if ($getEntity->hasTranslation($langCode)) {
            $translation = $getEntity->getTranslation($langCode);

            $status = $translation->status->value;
            $product = $translation->field_product->target_id;
            $hidePromotion = $translation->field_hide_promotion->value;
            $loginState = $translation->field_log_in_state->value;

            if ($status == '1' &&
              $product == $productId &&
              $hidePromotion == '0' &&
              in_array($loginState, array($state, '2'))
            ) {
              $countNid[] = $translation->nid->value;
            }
          }
        }

        $result = count($countNid);
      }
    }

    $result = !empty($result) ? $result : "0";

    return $result;

    return $countNids;
  }

  /**
   * Gets the Featured product promotion count for all products.
   *
   * @return <string> The product promotion count.
   */
  private function getAllFeaturedPromotionCount($langCode, $state) {
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'promotion');

    $countNids = $query->execute();

    // Get a node storage object.
    $nodeStorage = \Drupal::entityManager()->getStorage('node')->loadMultiple($countNids);
    if ($nodeStorage) {
      $countNid = [];
      
      foreach ($nodeStorage as $getEntity) {
        if ($getEntity->hasTranslation($langCode)) {
          $translation = $getEntity->getTranslation($langCode);

          $status = $translation->status->value;
          $hidePromotion = $translation->field_hide_promotion->value;
          $checkFeatured = $translation->field_mark_as_featured->value;
          $loginState = $translation->field_log_in_state->value;

          if ($status == '1' && 
            $checkFeatured == '1' &&
            $hidePromotion == '0' &&
            in_array($loginState, array($state, '2'))
          ) {
            $countNid[] = $translation->nid->value;
          }
        }
      }

      $result = count($countNid);
    }

    $result = !empty($result) ? $result : "0";

    return $result;
  }
}
