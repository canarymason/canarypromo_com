<?php
// $Id: preprocess-node.inc,v 1.3 2009/04/20 17:15:17 zarabadoo Exp $

/**
 * Implementation of theme_preprocess_HOOK().
 * Passes varables to the node templates.
 *
 * @return $vars
 */
// Prepare the arrays to handle the classes and ids for the node container.
if(!isset($vars['node']->attributes)) {
  $vars['node_attributes'] = array();
}
else {
  $vars['node_attributes'] = $vars['node']->attributes;
}

// Add an id to allow the styling of a specific node.
$vars['node_attributes']['id'] = 'node-' . $vars['type'] . '-' . $vars['nid'];

// Add a class to allow styling of nodes of a specific type.
$vars['node_attributes']['class'][] = $vars['type'] . '-ntype';

// Add a class to allow styling based on publish status.
if ($vars['status'] > 0) {
  $vars['node_attributes']['class'][] = 'published';
}
else {
  $vars['node_attributes']['class'][] = 'not-published';
}

// Add a class to allow styling based on promotion.
if ($vars['promote'] > 0) {
  $vars['node_attributes']['class'][] = 'promoted';
}
else {
  $vars['node_attributes']['class'][] = 'not-promoted';
}

// Add a class to allow styling based on sticky status.
if ($vars['sticky']) {
  $vars['node_attributes']['class'][] = 'sticky';
}
else {
  $vars['node_attributes']['class'][] = 'not-sticky';
}

// Add a class to allow styling based on if a node is showing a teaser or the 
// whole thing.
if ($vars['teaser']) {
  $vars['node_attributes']['class'][] = 'teaser-view';
}
else {
  $vars['node_attributes']['class'][] = 'full-view';
}

// Add a class to allow styling of nodes being viewed by the author of the 
// node in question.
if ($vars['uid'] == $vars['user']->uid) {
  $vars['node_attributes']['class'][] = 'self-posted';
}

// Add a class to allow styling based on the node author.
$vars['node_attributes']['class'][] = 'author-' . strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $vars['node']->name));

// Add a class to allow styling for zebra striping.
$vars['node_attributes']['class'][] = $vars['zebra'];

// Add a class to make the node container self clearing.
$vars['node_attributes']['class'][] = 'clear-block';

// Crunch all the attributes together into a single string to be applied to 
// the node container.
$vars['attributes'] = theme('render_attributes', $vars['node_attributes']);



//use content-NODETYPE.tpl.php to theme content variable
$vars_content = array(
  'content' => $vars['node']->content,
  'vars' => $vars,
  );
$vars['content'] = theme('content', $vars_content);

