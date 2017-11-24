/**
 * @file
 * Defines Javascript behaviors for the conflict module.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Behaviors the conflict resolve feature.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the conflict resolve behavior.
   */
  Drupal.behaviors.conflict = {
    attach: function (context, settings) {
      var $conflict_overview_form = $('#conflict-overview-form', context);
      if ($conflict_overview_form.length !== 0) {
        $conflict_overview_form.find('[name="conflict-reset-changes"]').click(function (e) {
          e.preventDefault();
          $('form').each(function () {
            $(this).trigger('reset');
          });
          // Prevent any edit protections as it is unnecessary, because the
          // user confirms it through clicking this button.
          window.onbeforeunload = null;
          window.location = window.location.href;
        });

        var dialogOptions = {
          open: function () {
            $(this).siblings('.ui-dialog-titlebar .ui-dialog-titlebar-close').remove();
          },
          title: $conflict_overview_form.attr('title'),
          modal: true,
          zIndex: 10000,
          position: {my: 'top', at: 'top+25%'},
          autoOpen: true,
          width: 'auto',
          resizable: true,
          draggable: true,
          closeOnEscape: false
        };
        $conflict_overview_form.dialog(dialogOptions);
      }

      $('.conflict-resolution-dialog .ui-dialog-titlebar-close').remove();

      $('.conflict-resolution-dialog .conflict-resolve-conflicts').once('bind-conflict-resolve-conflicts').each(function () {
        $(this).on('click', function () {
          $('#conflict-overview-form [name="conflict-resolve-conflicts"]').mousedown();
        });
      });
    }
  };

})(jQuery, Drupal);
