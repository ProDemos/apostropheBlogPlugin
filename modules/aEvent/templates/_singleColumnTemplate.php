<?php a_area('blog-post-body', array(
  'editable' => false, 'toolbar' => 'basic', 'slug' => 'aBlogPost-'.$a_event['id'],
  'allowed_types' => array('aRichText', 'aImage', 'aButton', 'aSlideshow', 'aVideo'),
  'type_options' => array(
    'aRichText' => array('tool' => 'Main'),   
    'aImage' => array('width' => 700, 'flexHeight' => true, 'resizeType' => 's'),
    'aButton' => array('width' => 700, 'flexHeight' => true, 'resizeType' => 's'),
    'aSlideshow' => array("width" => 700, "flexHeight" => true, 'resizeType' => 's', )
  ))
) ?>