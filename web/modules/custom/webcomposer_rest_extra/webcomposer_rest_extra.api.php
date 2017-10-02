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
function hook_inline_image_url_change_alter(&$html_body) {
  $document = new Html();

  $htmlDoc = $document->load($html_body);
  $domObject = simplexml_import_dom($htmlDoc);

  $images = $domObject->xpath('//img');
  $basePath = Settings::get('ck_editor_inline_image_prefix', NULL);

  foreach ($images as $image) {
    $replace = preg_replace('/\/sites\/[a-z\-]+\/files/', $basePath, $image['src']);
    $image['src'] = $replace;
  }

  $htmlMarkup = Html::serialize($htmlDoc);
  $processedHtml = trim($htmlMarkup);

  return $processedHtml;
}
