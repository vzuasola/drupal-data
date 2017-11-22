<?php

namespace Drupal\conflict\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;

interface EntityConflictHandlerInterface {

  /**
   * The entity object property name to use to append the original entity.
   */
  const CONFLICT_ENTITY_ORIGINAL = 'conflictEntityOriginal';

  /**
   * The entity object property name to use to append the merged server entity.
   */
  const CONFLICT_ENTITY_SERVER = 'conflictEntityServer';

  /**
   * The entity object property name to use as a needs merge flag.
   */
  const CONFLICT_ENTITY_NEEDS_MANUAL_MERGE = 'conflictEntityNeedsManualMerge';

  /**
   * A constant indicating a server only change.
   */
  const CONFLICT_TYPE_SERVER_ONLY = 'server-only-change';

  /**
   * A constant indicating a merge conflict.
   */
  const CONFLICT_TYPE_BOTH = 'server-and-local-change';

  /**
   * A constant defining the property name on fields for the conflict type.
   */
  const CONFLICT_TYPE_FIELD_PROPERTY = 'conflictType';

  /**
   * Performs the needed alterations to the entity form.
   *
   * @param array $form
   *   The entity form to be altered to provide the translation workflow.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity being created or edited.
   * @param bool $inline_entity_form
   *   (optional) TRUE if an inline entity form is given, FALSE if a regular
   *   entity form is given. Defaults to FALSE.
   */
  public function entityFormAlter(array &$form, FormStateInterface $form_state, EntityInterface $entity, $inline_entity_form = FALSE);

}
