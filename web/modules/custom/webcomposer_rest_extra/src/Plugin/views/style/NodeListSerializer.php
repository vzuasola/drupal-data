<?php

namespace Drupal\webcomposer_rest_extra\Plugin\views\style;
use Drupal\rest\Plugin\views\style\Serializer;

/**
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "node_list_serializer",
 *   title = @Translation("Node List Serializer"),
 *   help = @Translation("Custom serializer for the node list that exposes taxonomy terms references"),
 *   display_types = {"data"}
 * )
 */
class NodeListSerializer extends Serializer {
  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = array();

    kint_require();
    foreach ($this->view->result as $row_index => $row) {
      $this->view->row_index = $row_index;

      // converting current row into array
      $rowAssoc = $this->serializer->normalize($this->view->rowPlugin->render($row));

      // add aliases on the nodes
      $alias = \Drupal::service('path.alias_manager')->getAliasByPath("/node/$row->nid");
      $rowAssoc['alias'][0]['value'] = $alias;

      foreach ($rowAssoc as $key => $value) {
        if (isset($value[0]['target_type']) && $value[0]['target_type'] == 'taxonomy_term') {
          // loading the term object onto the rest export
          $term = $this->loadTerm($value[0]['target_id']);
          $rowAssoc[$key][0] = $term;
        }

        foreach ($value as $pid) {
          if (isset($pid['target_type']) && $pid['target_type'] == 'paragraph') {
          // loading the paragraph object onto the rest export
           $rowAssoc[$key][] = $this->loadParagraph($pid['target_id']);

         }

       }

     }

     $rows[] = $rowAssoc;
   }

   unset($this->view->row_index);

    // Get the content type configured in the display or fallback to the
    // default.
   if ((empty($this->view->live_preview))) {
    $content_type = $this->displayHandler->getContentType();
  }
  else {
    $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
  }

  return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
}

  /**
   * Load terms by taxonomy ID
   */
  private function loadTerm($tid) {
    $term = \Drupal\taxonomy\Entity\Term::load($tid);

    $term_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/taxonomy/term/' . $tid);
    $term->set('path', $term_alias);

    return $term;
  }

   /**
   * Load paragraph by paragraph ID
   */
   private function loadParagraph($tid) {
    $entities = \Drupal::entityTypeManager()->getStorage('paragraph')->load($tid);
    return $entities;
  }
}
