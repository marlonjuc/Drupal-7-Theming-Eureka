<?php

/**
 * @file
 * Template to display a view as a table.
 */
?>
<table<?php print $attributes; ?>>
  <?php if (!empty($title) || !empty($caption)): ?>
    <caption><?php print $caption . $title; ?></caption>
  <?php endif; ?>
  <?php if (!empty($header)): ?>
    <thead>
      <tr>
        <?php foreach ($header as $field => $label): ?>
          <th
            <?php 
              if(isset($header_attributes))
                print_r ($header_attributes[$field]);
            ?>>
            <?php print $label; ?>
          </th>
        <?php endforeach; ?>
      </tr>
    </thead>
  <?php endif; ?>
  <tbody>
  <?php foreach ($rows as $delta => $row): ?>
    <tr <?php print isset($row_attributes)?$row_attributes[$delta]:""; ?>>
      <?php foreach ($row as $field => $content): ?>
        <td <?php print_r($field_attributes[$field][$delta]); ?>>
          <?php print $content; ?>
        </td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
