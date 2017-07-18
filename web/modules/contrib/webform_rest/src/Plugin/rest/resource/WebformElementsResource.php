<?php

namespace Drupal\webform_rest\Plugin\rest\resource;

use Drupal\webform\Entity\Webform;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Drupal\webform\WebformThirdPartySettingsManager;
use Drupal\file\Entity\File;

/**
 * Creates a resource for retrieving webform elements.
 *
 * @RestResource(
 *   id = "webform_rest_elements",
 *   label = @Translation("Webform Elements"),
 *   uri_paths = {
 *     "canonical" = "/webform_rest/elements/{webform_id}"
 *   }
 * )
 */
class WebformElementsResource extends ResourceBase {

  /**
   * Responds to GET requests, returns webform elements.
   *
   * @param string $webform_id
   *   Webform ID.
   *
   * @return \Drupal\rest\ResourceResponse
   *   HTTP response object containing webform elements.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws HttpException in case of error.
   */
  public function get($webform_id) {
    if (empty($webform_id)) {
      throw new HttpException(t("Webform ID wasn't provided"));
    }

    // Load the webform.
    $webform = Webform::load($webform_id);

    // Basic check to see if something's returned.
    if ($webform) {
      // third party settings
      $vendorSettings = $this->getVendorSettings($webform);

      $response = [
        'elements' => $webform->getElementsDecodedAndFlattened(),
        'settings' => $webform->getSettings(),
        'third_party_settings' => $vendorSettings,
      ];

      $build = array( 
        '#cache' => array( 
          'max-age' => 0, 
        ), 
      );

      // Return only the form elements.
      return (new ResourceResponse($response))->addCacheableDependency($build); 
    }

    throw new HttpException(t("Can't load webform."));
  }

  /**
   * Gets all third part settings
   */
  private function getVendorSettings($webform) {
    $results = [];

    $providers = $webform->getThirdPartyProviders();

    foreach ($providers as $provider) {
      $settings = $webform->getThirdPartySettings($provider);
      $results[$provider] = $settings;
    }
  
      
    foreach ($results['webcomposer_webform']['webform_background'] as $key => $value) {
 
      if (!empty($value[0])) {
           $file = $this->loadFileById($value[0]);
           foreach ($file as $value) {
            $fileImageURL = $value['url'];
            $results['webcomposer_webform']['webform_background'][$key][0] = $fileImageURL;
           }
      }
    }

    return $results;
  }

   /**
   * Load file url data by target ID
   */
  private function loadFileById($fid) {
    $result = [];
    $fileArray = []; 

    if (isset($fid)) {
      $file = File::load($fid);

      if ($file) {
        $fileArray = $file->toArray();
        $fileArray['url'] = file_create_url($file->getFileUri());
      }
    }

    $result[] = $fileArray;

    return $result;
  }
}
