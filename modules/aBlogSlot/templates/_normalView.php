<?php include_partial('a/simpleEditButton', array('name' => $name, 'pageid' => $pageid, 'permid' => $permid)) ?>
<?php foreach($aBlogPosts as $aBlogPost): ?>
  <br/>
  <?php include_partial('aBlog/'.$aBlogPost['template'].'_rss', array('aBlogPost' => $aBlogPost)) ?>
  <br/>
<?php endforeach ?>