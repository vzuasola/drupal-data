<?php
/**
 * @file
 * Contains \Drupal\webcomposer_domain_import\Form\EmportForm.
 */

namespace Drupal\webcomposer_domain_import\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\file\Entity\File;
use Drupal\Core\Render\Element;
use Drupal\file\Entity;
use Drupal\node\Entity\ENTITY_NAME;
use Symfony\Component\DependencyInjection\SimpleXMLElement;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\Core\Entity\EntityInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;
/**
 * Contribute form.
 */
class ExportForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
	  return 'export_taxonomy_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Revert form
    $form['webcomposer_domain_export'] = array(
        '#type' => 'fieldset',
        '#title' => t('Export Domains'),
        '#description' => t('Allows you to export all domain data to an editable spreadsheet file.'),
    );
    $form['webcomposer_domain_export']['label'] = array(
        '#markup' => '<p></p>',
    );
    $form['webcomposer_domain_export']['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Export'),
        '#submit' => array('webcomposer_domain_export_excel'),
    );

    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	// Display result.
    foreach ($form_state->getValues() as $key => $value) {		
		if($key == 'field_vocabulary_name')
		{
			$voc_name = $value;
		}     
    }
     // kint($voc_name);
    create_taxonomy($voc_name);
  }
}
