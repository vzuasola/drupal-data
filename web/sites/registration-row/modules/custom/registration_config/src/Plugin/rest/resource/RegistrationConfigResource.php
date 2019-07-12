<?php

namespace Drupal\registration_config\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a My Account Rest Resources
 *
 * @RestResource(
 *   id = "registration_config_form_resource",
 *   label = @Translation("Registration Config Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class RegistrationConfigResource extends ResourceBase {

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($id) {

        // Expired the caches for resources update.
        $build = array(
            '#cache' => array(
                'max-age' => 0,
            ),
        );

        switch ($id) {

            case 'registration_general':
                $config = \Drupal::config('registration_config.general_configuration');
                $values = $config->get();
                break;
            default:
        }

        return (new ResourceResponse($values))->addCacheableDependency($build);
    }
}
