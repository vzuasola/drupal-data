<?php

namespace Drupal\webform_rest\Plugin\rest\resource;

use Drupal\webform\Entity\Webform;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Drupal\webform\WebformThirdPartySettingsManager;
use Symfony\Component\Yaml\Yaml;

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
      $webformSettingLayout = $webform->getThirdPartySetting('webcomposer_webform', 'webcomposer_webform_layout');
      $webformSettingSubmissionLayout = $webform->getThirdPartySetting('webcomposer_webform', 'webcomposer_webform_submission_layout');
      $webformSettingBackground = $webform->getThirdPartySetting('webcomposer_webform', 'webform_background');

     // $form = array_merge($form['elements'], $webformSetting);

      $response = [
        'elements' => Yaml::dump($form['elements']),
        'settings' => $webform->getSettings(),
        'third_party_settings' => [
          'webcomposer_webform' => [
            'webcomposer_webform_layout' => $webformSettingLayout,
            'webcomposer_webform_submission_layout' => $webformSettingSubmissionLayout,
            'webform_background' => $webformSettingBackground,
          ],
        ],

      ];
      // Return only the form elements.
      return new ResourceResponse($response);
    }

    throw new HttpException(t("Can't load webform."));

  }

}
