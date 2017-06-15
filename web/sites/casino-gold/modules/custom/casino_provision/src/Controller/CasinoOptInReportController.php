<?php
/**
 * @file
 * Contains \Drupal\casino_provision\Controller\CasinoOptInReportController.
 *
 * Note: This file is no longer needed. we will delete this file once they
 * verified the update in qa1 environment
 */

namespace Drupal\casino_provision\Controller;

use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CasinoOptInReportController extends ControllerBase {

  /**
   * $connection
   */
  protected $connection;

  /**
   * @var \Drupal\Core\Database\Connection $conn
   */
  public function __construct($conn){
    $this->connection = $conn;
  }

  /**
   * @var Symfony\Component\DependencyInjection\ContainerInterface $container
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Page-API Callback
   */
  public function casinoProvision(Request $request) {

    $responseStatus = array(
      'status' => 'failed',
      'message' => 'Something went wrong, please check your data.',
    );

    // This condition checks the `Content-type` and makes sure to
    // decode JSON string from the request body into array.
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {

      $data = json_decode($request->getContent(), TRUE);
      $request->request->replace(is_array($data) ? $data : array());

      if (!empty($data['username']) && !empty($data['application_date']) && !empty($data['currency'])) {
        try {

          $isOnProcess = $this->checkUsernameIfInProcess($data['username']);

          if ($isOnProcess) {
            $responseStatus = array(
              'status' => 'on-process',
              'message' => 'User application is currently on-process',
            );
          } else {
            $isSaved = $this->connection->insert('casino_provision_report')
                        ->fields(array(
                          'username' => $data['username'],
                          'application_date' => $data['application_date'],
                          'currency' => $data['currency']
                        ))
                        ->execute();

            if ($isSaved) {
              $responseStatus = array(
                'status' => 'success',
                'message' => 'Data have been saved successfully.',
              );
            }
          }

        } catch (\Exception $e){
          \Drupal::logger('casino_provision')->notice($e);
          return new JsonResponse($responseStatus);
        }
      }
    }

    return new JsonResponse($responseStatus);
  }

  /**
   * Check username if it's already on-process
   */
  private function checkUsernameIfInProcess($username) {
    $query = $this->connection->select('casino_provision_report', 'opt')
                          ->fields('opt', array('username'))
                          ->condition('opt.username', $username);

    $result = $query->execute();
    $data = $result->fetchField();

    if ($data) {
      return true;
    } else {
      return false;
    }
  }
}
