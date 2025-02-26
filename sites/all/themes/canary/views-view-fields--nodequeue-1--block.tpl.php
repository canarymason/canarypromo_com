<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
//dsm($fields);
?>

<div class="feature-container" >
    <div class="feature-image <?php print $fields['field_image_feature_fid']->class; ?>">
        <?php //print $fields['field_image_feature_fid']->content;
          $options = Array(
            'html' => TRUE,
          );
          print l($fields['field_image_feature_fid']->content, 'node/'.$fields['field_related_node_nid']->raw, $options);
        ?>
    </div>
    <div class="message-holder">
        <div class="heading">
            <div class="label">Our Work</div>
            <h3 class="title"><?php print l($fields['title']->content, 'node/'.$fields['field_related_node_nid']->raw);?></h3>
            <div class="subtitle"><?php print $fields['field_subtitle_value']->content; ?></div>
        </div>
        <div class="more-info">
          <div class="body"><?php print $fields['field_teaser_value']->content; ?></div>
          <div class="morelink"><?php print l('See and learn more', 'node/'.$fields['field_related_node_nid']->raw); ?></div>
        </div>
    </div>

</div>

<?php
unset($fields['field_image_feature_fid']);
unset($fields['title']);
unset($fields['field_subtitle_value']);
unset($fields['field_teaser_value']);
unset($fields['field_related_node_nid']);
?>
<?php foreach ($fields as $id => $field): ?>
<?php if (!empty($field->separator)): ?>
<?php print $field->separator; ?>
<?php endif; ?>

<<?php print $field->inline_html;?> class="views-field-<?php print $field->class; ?>">
<?php if ($field->label): ?>
<label class="views-label-<?php print $field->class; ?>">
    <?php print $field->label; ?>:
</label>
<?php endif; ?>
<?php
// $field->element_type is either SPAN or DIV depending upon whether or not
// the field is a 'block' element type or 'inline' element type.
?>
<<?php print $field->element_type; ?> class="field-content"><?php print $field->content; ?></<?php print $field->element_type; ?>>
</<?php print $field->inline_html;?>>
<?php endforeach; ?>
