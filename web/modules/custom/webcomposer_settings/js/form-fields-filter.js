/**
 * @file
 * JavaScript behaviors for admin pages.
 */

(function ($, Drupal) {

    'use strict';
  
    /**
     * Webcomposer settings handler.
     *
     * @type {Drupal~behavior}
     */
    Drupal.behaviors.webcomposerSettingsFormFieldsFilter = {
      attach: function (context) {
        $('a.select-all, a.deselect-all', context).click(function (e) {
            e.preventDefault();

            var selector = 'input.' + $(this).data('checkbox-selector') + '-form-fields-filter';
            $(selector).prop('checked', e.target.className === 'select-all');
        });
      }
    };
  
  })(jQuery, Drupal);
  