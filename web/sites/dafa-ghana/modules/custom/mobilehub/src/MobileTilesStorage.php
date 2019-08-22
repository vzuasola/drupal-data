<?php

namespace Drupal\mobilehub;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\mobilehub\Entity\MobileTilesInterface;

/**
 * Defines the storage handler class for Mobile tiles entities.
 *
 * This extends the base storage class, adding required special handling for
 * Mobile tiles entities.
 *
 * @ingroup mobilehub
 */
class MobileTilesStorage extends SqlContentEntityStorage implements MobileTilesStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(MobileTilesInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {mobile_tiles_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {mobile_tiles_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(MobileTilesInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {mobile_tiles_field_revision}
      WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('mobile_tiles_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
