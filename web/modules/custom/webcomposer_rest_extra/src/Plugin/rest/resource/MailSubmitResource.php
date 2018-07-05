<?php
namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\rest\ModifiedResourceResponse;
use Symfony\Component\HttpFoundation\Response;
/**
 * Creates a resource for submitting a email.
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
    * Responds to entity POST requests and email by Drupal mail.
    *
    * @param array $data
    *   Mail field data.
    *
    * @return \Drupal\rest\ResourceResponse
    *   The HTTP response object.
    *
    * @throws \Symfony\Component\HttpKernel\Exception\HttpException
    *   Throws HttpException in case of error.
    */
    public function post(array $data)
    {

        $langcode = $data['langcode'];
        $from = $data['from'];
        $to = $data['to'];
        $module = $data['module'];
        $key = $data['key'];

        $params['subject'] = $data['subject'];
        $params['body'] = $data['body'];

        // Send email with drupal_mail.
        $mail =  \Drupal::service('plugin.manager.mail')->mail($module, $key, $to, $langcode, $params, $from);

        if($mail['result']) {
          return new Response('{"200": "Mail Submit Success"}', 200);
        }

        return new Response('{"400": "Mail Submit Fail"}', 400);
    }
}
