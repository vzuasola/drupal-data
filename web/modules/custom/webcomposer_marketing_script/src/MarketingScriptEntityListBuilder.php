<?php

namespace Drupal\webcomposer_marketing_script;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Marketing Script entities.
 *
 * @ingroup webcomposer_marketing_script
 */
class MarketingScriptEntityListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntity */
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.marketing_script_entity.edit_form', array(
          'marketing_script_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
