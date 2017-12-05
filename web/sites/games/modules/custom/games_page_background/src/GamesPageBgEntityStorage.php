<?php

namespace Drupal\casino_games_page_background;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface;

/**
 * Defines the storage handler class for Casino Games Page Background entities.
 *
 * This extends the base storage class, adding required special handling for
 * Casino Games Page Background entities.
 *
 * @ingroup casino_games_page_background
 */
class GamesPageBgEntityStorage extends SqlContentEntityStorage implements GamesPageBgEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(GamesPageBgEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {games_page_bg_entity_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {games_page_bg_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(GamesPageBgEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {games_page_bg_entity_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('games_page_bg_entity_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
