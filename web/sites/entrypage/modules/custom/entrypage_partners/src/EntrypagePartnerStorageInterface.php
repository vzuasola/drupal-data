<?php

namespace Drupal\entrypage_partners;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface EntrypagePartnerStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Entrypage partner revision IDs for a specific Entrypage partner.
   *
   * @param \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface $entity
   *   The Entrypage partner entity.
   *
   * @return int[]
   *   Entrypage partner revision IDs (in ascending order).
   */
  public function revisionIds(EntrypagePartnerInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Entrypage partner author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Entrypage partner revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface $entity
   *   The Entrypage partner entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(EntrypagePartnerInterface $entity);

  /**
   * Unsets the language for all Entrypage partner with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
