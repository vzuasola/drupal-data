<?php
/**
 * @file
 * Contains Drupal\casino_provision\Plugin\rest\resource
 */

namespace Drupal\casino_provision\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Psr\Log\LoggerInterface;


/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "casino_provision_rest_resource",
 *   label = @Translation("Casino Provisioning"),
 *   uri_paths = {
 *     "canonical" = "/api/provision",
 *     "https://www.drupal.org/link-relations/create" = "/api/provision"
 *   }
 * )
 */
class CasinoProvisionResource extends ResourceBase
{

    /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
    protected $currentUser;

    /**
   * Database connection
   */
    protected $connection;

    /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array                                      $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string                                     $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed                                      $plugin_definition
   *   The plugin implementation definition.
   * @param array                                      $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface                   $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   */
    public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        array $serializer_formats,
        LoggerInterface $logger,
        AccountProxyInterface $current_user,
        $conn
    ) {
        parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
        $this->currentUser = $current_user;
        $this->connection = $conn;
    }

    /**
   * {@inheritdoc}
   */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
    {
        return new static(
        $configuration,
        $plugin_id,
        $plugin_definition,
        $container->getParameter('serializer.formats'),
        $container->get('logger.factory')->get('rest'),
        $container->get('current_user'),
        $container->get('database')
        );
    }

    /**
   * Responds to POST requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
    public function post($data)
    {

        if(!$this->currentUser->hasPermission($permission)) {
            throw new AccessDeniedHttpException();
        }

        $responseStatus = [
        'status' => 'failed',
        'message' => 'Something went wrong, please check your data.',
        ];

        if (!empty($data['username']) && !empty($data['application_date']) && !empty($data['currency'])) {
            try {

                $isOnProcess = $this->checkUsernameIfInProcess($data['username']);

                if ($isOnProcess) {
                    $responseStatus = [
                    'status' => 'on-process',
                    'message' => 'User application is currently on-process',
                    ];
                } else {
                    $isSaved = $this->connection->insert('casino_provision_report')
                        ->fields(
                            [
                            'username' => $data['username'],
                            'application_date' => $data['application_date'],
                            'currency' => $data['currency']
                            ]
                        )
                        ->execute();

                    if ($isSaved) {
                        $responseStatus = [
                        'status' => 'success',
                        'message' => 'Data have been saved successfully.',
                        ];
                    }
                }

            } catch (\Exception $e){
                \Drupal::logger('casino_provision')->notice($e);
                return new JsonResponse($responseStatus);
            }
        }

        return  new ResourceResponse($responseStatus);
    }


    /**
   * Check username if it's already on-process
   */
    private function checkUsernameIfInProcess($username)
    {
        $query = $this->connection->select('casino_provision_report', 'opt')
            ->fields('opt', array('username'))
            ->condition('opt.username', $username);

        $result = $query->execute();
        $data = $result->fetchField();

        $flag = !empty($data) ? true : false;
        return $flag;
    }
}
