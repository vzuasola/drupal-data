<?php

namespace Drupal\webcomposer_config;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\block\Entity\Block;
use Drupal\menu_link_content\Entity\MenuLinkContent;

/**
 * Webcomposer Config gonna create a blocks, menu and paragraph.
 */
class WebcomposerConfig {

  /**
   * Creates a paragraph.
   *
   * @param mixed $itemsInArray
   *   The items in array.
   *
   * @return array
   *   Paragraph list.
   */
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

  /**
   * Helper function to create  Block.
   *
   * @param mixed $blockID
   *   The block id.
   * @param mixed $uuid
   *   The uuid.
   * @param mixed $region
   *   The region.
   * @param mixed $label
   *   The label.
   */
  public static function placeBlockInRegion($blockID, $uuid, $region, $label) {
    $block = Block::create([
      'id' => $blockID,
      'plugin' => 'block_content:' . $uuid,
      'region' => $region,
      'provider' => 'block_content',
      'weight' => -100,
      'settings' => [
        'label' => $label,
        'label_display' => 'visible',
        'status' => TRUE,
      ],
      'theme' => 'bartik',
      'visibility' => [],
    ]);

    $block->save();
  }

  /**
   * Creates a menu.
   *
   * @param mixed $menuName
   *   The menu name.
   * @param mixed $items
   *   The items.
   */
  public static function createMenu($menuName, $items) {
    foreach ($items as $link => $title) {
      $menu_link = MenuLinkContent::create([
        'title' => $title,
        'link' => [
          'uri' => "internal:$link",
        ],
        'menu_name' => $menuName,
        'expanded' => TRUE,
      ]);

      $menu_link->save();
    }
  }

}
