<?php

namespace Drupal\games_page_background;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface GamePageBackgroundStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Game Page Background revision IDs for a specific Game Page Background.
   *
   * @param \Drupal\games_page_background\Entity\GamePageBackgroundInterface $entity
   *   The Game Page Background entity.
   *
   * @return int[]
   *   Game Page Background revision IDs (in ascending order).
   */
  public function revisionIds(GamePageBackgroundInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Game Page Background author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Game Page Background revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\games_page_background\Entity\GamePageBackgroundInterface $entity
   *   The Game Page Background entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(GamePageBackgroundInterface $entity);

  /**
   * Unsets the language for all Game Page Background with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
