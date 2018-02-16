<?php

use Drupal\Core\Site\Settings;

/**
 * Respond to inline image url being changed.
 *
 * This hooks allows modules to alter the url of inline images in the body.
 */
function hook_inline_image_url_change_alter(&$uri, $base_path, $path) {
  // Alter the base path for the image here.
  if (isset($_SERVER['HTTP_X_FE_BASE_URI'])) {
    $uri = "https://$domain";
  }
}
