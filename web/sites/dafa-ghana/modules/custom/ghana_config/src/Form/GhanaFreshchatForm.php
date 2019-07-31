<?php

namespace Drupal\ghana_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Freshchat Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_freshchat_config_form",
 *   route = {
 *     "title" = "Ghana Freshchat Configuration",
 *     "path" = "/admin/config/ghana/ghana_freshchat_configuration",
 *   },
 *   menu = {
 *     "title" = "Freshchat Configuration",
 *     "description" = "Provides Freshchat configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 5
 *   },
 * )
 */

class GhanaFreshchatForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['ghana_config.freshchat_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => 'Ghana Freshchat Configuration',
        ];

        $this->sectionPageSetting($form);

        return $form;
    }

    private function sectionPageSetting(array &$form) {
        $form['ghana_freshchat_settings'] = [
            '#type' => 'details',
            '#title' => t('General Settings'),
            '#group' => 'advanced',
        ];

        $this->generalSettings($form);
        $this->faqSettings($form);
        $this->csatSettings($form);
        $this->pushSettings($form);
        $this->agentSettings($form);
    }

    /**
     * General
     */
    private function generalSettings(&$form) {
        $form['ghana_freshchat_settings']['main'] = [
            '#type' => 'details',
            '#title' => t('Main'),
            '#collapsible' => TRUE,
        ];

        $form['ghana_freshchat_settings']['main']['enability'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Freshchat'),
            '#default_value' => $this->get('enability'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_settings']['main']['hidechat'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Hide chat button'),
            '#default_value' => $this->get('hidechat'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_settings']['main']['token'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Freshchat Token'),
            '#default_value' => $this->get('token'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_settings']['main']['host'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Freshchat Host'),
            '#default_value' => $this->get('host'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_settings']['main']['site_id'] = [
            '#type' => 'textfield',
            '#title' => t('Site ID'),
            '#default_value' => $this->get('site_id'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['chat'] = [
            '#type' => 'details',
            '#title' => t('Chat'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $form['ghana_freshchat_settings']['chat']['chat_title'] = [
            '#type' => 'textfield',
            '#title' => t('Chat title'),
            '#description' => t('Title when chat is opened'),
            '#default_value' => $this->get('chat_title'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['chat']['chat_description'] = [
            '#type' => 'textfield',
            '#title' => t('Chat description'),
            '#description' => t('Text below the chat title'),
            '#default_value' => $this->get('chat_description'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['chat']['chat_placeholder'] = [
            '#type' => 'textfield',
            '#title' => t('Chat placeholder'),
            '#default_value' => $this->get('chat_placeholder'),
            '#description' => t('Placeholder for reply field'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['app'] = [
            '#type' => 'details',
            '#title' => t('App'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $config = $this->config('ghana_config.freshchat_configuration');
        $form['ghana_freshchat_settings']['app']['app_name'] = [
            '#type' => 'textfield',
            '#title' => t('App name'),
            '#default_value' => $this->get('app_name'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['app']['app_logo'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('App logo'),
            '#default_value' => $config->get('app_logo'),
            '#description' => t('File type: png, jpg, jpeg. Dimension: 512px x 512px. Must not be larger than 1mb.'),
            '#upload_location' => 'public://upload',
            '#upload_validators' => array(
                'file_validate_extensions' => array('png jpg jpeg'),
            ),
        ];

        $form['ghana_freshchat_settings']['customization'] = [
            '#type' => 'details',
            '#title' => t('Customization'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $form['ghana_freshchat_settings']['customization']['fg_color'] = [
            '#type' => 'color',
            '#title' => t('Text color'),
            '#default_value' => $this->get('fg_color'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['customization']['direction'] = [
            '#type' => 'select',
            '#options' => array('ltr' => 'Left', 'rtr' => 'Right'),
            '#title' => t('Direction'),
            '#description' => t('Chat button position either Left or Right'),
            '#default_value' => $this->get('direction'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['customization']['bg_img'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Background image'),
            '#default_value' => $config->get('bg_img'),
            '#description' => t('File type: png, jpg, jpeg. Dimension: 512px x 512px. Must not be larger than 1mb.'),
            '#upload_location' => 'public://upload',
            '#upload_validators' => array(
                'file_validate_extensions' => array('png jpg jpeg'),
            ),
        ];

        $form['ghana_freshchat_settings']['tabs'] = [
            '#type' => 'details',
            '#title' => t('Tabs'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $form['ghana_freshchat_settings']['tabs']['faq_tab'] = [
            '#type' => 'textfield',
            '#title' => t('Title for FAQ tab'),
            '#default_value' => $this->get('faq_tab'),
            '#translatable' => true,
        ];

        $form['ghana_freshchat_settings']['tabs']['chat_tab'] = [
            '#type' => 'textfield',
            '#title' => t('Title for Chat tab'),
            '#default_value' => $this->get('chat_tab'),
            '#translatable' => true,
        ];
    }

    /**
     * FAQ
     */
    private function faqSettings(&$form) {
        $form['ghana_freshchat_faq_settings'] = [
            '#type' => 'details',
            '#title' => t('FAQ Settings'),
            '#group' => 'advanced',
        ];

        $form['ghana_freshchat_faq_settings']['faq_show'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Hide FAQ'),
            '#default_value' => $this->get('faq_show'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_show_on_open'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Show FAQ on chat open'),
            '#default_value' => $this->get('faq_show_on_open'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_search'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ search label'),
            '#default_value' => $this->get('faq_search'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ title'),
            '#default_value' => $this->get('faq_title'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_description'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ description'),
            '#default_value' => $this->get('faq_description'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_not_available'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ not available message'),
            '#default_value' => $this->get('faq_not_available'),
            '#description' => t('Displays when there are no available FAQs'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_no_results'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ no results message'),
            '#default_value' => $this->get('faq_no_results'),
            '#description' => t('Displays when there are no FAQ results by search term. Include {{query}} as search term'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_helpful'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ helpful message'),
            '#default_value' => $this->get('faq_helpful'),
            '#description' => t('Displays at the bottom of selected FAQ to ask if it was helpful'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_thankyou'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ thank you feedback message'),
            '#default_value' => $this->get('faq_thankyou'),
            '#description' => t('Displays after approving helpful FAQ'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_message_us'] = [
            '#type' => 'textfield',
            '#title' => $this->t('FAQ negative feedback message'),
            '#default_value' => $this->get('faq_message_us'),
            '#description' => t('Displays after disapproving helpful FAQ'),
            '#translatable' => TRUE,
        ];
    }

    /**
     * Customer satisfactory
     */
    private function csatSettings(&$form) {
        $form['ghana_freshchat_customer_satisfactory'] = [
            '#type' => 'details',
            '#title' => t('Customer satisfactory'),
            '#group' => 'advanced',
        ];

        $form['ghana_freshchat_customer_satisfactory']['actions'] = [
            '#type' => 'details',
            '#title' => $this->t('Actions'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['actions']['csat_action_yes'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for "Yes" button'),
            '#default_value' => $this->get('csat_action_yes'),
            '#description' => 'Label for "Yes" button.',
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['actions']['csat_action_no'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for "No" button'),
            '#default_value' => $this->get('csat_action_no'),
            '#description' => 'Label for "No" button.',
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['content'] = [
            '#type' => 'details',
            '#title' => $this->t('Content'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['content']['csat_question'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Question'),
            '#default_value' => $this->get('csat_question'),
            '#description' => t('Message to display to ask for customer satisfaction'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['content']['csat_no_question'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Negative response'),
            '#default_value' => $this->get('csat_no_question'),
            '#description' => t('Message to display when customer clicked "No" on customer satisfaction'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['content']['csat_thankyou_msg'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Thank you message'),
            '#default_value' => $this->get('csat_thankyou_msg'),
            '#description' => t('Message to display after customer satisfactory submission'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_customer_satisfactory']['content']['faq_comment'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Comment placeholder'),
            '#default_value' => $this->get('faq_comment'),
            '#description' => t('Displays as placeholder in textarea after approving customer satisfactory'),
            '#translatable' => TRUE,
        ];
    }

    /**
     * Push notifications
     */
    private function pushSettings(&$form) {
        $form['ghana_freshchat_push_notif'] = [
            '#type' => 'details',
            '#title' => t('Push notifications'),
            '#group' => 'advanced',
        ];

        $form['ghana_freshchat_push_notif']['push_allow'] = [
            '#type' => 'textfield',
            '#title' => t('Push notifications message'),
            '#description' => 'Ask player if they want to enable chat push notifications or not',
            '#default_value' => $this->get('push_allow'),
        ];

        $form['ghana_freshchat_push_notif']['push_yes_button'] = [
            '#type' => 'textfield',
            '#title' => t('Label for "Yes" button'),
            '#default_value' => $this->get('push_yes_button'),
        ];

        $form['ghana_freshchat_push_notif']['push_no_button'] = [
            '#type' => 'textfield',
            '#title' => t('Label for "No" button'),
            '#default_value' => $this->get('push_no_button'),
        ];
    }

    private function agentSettings(&$form) {
        $form['ghana_freshchat_agent'] = [
            '#type' => 'details',
            '#title' => t('Agent settings'),
            '#group' => 'advanced',
        ];

        $form['ghana_freshchat_agent']['agent_description'] = [
            '#type' => 'details',
            '#title' => t('This applies to all the agents of freshchat'),
            '#collapsible' => TRUE,
            '#open' => TRUE,
        ];

        $form['ghana_freshchat_agent']['agent_description']['agent_hide_name'] = [
            '#type' => 'checkbox',
            '#title' => t('Hide agent name'),
            '#default_value' => $this->get('agent_hide_name'),
        ];

        $form['ghana_freshchat_agent']['agent_description']['agent_hide_pic'] = [
            '#type' => 'checkbox',
            '#title' => t('Hide agent name'),
            '#default_value' => $this->get('agent_hide_pic'),
        ];

        $form['ghana_freshchat_agent']['agent_description']['agent_hide_bio'] = [
            '#type' => 'checkbox',
            '#title' => t('Hide agent name'),
            '#default_value' => $this->get('agent_hide_bio'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $keys = [
            'app_logo',
            'bg_img',
            ];
            foreach ($keys as $key) {
                if ($key == 'bg_img' || $key == 'app_logo') {
                    $fid = $form_state->getValue($key);
                    if ($fid) {
                        $file = File::load($fid[0]);
                        $file->setPermanent();
                        $file->save();
                        $file_usage = \Drupal::service('file.usage');
                        $file_usage->add($file, 'ghana_config', 'image', $fid[0]);

                        $this->config('ghana_config.freshchat_configuration')->set($key . '_url', file_create_url($file->getFileUri()))->save();
                    }
                }
                $this->config('ghana_config.freshchat_configuration')->set($key, $form_state->getValue($key))->save();
            }
            parent::submitForm($form, $form_state);
    }

}