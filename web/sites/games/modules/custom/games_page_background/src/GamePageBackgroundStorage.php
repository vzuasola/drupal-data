<?php

namespace Drupal\games_page_background;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\games_page_background\Entity\GamePageBackgroundInterface;

/**
 * Defines the storage handler class for Game Page Background entities.
 *
 * This extends the base storage class, adding required special handling for
 * Game Page Background entities.
 *
 * @ingroup games_page_background
 */
class GamePageBackgroundStorage extends SqlContentEntityStorage implements GamePageBackgroundStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(GamePageBackgroundInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {game_page_background_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {game_page_background_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(GamePageBackgroundInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {game_page_background_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('game_page_background_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
