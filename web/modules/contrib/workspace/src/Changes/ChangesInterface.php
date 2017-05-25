<?php

namespace Drupal\workspace\Changes;

/**
 * Define and build a changeset for a Workspace.
 */
interface ChangesInterface {

  /**
   * Set the flag for including entities in the changeset.
   *
   * @param bool $include_docs
   *   Whether to include entities in the changeset.
   *
   * @return \Drupal\workspace\Changes\ChangesInterface
   *   Returns $this.
   */
  public function includeDocs($include_docs);

  /**
   * Sets from what sequence number to check for changes.
   *
   * @param int $seq
   *   The sequence ID to start including changes from. Result includes $seq.
   *
   * @return \Drupal\workspace\Changes\ChangesInterface
   *   Returns $this.
   */
  public function lastSeq($seq);

  /**
   * Return the changes in a 'normal' way.
   */
  public function getNormal();

  /**
   * Return the changes with a 'longpoll'.
   */
  public function getLongpoll();

}
