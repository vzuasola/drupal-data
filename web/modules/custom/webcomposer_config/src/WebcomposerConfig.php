<?php

namespace Drupal\webcomposer_config;

use Drupal\block\Entity\Block;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\menu_link_content\Entity\MenuLinkContent;

class WebcomposerConfig {

  public static function createParagraph($itemsInArray) {

    $paragraphLists = [];

    foreach ($itemsInArray as $paramKey => $paramValue) {

      foreach ($paramValue as $key => $value) {
        $paragraphItem[$key] = $value;
      }

      $paragraph = Paragraph::create($paragraphItem);
      $paragraph->save();

      $paragraphLists[] = [
        'target_id' => $paragraph->id(),
        'target_revision_id' => $paragraph->getRevisionId(),
      ];
    }

    return $paragraphLists;
  }

}
