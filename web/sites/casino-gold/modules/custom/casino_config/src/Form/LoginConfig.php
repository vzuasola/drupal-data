<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LoginConfig extends ConfigFormBase{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['casino_config.login_config'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'login_config_settings_form';
    }

    /**`
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('casino_config.login_config');

        $form['advanced'] = array(
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        );
        $form['login_form_details'] = array(
          '#type' => 'details',
          '#title' => t('Login Form Settings'),
          '#group' => 'advanced',
        );

        $form['login_form_details'] ['username_placeholder'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Username Placeholder'),
            '#default_value' => $config->get('username_placeholder'),
        );
        $form['login_form_details'] ['password_placeholder'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Password Placeholder'),
            '#default_value' => $config->get('password_placeholder'),
        );
        $form['login_form_details'] ['login_bottom_label'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Login Botton Label'),
            '#default_value' => $config->get('login_bottom_label'),
        );

        $form['login_form_error_messages_details'] = array(
            '#type' => 'details',
            '#title' => t('Error Messages'),
            '#group' => 'advanced',
        );

        $form['login_form_error_messages_details']['error_message_blank_username'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Blank Username'),
            '#default_value' => $config->get('error_message_blank_username'),
        );

        $form['login_form_error_messages_details']['error_message_blank_password'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Blank Password'),
            '#default_value' => $config->get('error_message_blank_password'),
        );

        $form['login_form_error_messages_details']['error_message_blank_passname'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Blank Username and Password'),
            '#default_value' => $config->get('error_message_blank_passname'),
        );

        $form['login_form_error_messages_details']['error_message_invalid_passname'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Invalid Username and Password'),
            '#default_value' => $config->get('error_message_invalid_passname'),
        );
        $form['login_form_error_messages_details']['error_message_account_suspended'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Player account is Suspended/Closed'),
            '#default_value' => $config->get('error_message_account_suspended'),
        );
        $form['login_form_error_messages_details']['error_message_account_locked'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('  Player account is locked after (X) consecutive login attempt'),
            '#description' => $this->t('Note: number of attempts (X) and number of minutes (Y) configuration is located at the Middleware.'),
            '#default_value' => $config->get('error_message_account_locked'),
        );

        $form['login_form_error_messages_details']['error_message_service_not_available'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Error thrown by services'),
            '#default_value' => $config->get('error_message_service_not_available'),
        );

        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $loginValuesKeys = array(
            'username_placeholder',
            'password_placeholder',
            'login_bottom_label',
            'username_validation_min',
            'username_validation_max',
            'password_validation_min',
            'password_validation_max',
            'error_message_blank_username',
            'error_message_blank_password',
            'error_message_blank_passname',
            'error_message_invalid_passname',
            'error_message_service_not_available',
            'error_message_account_suspended',
            'error_message_account_locked'
        );
        foreach($loginValuesKeys as $keys){
            $this->config('casino_config.login_config')->set($keys, $form_state->getValue($keys))->save();
        }
        parent::submitForm($form, $form_state);
    }
}
