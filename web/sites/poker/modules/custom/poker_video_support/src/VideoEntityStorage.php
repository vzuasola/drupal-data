<?php

namespace Drupal\poker_video_support;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\poker_video_support\Entity\VideoEntityInterface;

/**
 * Defines the storage handler class for Video entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Video entity entities.
 *
 * @ingroup poker_video_support
 */
class VideoEntityStorage extends SqlContentEntityStorage implements VideoEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(VideoEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {poker_video_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {poker_video_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(VideoEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {poker_video_entity_field_revision}
      WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('poker_video_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
