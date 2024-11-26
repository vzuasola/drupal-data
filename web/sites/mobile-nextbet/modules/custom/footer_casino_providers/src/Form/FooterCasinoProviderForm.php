<?php

namespace Drupal\footer_casino_providers\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Footer Casino Providers edit forms.
 *
 * @ingroup footer_casino_providers
 */
class FooterCasinoProviderForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /* @var $entity \Drupal\footer_casino_providers\Entity\FooterCasinoProvider */
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
              drupal_set_message($this->t('Created the %label Footer Casino Provider', [
                '%label' => $entity->label(),
              ]));
              break;

            default:
              drupal_set_message($this->t('Saved the %label Footer Casino Provider', [
                '%label' => $entity->label(),
              ]));
        }
        $form_state->setRedirectUrl($entity->urlInfo('collection'));
    }
}
