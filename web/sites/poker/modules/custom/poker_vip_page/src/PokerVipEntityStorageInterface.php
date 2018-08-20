<?php

namespace Drupal\poker_vip_page;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\poker_vip_page\Entity\PokerVipEntityInterface;

/**
 * Defines the storage handler class for Poker vip entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Poker vip entity entities.
 *
 * @ingroup poker_vip_page
 */
interface PokerVipEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Poker vip entity revision IDs for a specific Poker vip entity.
   *
   * @param \Drupal\poker_vip_page\Entity\PokerVipEntityInterface $entity
   *   The Poker vip entity entity.
   *
   * @return int[]
   *   Poker vip entity revision IDs (in ascending order).
   */
  public function revisionIds(PokerVipEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Poker vip entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Poker vip entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\poker_vip_page\Entity\PokerVipEntityInterface $entity
   *   The Poker vip entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(PokerVipEntityInterface $entity);

  /**
   * Unsets the language for all Poker vip entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
