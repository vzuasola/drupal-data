<?php

namespace Drupal\webform_rest\Plugin\rest\resource;

use Drupal\webform\Entity\Webform;
use Drupal\webform\WebformSubmissionForm;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\rest\ModifiedResourceResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * Creates a resource for submitting a webform.
 *
 * @RestResource(
 *   id = "webform_rest_submit",
 *   label = @Translation("Webform Submit"),
 *   uri_paths = {
 *     "canonical" = "/webform_rest/submit",
 *     "https://www.drupal.org/link-relations/create" = "/webform_rest/submit"
 *   }
 * )
 */
class WebformSubmitResource extends ResourceBase {

  /**
   * Responds to entity POST requests and saves the new entity.
   *
   * @param array $webform_data
   *   Webform field data and webform ID.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws HttpException in case of error.
   */
  public function post(array $webform_data) {
// return new ResourceResponse($webform_data);
    // Basic check for webform ID.
    if (empty($webform_data['webform_id'])) {
      return new Response('', 500);
    }

    $this->setDataFlags();

    // Convert to webform values format.
    $values = [
      'webform_id' => $webform_data['webform_id'],
      'entity_type' => NULL,
      'entity_id' => NULL,
      'in_draft' => FALSE,
      'uri' => '/webform/' . $webform_data['webform_id'] . '/api',
      'remote_addr' => $webform_data['remote_addr'],
    ];

    // Don't submit webform ID.
    unset($webform_data['webform_id']);

    $values['data'] = $webform_data;

    // Check webform is open.
    $webform = Webform::load($values['webform_id']);
    $is_open = WebformSubmissionForm::isOpen($webform);
    $webformSetting = $webform->getSettings();
    $is_closed = $webform->isClosed();
    if ($is_open === TRUE) {
      // Validate submission.
      $errors = WebformSubmissionForm::validateValues($values);

      // Check there are no validation errors.
      if (!empty($errors)) {
        $errors = [
        'error' => $errors,
        'form_exception_message' => $webformSetting['form_exception_message']];
        return new ModifiedResourceResponse($errors);
      }
      else {
        // Return submission ID.
        $webform_submission = WebformSubmissionForm::submitValues($values);

        $response = [
        'sid' => $webform_submission->id(),
        'confirmation_message' => $webformSetting['confirmation_message'],

        ];
        return new ModifiedResourceResponse($response);
      }
    }
    elseif($is_closed === TRUE){
      // if the form is closed
      $response = [
        'form_close_message' => $webformSetting['form_close_message'],

        ];
        return new ModifiedResourceResponse($response);

    }
    else {
      $response = [
        'limit_total_message' => $webformSetting['limit_total_message'],

        ];
        return new ModifiedResourceResponse($response);
    }
  }

  /**
   * Sets custom data flag before a batch operation starts
   */
  private function setDataFlags() {
    define('AUDIT_LOG_EXCLUDE_REQUEST', TRUE);
  }

}
