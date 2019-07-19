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
    Drupal.behaviors.webcomposerSettingsEntityBlocksFilter = {
      attach: function (context) {
        $('input.entity-blocks-filter', context).on('change', function () {
            var children = 'div.' + $(this).prop('name') + ' input[type="checkbox"]';
            var isChecked = $(this).prop('checked');

            $(children).prop('checked', isChecked);
        });

        $('input.entity-blocks-filter-child', context).on('change', function () {
            $('input.entity-blocks-filter').prop('checked', false);
        });
      }
    };
  
  })(jQuery, Drupal);
  