<?php

namespace Drupal\poker_video_support;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\poker_video_support\Entity\VideoEntityInterface;

/**
 * Defines the storage handler class for Video entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Video entity entities.
 *
 * @ingroup poker_video_support
 */
interface VideoEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Video entity revision IDs for a specific Video entity.
   *
   * @param \Drupal\poker_video_support\Entity\VideoEntityInterface $entity
   *   The Video entity entity.
   *
   * @return int[]
   *   Video entity revision IDs (in ascending order).
   */
  public function revisionIds(VideoEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Video entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Video entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\poker_video_support\Entity\VideoEntityInterface $entity
   *   The Video entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(VideoEntityInterface $entity);

  /**
   * Unsets the language for all Video entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
