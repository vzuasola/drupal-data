<?php
namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\rest\ModifiedResourceResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Creates a resource for submitting a webform.
 *
 * @RestResource(
 *   id = "mail_rest_submit",
 *   label = @Translation("Mail Submit"),
 *   uri_paths = {
 *     "canonical" = "/mail_rest/submit",
 *     "https://www.drupal.org/link-relations/create" = "/mail_rest/submit"
 *   }
 * )
 */
class MailSubmitResource extends ResourceBase {

    /**
    * Responds to entity POST requests and saves the new entity.
    *
    * @param array $data
    *   Mail field data and webform ID.
    *
    * @return \Drupal\rest\ResourceResponse
    *   The HTTP response object.
    *
    * @throws \Symfony\Component\HttpKernel\Exception\HttpException
    *   Throws HttpException in case of error.
    */
    public function post(array $data)
    {
        return new Response('{"200": "Form Submitted Gracefully"}', 200);
        //return new Response('{"500": "Form Submitted Failed"}', 500);
    }
}
