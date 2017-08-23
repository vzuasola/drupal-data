<?php

namespace Drupal\entrypage_front_blocks;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface;

/**
 * Defines the storage handler class for Entrypage front block entities.
 *
 * This extends the base storage class, adding required special handling for
 * Entrypage front block entities.
 *
 * @ingroup entrypage_front_blocks
 */
class EntrypageFrontBlockStorage extends SqlContentEntityStorage implements EntrypageFrontBlockStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(EntrypageFrontBlockInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {entrypage_front_block_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {entrypage_front_block_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(EntrypageFrontBlockInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {entrypage_front_block_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('entrypage_front_block_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
