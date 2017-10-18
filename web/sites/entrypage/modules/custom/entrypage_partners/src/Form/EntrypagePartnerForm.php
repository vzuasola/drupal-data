<?php

namespace Drupal\entrypage_partners\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Entrypage partner edit forms.
 *
 * @ingroup entrypage_partners
 */
class EntrypagePartnerForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /* @var $entity \Drupal\entrypage_partners\Entity\EntrypagePartner */
        $form = parent::buildForm($form, $form_state);

        $entity = $this->entity;

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        $entity = &$this->entity;

        $status = parent::save($form, $form_state);

        switch ($status) {
            case SAVED_NEW:
              drupal_set_message($this->t('Created the %label Entrypage partner.', [
                '%label' => $entity->label(),
              ]));
              break;

            default:
              drupal_set_message($this->t('Saved the %label Entrypage partner.', [
                '%label' => $entity->label(),
              ]));
        }
        $form_state->setRedirectUrl($entity->urlInfo('collection'));
    }
}
