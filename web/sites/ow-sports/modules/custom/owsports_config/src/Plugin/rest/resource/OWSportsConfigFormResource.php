<?php

namespace Drupal\owsports_config\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "owsports_config_resource",
 *   label = @Translation("OWSports Custom Configuration Form"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class OWSportsConfigFormResource extends ResourceBase {
  /**
   * Responds to GET requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function get($id) {
    $data = array();

    try {
      $config = \Drupal::config("owsports_config.$id");
      $data = $config->get();
    } catch (\Exception $e) {
      $data = array(
        'error' => $this->t('Configuration not found')
      );
    }

    $build = array(
      '#cache' => array(
        'max-age' => 0,
      ),
    );

    return (new ResourceResponse($data))->addCacheableDependency($build);
  }
}
