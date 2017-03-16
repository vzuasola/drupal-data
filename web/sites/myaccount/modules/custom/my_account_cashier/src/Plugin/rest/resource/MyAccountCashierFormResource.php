<?php

namespace Drupal\my_account_cashier\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a My Account Rest Resources
 *
 * @RestResource(
 *   id = "my_account_cashier_resource",
 *   label = @Translation("My Account Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class MyAccountCashierFormResource extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($id)
    {
        switch ($id) {
            case 'my_account_cashier':
                $config = \Drupal::config('my_account_cashier.link');
                $values = $config->get();
                return new ResourceResponse($values);
                break;
            default:
        }
    }
}
