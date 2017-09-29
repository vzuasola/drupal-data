<?php

namespace Drupal\casino_games_page_background;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface GamesPageBgEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Casino Games Page Background revision IDs for a specific Casino Games Page Background.
   *
   * @param \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface $entity
   *   The Casino Games Page Background entity.
   *
   * @return int[]
   *   Casino Games Page Background revision IDs (in ascending order).
   */
  public function revisionIds(GamesPageBgEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Casino Games Page Background author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Casino Games Page Background revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface $entity
   *   The Casino Games Page Background entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(GamesPageBgEntityInterface $entity);

  /**
   * Unsets the language for all Casino Games Page Background with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
