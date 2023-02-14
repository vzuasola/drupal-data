<?php

namespace Drupal\sportsbook_widget_api\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for thesportsbook widget api entity edit forms.
 */
class SportsbookWidgetApiForm extends ContentEntityForm
{

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state)
  {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      drupal_set_message($this->t('New sportsbook widget api %label has been created.', $message_arguments));
      $this->logger('sportsbook_widget_api')->notice('Created new sportsbook widget api %label', $logger_arguments);
    } else {
      drupal_set_message($this->t('The sportsbook widget api %label has been updated.', $message_arguments));
      $this->logger('sportsbook_widget_api')->notice('Created new sportsbook widget api %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.sportsbook_widget_api.canonical', ['sportsbook_widget_api' => $entity->id()]);
  }
}
