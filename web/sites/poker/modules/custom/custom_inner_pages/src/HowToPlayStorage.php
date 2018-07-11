<?php

namespace Drupal\custom_inner_pages;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\custom_inner_pages\Entity\HowToPlayInterface;

/**
 * Defines the storage handler class for How to play entities.
 *
 * This extends the base storage class, adding required special handling for
 * How to play entities.
 *
 * @ingroup custom_inner_pages
 */
class HowToPlayStorage extends SqlContentEntityStorage implements HowToPlayStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(HowToPlayInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {how_to_play_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {how_to_play_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(HowToPlayInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {how_to_play_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('how_to_play_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
