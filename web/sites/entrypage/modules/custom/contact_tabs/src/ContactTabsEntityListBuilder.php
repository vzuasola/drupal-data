<?php

namespace Drupal\contact_tabs;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Contact tabs entity entities.
 *
 * @ingroup contact_tabs
 */
class ContactTabsEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\contact_tabs\Entity\ContactTabsEntity */
    $row['name'] = $this->l(
      $entity->get('field_title')->value,
      new Url(
        'entity.contact_tabs_entity.edit_form', array(
          'contact_tabs_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
