<?php

namespace Drupal\poker_grid_menu;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\poker_grid_menu\Entity\GridMenuEntityInterface;

/**
 * Defines the storage handler class for Grid menu entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Grid menu entity entities.
 *
 * @ingroup poker_grid_menu
 */
class GridMenuEntityStorage extends SqlContentEntityStorage implements GridMenuEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(GridMenuEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {grid_menu_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {grid_menu_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(GridMenuEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {grid_menu_entity_field_revision} WHERE 
      id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('grid_menu_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
