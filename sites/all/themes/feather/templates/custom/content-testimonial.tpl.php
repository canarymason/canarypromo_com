<?php
$fields = $vars['content'];
$v = $vars['vars'];
$output = '';
// dsm($fields);
// dsm($v);

//move desired fields to the top. unset the field after moving it.
// author, client
if($v['field_author_rendered']){
  $fields['field_related_client']['#children'] = '<div class="author-client">'. $v['field_author_rendered'] .', '. $v['field_related_client_rendered'] .'</div>';
  unset($fields['field_author']);
}

// subtitle
/*
$output .= $v['field_subtitle_rendered'];
unset($fields['field_subtitle']);
*/

// move 'read more' link to the end of teaser text
if(module_exists('ed_readmore')){
  define('ED_READMORE_PLACEMENT_DEFAULT', 'inline');
  $display = variable_get('ed_readmore_placement', ED_READMORE_PLACEMENT_DEFAULT);
  // Don't do anything if placing the link is disabled
  if ($display != 'disable') {
    // Check to make sure that this is a teaser and there's actually more to read
    if ($v['teaser'] && $v['readmore']) {
      $fields['body']['#value'] = ed_readmore_link_place($fields['body']['#value'], $v['node'], $display);
    }
  }
}

//loop through all remaining fields and print their values
if (is_array($fields)) {
  foreach($fields as $field) {
    //print field values
    if (strlen($field['#value']) > 1) { $output .= $field['#value'];  } 
    else if (strlen($field['#children']) > 1) { $output .= $field['#children']; }
    //loop through groups
    elseif (is_array($field)) {
      //unset($field['#children']);            
      foreach($field as $groupfield) {
        if (strlen($groupfield['#value']) > 1) { print $groupfield['#value'];}
        elseif(strlen($groupfield['#children']) > 1){ print $groupfield['#children'];}
      }
    }
  }
} 
print $output;
?>