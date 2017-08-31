<?php

namespace Drupal\entrypage_partners;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\entrypage_partners\Entity\EntrypagePartnerInterface;

/**
 * Defines the storage handler class for Entrypage partner entities.
 *
 * This extends the base storage class, adding required special handling for
 * Entrypage partner entities.
 *
 * @ingroup entrypage_partners
 */
class EntrypagePartnerStorage extends SqlContentEntityStorage implements EntrypagePartnerStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(EntrypagePartnerInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {entrypage_partner_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {entrypage_partner_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(EntrypagePartnerInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {entrypage_partner_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('entrypage_partner_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
