<?php

namespace Drupal\poker_vip_page\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Poker vip entity revision.
 *
 * @ingroup poker_vip_page
 */
class PokerVipEntityRevisionDeleteForm extends ConfirmFormBase {


  /**
   * The Poker vip entity revision.
   *
   * @var \Drupal\poker_vip_page\Entity\PokerVipEntityInterface
   */
  protected $revision;

  /**
   * The Poker vip entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $PokerVipEntityStorage;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a new PokerVipEntityRevisionDeleteForm.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The entity storage.
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection.
   */
  public function __construct(EntityStorageInterface $entity_storage, Connection $connection) {
    $this->PokerVipEntityStorage = $entity_storage;
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $entity_manager = $container->get('entity.manager');
    return new static(
      $entity_manager->getStorage('poker_vip_entity'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'poker_vip_entity_revision_delete_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete the revision from %revision-date?', [
      '%revision-date' => format_date($this->revision->getRevisionCreationTime())
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.poker_vip_entity.version_history', ['poker_vip_entity' => $this->revision->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $poker_vip_entity_revision = NULL) {
    $this->revision = $this->PokerVipEntityStorage->loadRevision($poker_vip_entity_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->PokerVipEntityStorage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Poker vip entity: deleted %title revision %revision.', [
      '%title' => $this->revision->label(),
      '%revision' => $this->revision->getRevisionId()
    ]);
    drupal_set_message(t('Revision from %revision-date of Poker vip entity %title has been deleted.', [
      '%revision-date' => format_date($this->revision->getRevisionCreationTime()),
      '%title' => $this->revision->label()
    ]));
    $form_state->setRedirect(
      'entity.poker_vip_entity.canonical',
       ['poker_vip_entity' => $this->revision->id()]
    );
    if ($this->connection->query('SELECT COUNT(DISTINCT vid) FROM {poker_vip_entity_field_revision}
        WHERE id = :id', [':id' => $this->revision->id()])->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.poker_vip_entity.version_history',
         ['poker_vip_entity' => $this->revision->id()]
      );
    }
  }

}
