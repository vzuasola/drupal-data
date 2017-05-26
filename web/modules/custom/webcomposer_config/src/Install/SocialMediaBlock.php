<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;
use Drupal\block\Entity\Block;
use Drupal\block_content\Entity\BlockContent;
use Drupal\block_content\Entity\BlockContentType;

class SocialMediaBlock {
  /**
   * 
   */
  private $items = array(
    array(
      'type' => 'social_media',
      'field_social_media_link_class' => 'facebook',
      'field_link_target' => '_blank',
      'field_social_media_links' => 'https://www.facebook.com',
      'field_enable' => TRUE
    ),
    array(
      'type' => 'social_media',
      'field_social_media_link_class' => 'twitter',
      'field_link_target' => '_blank',
      'field_social_media_links' => 'https://www.twitter.com',
      'field_enable' => TRUE
    ),
    array(
      'type' => 'social_media',
      'field_social_media_link_class' => 'google',
      'field_link_target' => '_blank',
      'field_social_media_links' => 'https://www.google.com',
      'field_enable' => TRUE
    ),
    array(
      'type' => 'social_media',
      'field_social_media_link_class' => 'youtube',
      'field_link_target' => '_blank',
      'field_social_media_links' => 'https://www.youtube.com',
      'field_enable' => TRUE
    ),
    array(
      'type' => 'social_media',
      'field_social_media_link_class' => 'linkedin',
      'field_link_target' => '_blank',
      'field_social_media_links' => 'https://www.linkedin.com',
      'field_enable' => TRUE
    )
  );

  /**
   * 
   */
  public function createBlock() {
    $paragraphItems = $this->items;
    $socialMediaCounter = 0;

    $paragraph = WebcomposerConfig::createParagraph($paragraphItems);
    $block_bundles = BlockContentType::loadMultiple();

    foreach (Block::loadMultiple() as $block) {
      $plugin_id = explode(':', $block->getPluginId());

      if ($plugin_id[0] == 'block_content') {
        $dependencies = $block->getDependencies();
        list(, $type, $uuid) = explode(':', $dependencies['content'][0]);

        if (isset($block_bundles[$type]) && $type == 'social_media_block') {
          $entity = \Drupal::entityManager()->loadEntityByUuid('block_content', $uuid);

          if (!$entity) {
            $socialMediaCounter += 1;

            $block_content = BlockContent::create(array(
              'info' => 'Social Media Block Install',
              'type' => 'social_media_block',
              'field_social_media' => $paragraph,
              'field_block_enable' => TRUE,
              'field_sm_blurb' => 'Follow us',
              'uuid' => $uuid
            ));

            $block_content->save();
          }
        }
      }
    }

    if ($socialMediaCounter == 0) {
      $socialMediaBlockId = 'footer_social_media';
      $socialMediaBlock = Block::load($socialMediaBlockId);

      if ($socialMediaBlock == NULL) {
        $block_content = BlockContent::create(array(
          'info' => 'Social Media Block',
          'type' => 'social_media_block',
          'field_social_media' => $paragraph,
          'field_block_enable' => TRUE,
          'field_sm_blurb' => 'Follow us',
        ));

        $block_content->save();
        WebcomposerConfig::placeBlockInRegion('footer_social_media', $block_content->uuid(), 'content', 'Social Media Block');
      }
    }
  }
}
