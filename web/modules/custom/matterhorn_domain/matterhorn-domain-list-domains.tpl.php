<?php
  // Add table javascript.
  drupal_add_js('misc/tableheader.js');
  drupal_add_js(drupal_get_path('module', 'matterhorn_domain') . '/matterhorn_domain.js');

  foreach ($groups as $group => $title) {
    drupal_add_tabledrag('blocks', 'match', 'sibling', 'block-region-select', 'block-region-' . $group, NULL, FALSE);
    drupal_add_tabledrag('blocks', 'order', 'sibling', 'block-weight', 'block-weight-' . $group);
  }
?>
<table id="blocks" class="sticky-enabled">
  <thead>
    <tr>
      <th><?php print t('Name'); ?></th>
      <th><?php print t('Domain Group'); ?></th>
      <th><?php print t('Weight'); ?></th>
      <th colspan="2"><?php print t('Operations'); ?></th>
    </tr>
  </thead>
  <tbody>    
    <?php foreach ($groups as $groupid => $group): ?>
		<?php $row = 0; ?>
      <tr class="region-title region-title-<?php print $groupid?>">
        <td colspan="3"><?php print $group['title']; ?></td>
				<td><?php print $group['edit_link']; ?></td>
				<td><?php print $group['delete_link']; ?></td>
      </tr>
      <tr class="region-message region-<?php print $groupid?>-message <?php print empty($domains[$groupid]) ? 'region-empty' : 'region-populated'; ?>">		
					<td colspan="5"><em><?php print t('No domains in this group'); ?></em></td>
      </tr>
			<?php if(isset($domains[$groupid])): ?>
				<?php foreach ($domains[$groupid] as $delta => $data): ?>
				<tr class="draggable <?php print $row % 2 == 0 ? 'odd' : 'even'; ?><?php print $data->row_class ? ' ' . $data->row_class : ''; ?>">
					<td class="block"><?php print $data->name; ?></td>
					<td><?php print $data->domain_select; ?></td>
					<td><?php print $data->weight_select; ?></td>
					<td><?php print $data->edit_link; ?></td>
					<td><?php print $data->delete_link; ?></td>
				</tr>
				<?php $row++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<?php print $form_submit; ?>