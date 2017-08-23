<?php

namespace Drupal\entrypage_front_blocks\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting a Entrypage front block revision.
 *
 * @ingroup entrypage_front_blocks
 */
class EntrypageFrontBlockRevisionDeleteForm extends ConfirmFormBase {


  /**
   * The Entrypage front block revision.
   *
   * @var \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   */
  protected $revision;

  /**
   * The Entrypage front block storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $EntrypageFrontBlockStorage;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a new EntrypageFrontBlockRevisionDeleteForm.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The entity storage.
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection.
   */
  public function __construct(EntityStorageInterface $entity_storage, Connection $connection) {
    $this->EntrypageFrontBlockStorage = $entity_storage;
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $entity_manager = $container->get('entity.manager');
    return new static(
      $entity_manager->getStorage('entrypage_front_block'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entrypage_front_block_revision_delete_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete the revision from %revision-date?', array('%revision-date' => format_date($this->revision->getRevisionCreationTime())));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.entrypage_front_block.version_history', array('entrypage_front_block' => $this->revision->id()));
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
  public function buildForm(array $form, FormStateInterface $form_state, $entrypage_front_block_revision = NULL) {
    $this->revision = $this->EntrypageFrontBlockStorage->loadRevision($entrypage_front_block_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->EntrypageFrontBlockStorage->deleteRevision($this->revision->getRevisionId());

    $this->logger('content')->notice('Entrypage front block: deleted %title revision %revision.', array('%title' => $this->revision->label(), '%revision' => $this->revision->getRevisionId()));
    drupal_set_message(t('Revision from %revision-date of Entrypage front block %title has been deleted.', array('%revision-date' => format_date($this->revision->getRevisionCreationTime()), '%title' => $this->revision->label())));
    $form_state->setRedirect(
      'entity.entrypage_front_block.canonical',
       array('entrypage_front_block' => $this->revision->id())
    );
    if ($this->connection->query('SELECT COUNT(DISTINCT vid) FROM {entrypage_front_block_field_revision} WHERE id = :id', array(':id' => $this->revision->id()))->fetchField() > 1) {
      $form_state->setRedirect(
        'entity.entrypage_front_block.version_history',
         array('entrypage_front_block' => $this->revision->id())
      );
    }
  }

}
