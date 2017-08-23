<?php


namespace Drupal\my_account_core\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\Core\Routing\RequestContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class BonusHistoryForm extends ConfigFormBase
{
	/**
     * Getter method for Form ID.
     *
     * @inheritdoc
     */
    public function getFormId()
    {
        return 'bonus_histroy_form_config';
    }

    /**
     *
     * @inheritdoc
     */
    protected function getEditableConfigNames()
    {
        return ['my_account_core.bonus_history'];
    }

    /**
     *
     * @inheritdoc
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
    	$config = $this->config('my_account_core.bonus_history');

    	$form['my_account_group'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['bonus_history_group'] = [
        	'#type' => 'details',
        	'#title' => 'Bonus History Configuration',
        	'#group' => 'my_account_group'
        ];

    	$form['bonus_history_group']['datetime_format'] = [
    		'#type' => 'textfield',
	        '#title' => $this->t('Date and Time Format'),
	        '#default_value' => $config->get('datetime_format') ?? 'd/m/Y H:i',
	        '#description' => $this->t('<div id="edit-date-format-pattern--description" class="description">
		      A user-defined date format. See the <a href="http://php.net/manual/function.date.php">PHP manual</a> for available options.
		    </div>'),
	        '#required' => TRUE,
    	];

    	$form['bonus_history_group']['no_result'] = [
    		'#type' => 'textfield',
	        '#title' => $this->t('No Result Message'),
	        '#default_value' => $config->get('no_result') ?? 'N/A',
	        '#required' => TRUE,
    	];

    	$form['bonus_history_group']['service_unavailable'] = [
    		'#type' => 'textfield',
	        '#title' => $this->t('Service not available'),
	        '#default_value' => $config->get('service_unavailable') ?? 'N/A',
	        '#required' => TRUE,
    	];
    	return parent::buildForm($form, $form_state);
    }

	/**
	* {@inheritdoc}
	*/
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm($form, $form_state);
	}

    /**
     * Implements a form submit handler.
     *
     * @param array $form
     *   The render array of the currently built form.
     * @param FormStateInterface $form_state
     *   Object describing the current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
		$keys = [
			'datetime_format',
			'no_result',
			'service_unavailable'
		];

		foreach ($keys as $key) {
			$this->config('my_account_core.bonus_history')->set($key, $form_state->getValue($key))->save();
		}

		parent::submitForm($form, $form_state);
    }
}