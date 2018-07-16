<?php

namespace Drupal\poker_download_page;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface DownloadPageEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Download page entity revision IDs for a specific Download page entity.
   *
   * @param \Drupal\poker_download_page\Entity\DownloadPageEntityInterface $entity
   *   The Download page entity entity.
   *
   * @return int[]
   *   Download page entity revision IDs (in ascending order).
   */
  public function revisionIds(DownloadPageEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Download page entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Download page entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\poker_download_page\Entity\DownloadPageEntityInterface $entity
   *   The Download page entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(DownloadPageEntityInterface $entity);

  /**
   * Unsets the language for all Download page entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
