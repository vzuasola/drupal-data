<?php

namespace Drupal\entrypage_front_blocks;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface;

/**
 * Defines the storage handler class for Entrypage front block entities.
 *
 * This extends the base storage class, adding required special handling for
 * Entrypage front block entities.
 *
 * @ingroup entrypage_front_blocks
 */
interface EntrypageFrontBlockStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Entrypage front block revision IDs for a specific Entrypage front block.
   *
   * @param \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface $entity
   *   The Entrypage front block entity.
   *
   * @return int[]
   *   Entrypage front block revision IDs (in ascending order).
   */
  public function revisionIds(EntrypageFrontBlockInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Entrypage front block author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Entrypage front block revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface $entity
   *   The Entrypage front block entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(EntrypageFrontBlockInterface $entity);

  /**
   * Unsets the language for all Entrypage front block with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
