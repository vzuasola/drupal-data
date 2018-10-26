<?php

namespace Drupal\replicate_ui\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\TranslatableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\replicate\Replicator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ReplicateConfirmForm extends ContentEntityConfirmFormBase {

  /**
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * @var \Drupal\replicate\Replicator
   */
  protected $replicator;

  /**
   * Creates a new ReplicateConfirmForm instance.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager.
   * @param \Drupal\replicate\Replicator $replicator
   *   The replicator.
   */
  public function __construct(EntityManagerInterface $entity_manager, Replicator $replicator) {
    parent::__construct($entity_manager);
    $this->replicator = $replicator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager'),
      $container->get('replicate.replicator')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, RouteMatchInterface $route_match = NULL) {
    $this->routeMatch = $route_match;
    /** @var \Drupal\Core\Entity\ContentEntityInterface $entity */
    $entity = $this->routeMatch->getParameter($this->getEntityTypeId());
    $this->setEntity($entity);

    // Expose a field to allow users to customize the label of the copied
    // entity, defaulting to "{original label} (Copy)".
    if ($entity->getEntityType()->hasKey('label')) {
      // If there are translations, expose one element per language.
      if ($entity instanceof TranslatableInterface) {
        foreach ($entity->getTranslationLanguages() as $translation_language) {
          $langcode = $translation_language->getId();
          /** @var \Drupal\Core\Entity\TranslatableInterface $translation */
          $translation = $entity->getTranslation($langcode);
          $form['new_label_' . $langcode] = [
            '#type' => 'textfield',
            '#title' => $this->t('New label (@language)', ['@language' => $translation_language->getName()]),
            '#description' => $this->t('This text will be used as the label of the new entity being created, in <em>@language</em>.', ['@language' => $translation_language->getName()]),
            '#required' => TRUE,
            '#default_value' => $this->t('@title (Copy)', [
              '@title' => $translation->label(),
            ], [
              'langcode' => $langcode,
            ]),
          ];
        }
      }
      else {
        $form['new_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('New label'),
          '#description' => $this->t('This text will be used as the label of the new entity being created.'),
          '#required' => TRUE,
          '#default_value' => t('@title (Copy)', ['@title' => $entity->label()]),
        ];
      }
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * @return string
   */
  protected function getEntityTypeId() {
    return $this->routeMatch->getRouteObject()->getDefault('entity_type_id');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    /** @var \Drupal\Core\Entity\ContentEntityInterface $entity */
    $entity = $this->getEntity();
    $label_key = $entity->getEntityType()->getKey('label');
    if ($entity instanceof TranslatableInterface) {
      foreach ($entity->getTranslationLanguages() as $translation_language) {
        $langcode = $translation_language->getId();
        if ($new_label = $form_state->getValue('new_label_' . $langcode)) {
          /** @var \Drupal\Core\Entity\TranslatableInterface $translation */
          $translation = $entity->getTranslation($langcode);
          $translation->set($label_key, $new_label);
        }
      }
    }
    else {
      $new_label = $form_state->getValue('new_label');
      if ($new_label) {
        $entity->set($label_key, $new_label);
      }
    }

    // @todo Decide whether this belongs into the API module instead.
    $entity->setValidationRequired(FALSE);
    $replicated_entity = $this->replicator->replicateEntity($entity);

    drupal_set_message(t('%type (%id) has been replicated to id %new!', ['%type' => $entity->getEntityTypeId(), '%id' => $entity->id(), '%new' => $replicated_entity->id()]));
    $form_state->setRedirectUrl($replicated_entity->toUrl());
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to replicate %type entity id %id?', ['%type' => $this->getEntityTypeId(), '%id' => $this->getEntity()->id()]);
  }


  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Replicate');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    $entity_type_id = $this->routeMatch->getRouteObject()->getDefault('entity_type_id');

    return Url::fromRoute("entity.$entity_type_id.canonical", [$entity_type_id => $this->getEntity()->id()]);
  }

}
