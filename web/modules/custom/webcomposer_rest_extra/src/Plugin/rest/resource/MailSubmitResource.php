<?php
namespace Drupal\webcomposer_rest_extra\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\rest\ModifiedResourceResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Component\Utility\Html;

/**
 * Creates a resource for submitting a email.
 *
 * @RestResource(
 *   id = "mail_rest_submit",
 *   label = @Translation("Mail Submission"),
 *   uri_paths = {
 *     "canonical" = "/email/submission",
 *     "https://www.drupal.org/link-relations/create" = "/email/submission"
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
    public function post(array $data) {

        $langcode = $data['langcode'];
        $from = filter_var(Html::escape($data['from']), FILTER_SANITIZE_EMAIL);
        $to = filter_var(Html::escape($data['to']), FILTER_SANITIZE_EMAIL);
        $module = $data['module'];
        $key = $data['key'];

        $params = $data['params'];

        // Send email with drupal_mail.
        $mail =  \Drupal::service('plugin.manager.mail')->mail($module, $key, $to, $langcode, $params, $from);

        $build = [
          '#cache' => [
          'max-age' => 0,
          ],
        ];

        if ($mail['result']) {
            $data = [
              'success' => $this->t('Mail Submit Success.'),
            ];
            return (new ResourceResponse($data))->addCacheableDependency($build);
        }

        $data = [
          'error' => $this->t('Mail Submit Fail.'),
        ];
        return (new ResourceResponse($data, 404))->addCacheableDependency($build);
    }
}
