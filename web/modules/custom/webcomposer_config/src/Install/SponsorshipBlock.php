<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;
use Drupal\block\Entity\Block;
use Drupal\block_content\Entity\BlockContent;
use Drupal\block_content\Entity\BlockContentType;

class SponsorshipBlock {
  /**
   * 
   */
  public function createBlock() {
    $paragraphItems = $this->getItems();
    $sponsorshipCounter = 0;

    $block_bundles = BlockContentType::loadMultiple();

    foreach (Block::loadMultiple() as $block) {
      $plugin_id = explode(':', $block->getPluginId());

      if ($plugin_id[0] == 'block_content') {
        $dependencies = $block->getDependencies();
        list(, $type, $uuid) = explode(':', $dependencies['content'][0]);

        if (isset($block_bundles[$type]) && $type == 'sponsorship_block') {
          $entity = \Drupal::entityManager()->loadEntityByUuid('block_content', $uuid);

          if (!$entity) {
            $sponsorshipCounter += 1;

            $block_content = BlockContent::create(array(
              'info' => 'Sponsorship Block',
              'type' => 'sponsorship_block',
              'field_sponsor_logo' => $paragraph,
              'field_block_enable' => TRUE,
              'uuid' => $uuid
            ));

            $block_content->save();
          }
        }
      }
    }

    if ($sponsorshipCounter == 0) {
      $sponsorshipBlockId = 'sponsorship';
      $sponsorshipBlock = Block::load($sponsorshipBlockId);

      $paragraph = WebcomposerConfig::createParagraph($paragraphItems);
      $block_content = BlockContent::create(array(
        'info' => 'Sponsorship Block',
        'type' => 'sponsorship_block',
        'field_sponsor_logo' => $paragraph,
        'field_block_enable' => TRUE,
      ));

      $block_content->save();

      if ($sponsorshipBlock == NULL) {
        WebcomposerConfig::placeBlockInRegion('sponsorship', $block_content->uuid(), 'content', 'Sponsorship Block');
      }
    }
  }

  /**
   * 
   */
  private function getItems() {
    global $base_url;

    $modulePath = drupal_get_path('module', 'webcomposer_config');
    $prefix = "$base_url/$modulePath/assets/images";

    $paragraphItems = array(
      array(
        'type' => 'sponsorship',
        'field_sponsor_logo_link' => '#',
        'field_link_target' => '_blank',
        'field_sponsor_logo' => system_retrieve_file("$prefix/blackburn.png", 'public://', TRUE)->id(),
      ),
      array(
        'type' => 'sponsorship',
        'field_sponsor_logo_link' => '#',
        'field_link_target' => '_blank',
        'field_sponsor_logo' => system_retrieve_file("$prefix/burnley.png", 'public://', TRUE)->id(),
      ),
      array(
        'type' => 'sponsorship',
        'field_sponsor_logo_link' => '#',
        'field_link_target' => '_blank',
        'field_sponsor_logo' => system_retrieve_file("$prefix/celtic.png", 'public://', TRUE)->id(),
      ),
      array(
        'type' => 'sponsorship',
        'field_sponsor_logo_link' => '#',
        'field_link_target' => '_blank',
        'field_sponsor_logo' => system_retrieve_file("$prefix/everton.png", 'public://', TRUE)->id(),
      ),
      array(
        'type' => 'sponsorship',
        'field_sponsor_logo_link' => '#',
        'field_link_target' => '_blank',
        'field_sponsor_logo' => system_retrieve_file("$prefix/sunderland.png", 'public://', TRUE)->id(),
      ),
      array(
        'type' => 'sponsorship',
        'field_sponsor_logo_link' => '#',
        'field_link_target' => '_blank',
        'field_sponsor_logo' => system_retrieve_file("$prefix/wales.png", 'public://', TRUE)->id(),
      ),
    );

    return $paragraphItems;
  }
}
