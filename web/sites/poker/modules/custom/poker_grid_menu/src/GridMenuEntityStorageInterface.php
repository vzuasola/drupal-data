<?php

namespace Drupal\poker_grid_menu;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface GridMenuEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Grid menu entity revision IDs for a specific Grid menu entity.
   *
   * @param \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface $entity
   *   The Grid menu entity entity.
   *
   * @return int[]
   *   Grid menu entity revision IDs (in ascending order).
   */
  public function revisionIds(GridMenuEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Grid menu entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Grid menu entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface $entity
   *   The Grid menu entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(GridMenuEntityInterface $entity);

  /**
   * Unsets the language for all Grid menu entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
