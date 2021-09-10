<?php

namespace Drupal\webcomposer_rest_extra\Plugin\views\style;

use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\webcomposer_rest_extra\PagerTrait;

/**
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "taxonomy_list_serializer",
 *   title = @Translation("Taxonomy List Serializer"),
 *   help = @Translation("Custom serializer for the node list that exposes taxonomy terms references"),
 *   display_types = {"data"}
 * )
 */
class TaxonomyListSerializer extends Serializer {
    use PagerTrait;

/**
 * {@inheritdoc}
*/
public function render() {
    $rows = [];

    if ($pager = $this->pagerDetails($this->view->pager)) {
      $rows = $pager;

      // Get the content type configured in the display or fallback to the
      // default.
      if ((empty($this->view->live_preview))) {
        $content_type = $this->displayHandler->getContentType();
      } else {
        $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
      }

      return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
    } else {
      return parent::render();
    }
  }
}
