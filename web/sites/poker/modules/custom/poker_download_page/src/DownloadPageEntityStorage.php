<?php

namespace Drupal\poker_download_page;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\poker_download_page\Entity\DownloadPageEntityInterface;

/**
 * Defines the storage handler class for Download page entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Download page entity entities.
 *
 * @ingroup poker_download_page
 */
class DownloadPageEntityStorage extends SqlContentEntityStorage implements DownloadPageEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(DownloadPageEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {download_page_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {download_page_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(DownloadPageEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {download_page_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('download_page_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
