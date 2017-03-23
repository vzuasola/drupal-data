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

        // Expired the caches for resources update.
        $build = array(
            '#cache' => array(
                'max-age' => 0,
            ),
        );

        switch ($id) {

            case 'my_account_change_password':
                $config = \Drupal::config('my_account_form_profile.change_password');
                $values = $config->get();
                break;

            case 'my_account_profile':

                // Make seperte value for Profile field
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->get_profile_hader_profile_value($config->get(), 'profile');
                break;

            case 'my_account_cashier':
                $config = \Drupal::config('my_account_core.cashier');
                $values = $config->get();
                break;

            case 'my_account_livechat':
                $config = \Drupal::config('my_account_core.livechat');
                $values = $config->get();
                break;

            case 'my_account_profile_header':

                // Get only hader section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->get_profile_hader_profile_value($config->get(), 'header');
                break;
            default:
        }

        return (new ResourceResponse($values))->addCacheableDependency($build);
    }


    /**
     * @return array with header key
     */
    public function get_profile_hader_profile_value($values, $key)
    {
        if ($key == 'header') {

            // Get only header values for profile.
            $value['account_detail'] = $values['account_field']['options']['label'];
            $value['communication'] = $values['communication_detail_field']['options']['label'];
        } elseif ($key == 'profile') {

            // Get only Profile field.
            unset($values['account_field']);
            unset($values['communication_detail_field']);
            $value = $values;
        }
        return $value;
    }


}
