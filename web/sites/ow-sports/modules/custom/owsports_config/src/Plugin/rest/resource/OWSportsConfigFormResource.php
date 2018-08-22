<?php

namespace Drupal\owsports_config\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\file\Entity\File;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;

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
  use FilterHtmlTrait;
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
      $this->resolveFieldImages($id, $data);
      $this->resolveRecursive($data);
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

  /**
   * Temporary solution for fields not using standard naming schemes.
   *
   * @param string $id
   *   The configuration resource ID.
   * @param array $data
   *   The configuration data.
   */
  private function resolveFieldImages($id, &$data) {
    $file_id = $data['file_image_maintenance'][0];

    $file = File::load($file_id);
    if ($file) {
      $data['file_image_maintenance_url'] = $this->generateUrlFromFile($file);
    }
  }

  /**
   * Resolve images do their respective absolute URLs.
   *
   * @param array $data
   *   The configuration data.
   */
  private function resolveRecursive(&$data) {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $this->resolveRecursive($value);
      }

      // replacements for field with uploaded images
      if (0 === strpos($key, 'file_image') && isset($value[0])) {
        $file = File::load($value[0]);
        if ($file) {
          $data[$key] = $this->generateUrlFromFile($file);
        }
      }

      // replacement for configs with HTML markup field formats
      if (isset($value['value']) &&
        isset($value['format']) &&
        $value['format'] == 'basic_html'
      ) {
        $data[$key]['value'] = $this->filterHtml($value['value']);
      }
    }
  }
}
