<?php

namespace Drupal\webcomposer_example\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a My Account Rest Resources
 *
 * @RestResource(
 *   id = "webcomposer_example_sample_form_resource",
 *   label = @Translation("WebComposer Sample Form"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class WebComposerExampleFormResource extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($id)
    {
        $config = \Drupal::config($id);
        $values = $config->get();
        return new ResourceResponse($values);
    }
}
