<?php

namespace Drupal\custom_inner_pages\Form;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\custom_inner_pages\Entity\HowToPlayInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for reverting a How to play revision.
 *
 * @ingroup custom_inner_pages
 */
class HowToPlayRevisionRevertForm extends ConfirmFormBase {


  /**
   * The How to play revision.
   *
   * @var \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   */
  protected $revision;

  /**
   * The How to play storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $HowToPlayStorage;

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs a new HowToPlayRevisionRevertForm.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The How to play storage.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   */
  public function __construct(EntityStorageInterface $entity_storage, DateFormatterInterface $date_formatter) {
    $this->HowToPlayStorage = $entity_storage;
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')->getStorage('how_to_play'),
      $container->get('date.formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'how_to_play_revision_revert_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to revert to the revision from %revision-date?', [
      '%revision-date' => $this->dateFormatter->format($this->revision->getRevisionCreationTime())
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.how_to_play.version_history', ['how_to_play' => $this->revision->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Revert');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $how_to_play_revision = NULL) {
    $this->revision = $this->HowToPlayStorage->loadRevision($how_to_play_revision);
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // The revision timestamp will be updated when the revision is saved. Keep
    // the original one for the confirmation message.
    $original_revision_timestamp = $this->revision->getRevisionCreationTime();

    $this->revision = $this->prepareRevertedRevision($this->revision, $form_state);
    $this->revision->revision_log = t('Copy of the revision from %date.', [
      '%date' => $this->dateFormatter->format($original_revision_timestamp)
    ]);
    $this->revision->save();

    $this->logger('content')->notice('How to play: reverted %title revision %revision.', [
      '%title' => $this->revision->label(),
      '%revision' => $this->revision->getRevisionId()
    ]);
    drupal_set_message(t('How to play %title has been reverted to the revision from %revision-date.', [
      '%title' => $this->revision->label(),
      '%revision-date' => $this->dateFormatter->format($original_revision_timestamp)
    ]));
    $form_state->setRedirect(
      'entity.how_to_play.version_history',
      ['how_to_play' => $this->revision->id()]
    );
  }

  /**
   * Prepares a revision to be reverted.
   *
   * @param \Drupal\custom_inner_pages\Entity\HowToPlayInterface $revision
   *   The revision to be reverted.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   *   The prepared revision ready to be stored.
   */
  protected function prepareRevertedRevision(HowToPlayInterface $revision, FormStateInterface $form_state) {
    $revision->setNewRevision();
    $revision->isDefaultRevision(TRUE);
    $revision->setRevisionCreationTime(REQUEST_TIME);

    return $revision;
  }

}
