<?php

namespace Drupal\my_account_form_profile\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a My Account Rest Resources
 *
 * @RestResource(
 *   id = "my_account_profile_form_resource",
 *   label = @Translation("My Account Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class MyAccountFormResource extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($id)
    {

        switch ($id) {
            case 'my_account_change_password':
                $config = \Drupal::config('my_account_form_profile.change_password');
                break;
            case 'my_account_profile':
                $config = \Drupal::config('my_account_form_profile.profile');
                break;
            case 'my_account_cashier':
                $config = \Drupal::config('my_account_core.cashier');
                break;
            case 'my_account_livechat':
                $config = \Drupal::config('my_account_core.livechat');
                break;
            default:
        }

        $values = $config->get();
        return new ResourceResponse($values);
    }
}
