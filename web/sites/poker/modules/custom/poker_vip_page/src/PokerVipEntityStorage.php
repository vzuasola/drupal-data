<?php

namespace Drupal\poker_vip_page;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\poker_vip_page\Entity\PokerVipEntityInterface;

/**
 * Defines the storage handler class for Poker vip entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Poker vip entity entities.
 *
 * @ingroup poker_vip_page
 */
class PokerVipEntityStorage extends SqlContentEntityStorage implements PokerVipEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(PokerVipEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {poker_vip_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {poker_vip_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(PokerVipEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {poker_vip_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('poker_vip_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
