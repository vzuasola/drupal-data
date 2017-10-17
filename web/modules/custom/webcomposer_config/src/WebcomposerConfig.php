<?php

namespace Drupal\webcomposer_config;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\block\Entity\Block;
use Drupal\menu_link_content\Entity\MenuLinkContent;

class WebcomposerConfig {
  /**
   * Helper function to create paragraph item entries
   */
  public static function createParagraph($itemsInArray) {
    $paragraphLists = array();

    foreach ($itemsInArray as $paramKey => $paramValue) {
      foreach ($paramValue as $key => $value) {
        $paragraphItem[$key] = $value;
      }

      $paragraph = Paragraph::create($paragraphItem);
      $paragraph->save();

      $paragraphLists[] = array(
        'target_id' => $paragraph->id(),
        'target_revision_id' => $paragraph->getRevisionId(),
      );
    }

    return $paragraphLists;
  }

  /**
   * Helper function to place block in specific regions
   */
  public static function placeBlockInRegion($blockID, $uuid, $region, $label) {
    $block = Block::create(array(
      'id' => $blockID,
      'plugin' => 'block_content:' . $uuid,
      'region' => $region,
      'provider' => 'block_content',
      'weight' => -100,
      'settings' => array(
        'label' => $label,
        'label_display' => 'visible',
        'status' => TRUE
      ),
      'theme' => 'bartik',
      'visibility' => array(),
    ));

    $block->save();
  }

  /**
   * Helper function to create menu items
   */
  public static function createMenu($menuName, $items) {
    foreach ($items as $link => $title) {
      $menu_link = MenuLinkContent::create(array(
        'title' => $title,
        'link' => array(
          'uri' => "internal:$link"
        ),
        'menu_name' => $menuName,
        'expanded' => TRUE,
      ));

      $menu_link->save();
    }
  }
}
