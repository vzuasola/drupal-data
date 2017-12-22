<?php

namespace Drupal\games_page_background\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Game Page Background revision.
 *
 * @ingroup games_page_background
 */
class GamePageBackgroundRevisionDeleteForm extends ConfirmFormBase {


  /**
   * The Game Page Background revision.
   *
   * @var \Drupal\games_page_background\Entity\GamePageBackgroundInterface
   */
  protected $revision;

  /**
   * The Game Page Background storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $GamePageBackgroundStorage;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a new GamePageBackgroundRevisionDeleteForm.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The entity storage.
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection.
   */
  public function __construct(EntityStorageInterface $entity_storage, Connection $connection) {
    $this->GamePageBackgroundStorage = $entity_storage;
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $entity_manager = $container->get('entity.manager');
    return new static(
      $entity_manager->getStorage('game_page_background'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'game_page_background_revision_delete_confirm';
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
    return new Url('entity.game_page_background.version_history', ['game_page_background' => $this->revision->id()]);
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
  public function buildForm(array $form, FormStateInterface $form_state, $game_page_background_revision = NULL) {
    $this->revision = $this->GamePageBackgroundStorage->loadRevision($game_page_background_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->GamePageBackgroundStorage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Game Page Background: deleted %title revision %revision.', [
        '%title' => $this->revision->label(),
        '%revision' => $this->revision->getRevisionId()
    ]);
    drupal_set_message(t('Revision from %revision-date of Game Page Background %title has been deleted.', [
        '%revision-date' => format_date($this->revision->getRevisionCreationTime()),
        '%title' => $this->revision->label()
    ]));
    $form_state->setRedirect(
      'entity.game_page_background.canonical',
       ['game_page_background' => $this->revision->id()]
    );
    if ($this->connection->query('
        SELECT COUNT(DISTINCT vid) FROM {game_page_background_field_revision}
        WHERE id = :id', [':id' => $this->revision->id()])
        ->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.game_page_background.version_history',
         ['game_page_background' => $this->revision->id()]
      );
    }
  }

}
