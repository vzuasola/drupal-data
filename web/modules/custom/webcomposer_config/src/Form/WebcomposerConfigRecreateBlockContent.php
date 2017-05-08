<?php


namespace Drupal\webcomposer_config\Form;


use Drupal\block_content\Entity\BlockContent;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\block\Entity\Block;
use Drupal\block_content\Entity\BlockContentType;
use Drupal\webcomposer_config\WebcomposerConfig;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class WebcomposerConfigRecreateBlockContent extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.recreate_block_content'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'recreate_block_content_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $socialMediaItem = socialMediaBlockItems();
    $sponsorshipItem = sponsorshipBlockItems();


    $sponsorshipBlockId = 'sponsorship';
    $sponsorshipBlock = Block::load($sponsorshipBlockId);


    $socialMediaBlockId = 'footer_scoial_media';
    $socialMediaBlock = Block::load($socialMediaBlockId);


    if( ($sponsorshipBlock == null) && ($socialMediaBlock == null) ) {

      $sponsorshipBlockContentUuid = createSponsorshipBlock($sponsorshipItem);
      $socialMediaBlockContentUuid = createBlockSocialMediaBlock($socialMediaItem);

      WebcomposerConfig::placeBlockContentInRegion('sponsorship', $sponsorshipBlockContentUuid, 'content', 'Sponsorship Block');
      WebcomposerConfig::placeBlockContentInRegion('footer_social_media', $socialMediaBlockContentUuid, 'content', 'Social Media Block');

    }else if($sponsorshipBlock == null) {

      $sponsorshipBlockContentUuid = createSponsorshipBlock($sponsorshipItem);
      WebcomposerConfig::placeBlockContentInRegion('sponsorship', $sponsorshipBlockContentUuid, 'content', 'Sponsorship Block');

    }else if($socialMediaBlock == null) {

      $socialMediaBlockContentUuid = createBlockSocialMediaBlock($socialMediaItem);
      WebcomposerConfig::placeBlockContentInRegion('footer_social_media', $socialMediaBlockContentUuid, 'content', 'Social Media Block');

    }else{

      $block_bundles = BlockContentType::loadMultiple();
      foreach (Block::loadMultiple() as $block) {

        $plugin_id = explode(':', $block->getPluginId());
        if ($plugin_id[0] == 'block_content') {

          $dependencies = $block->getDependencies();
          list(, $type, $uuid) = explode(':', $dependencies['content'][0]);

          if (isset($block_bundles[$type])) {

            if( ($type == 'sponsorship_block') || ($type == 'social_media_block') ) {
              $entity = \Drupal::entityManager()->loadEntityByUuid('block_content', $uuid);
              if(!$entity){

                if($type == 'social_media_block') {
                  $socialMediaBlockContentUuid = createBlockSocialMediaBlock($socialMediaItem, $uuid);
                }

                if($type == 'sponsorship_block') {
                  $sponsorshipBlockContentUuid = createSponsorshipBlock($sponsorshipItem, $uuid);
                }

              }
            }
          }else{
            dsm("else");
          }
        }
      }

    }// end else



    return parent::submitForm($form, $form_state);
  }

}
