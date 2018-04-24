<?php

namespace Drupal\dafasports_config\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\file\Entity\File;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "dafasports_config_resource",
 *   label = @Translation("DafaSports Custom Configuration Form"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class DafaSportsConfigFormResource extends ResourceBase {
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
    $data = [];

    try {
      $config = \Drupal::config("dafasports_config.$id");
      $data = $config->get();
      $this->resolveRecursive($data);
    } catch (\Exception $e) {
      $data = [
        'error' => $this->t('Configuration not found')
      ];
    }

    $build = [
      '#cache' => [
        'max-age' => 0,
      ],
    ];


    return (new ResourceResponse($data))->addCacheableDependency($build);
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
