<?php

use Drupal\Core\Site\Settings;
/**
 * Respond to inline image url being changed.
 *
 * This hooks allows modules to alter the url of inline images in the body.
 *
 * @param int $current_count
 *   The number of times that the current user has viewed the node during this
 *   session.
 * @param \Drupal\node\NodeInterface $node
 *   The node being viewed.
 */
function hook_inline_image_url_change_alter(&$basepath) {
  // Alter the base path for the image here.
  if (isset($_SERVER['HTTP_X_FE_BASE_URI'])) {
    $basepath = "https://$domain";
  } else {
    $basepath = $basepath;
  }
}
