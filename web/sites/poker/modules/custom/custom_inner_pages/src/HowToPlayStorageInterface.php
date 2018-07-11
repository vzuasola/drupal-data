<?php

namespace Drupal\custom_inner_pages;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface HowToPlayStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of How to play revision IDs for a specific How to play.
   *
   * @param \Drupal\custom_inner_pages\Entity\HowToPlayInterface $entity
   *   The How to play entity.
   *
   * @return int[]
   *   How to play revision IDs (in ascending order).
   */
  public function revisionIds(HowToPlayInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as How to play author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   How to play revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\custom_inner_pages\Entity\HowToPlayInterface $entity
   *   The How to play entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(HowToPlayInterface $entity);

  /**
   * Unsets the language for all How to play with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
