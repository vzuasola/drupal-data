<?php

namespace Drupal\mobilehub;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface MobileTilesStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Mobile tiles revision IDs for a specific Mobile tiles.
   *
   * @param \Drupal\mobilehub\Entity\MobileTilesInterface $entity
   *   The Mobile tiles entity.
   *
   * @return int[]
   *   Mobile tiles revision IDs (in ascending order).
   */
  public function revisionIds(MobileTilesInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Mobile tiles author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Mobile tiles revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\mobilehub\Entity\MobileTilesInterface $entity
   *   The Mobile tiles entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(MobileTilesInterface $entity);

  /**
   * Unsets the language for all Mobile tiles with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
