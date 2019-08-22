<?php

namespace Drupal\mobilehub\Form;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\mobilehub\Entity\MobileTilesInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for reverting a Mobile tiles revision.
 *
 * @ingroup mobilehub
 */
class MobileTilesRevisionRevertForm extends ConfirmFormBase {


  /**
   * The Mobile tiles revision.
   *
   * @var \Drupal\mobilehub\Entity\MobileTilesInterface
   */
  protected $revision;

  /**
   * The Mobile tiles storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $MobileTilesStorage;

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs a new MobileTilesRevisionRevertForm.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The Mobile tiles storage.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   */
  public function __construct(EntityStorageInterface $entity_storage, DateFormatterInterface $date_formatter) {
    $this->MobileTilesStorage = $entity_storage;
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')->getStorage('mobile_tiles'),
      $container->get('date.formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mobile_tiles_revision_revert_confirm';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to revert to the revision from %revision-date?', [
      '%revision-date' => $this->dateFormatter->format($this->revision->getRevisionCreationTime())]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.mobile_tiles.version_history', ['mobile_tiles' => $this->revision->id()]);
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
  public function buildForm(array $form, FormStateInterface $form_state, $mobile_tiles_revision = NULL) {
    $this->revision = $this->MobileTilesStorage->loadRevision($mobile_tiles_revision);
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
      '%date' => $this->dateFormatter->format($original_revision_timestamp)]);
    $this->revision->save();

    $this->logger('content')->notice('Mobile tiles: reverted %title revision %revision.', [
      '%title' => $this->revision->label(),
      '%revision' => $this->revision->getRevisionId()]);
    drupal_set_message(t('Mobile tiles %title has been reverted to the revision from %revision-date.', [
      '%title' => $this->revision->label(),
      '%revision-date' => $this->dateFormatter->format($original_revision_timestamp)]));
    $form_state->setRedirect(
      'entity.mobile_tiles.version_history',
      ['mobile_tiles' => $this->revision->id()]
    );
  }

  /**
   * Prepares a revision to be reverted.
   *
   * @param \Drupal\mobilehub\Entity\MobileTilesInterface $revision
   *   The revision to be reverted.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\mobilehub\Entity\MobileTilesInterface
   *   The prepared revision ready to be stored.
   */
  protected function prepareRevertedRevision(MobileTilesInterface $revision, FormStateInterface $form_state) {
    $revision->setNewRevision();
    $revision->isDefaultRevision(TRUE);
    $revision->setRevisionCreationTime(REQUEST_TIME);

    return $revision;
  }

}
