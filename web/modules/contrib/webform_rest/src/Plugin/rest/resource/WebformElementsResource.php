<?php

namespace Drupal\webform_rest\Plugin\rest\resource;

use Drupal\Core\Render\Element;
use Drupal\webform\Entity\Webform;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Drupal\webform\WebformThirdPartySettingsManager;

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
      // Grab the form in its entirety.
      $form = $webform->getSubmissionForm();
      $webformSetting = $webform->getSettings();

      // third party settings
      $vendorSettings = $this->getVendorSettings($webform);

      // remove non element values on the element array by only getting
      // valid element children
      $elements = [];

      foreach (Element::children($form['elements']) as $key) {
        $elements[$key] = $form['elements'][$key];
      }

      $response = [
        'elements' => $elements,
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

    return $results;
  }
}
