<?php slot('body_class') ?>a-blog <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav') ?>
	<div class="a-subnav-wrapper blog">
		<div class="a-subnav-inner">
	    <?php include_component('aEvent', 'sidebar', array('params' => $params, 'dateRange' => $dateRange, 'categories' => $blogCategories)) ?>
	  </div> 
	</div>
<?php end_slot() ?>

<div id="a-blog-main" class="a-blog-main">
  <?php if ($sf_params->get('year')): ?>
  <h2><?php echo $sf_params->get('day') ?> <?php echo ($sf_params->get('month')) ? date('F', strtotime(date('Y').'-'.$sf_params->get('month').'-01')) : '' ?> <?php echo $sf_params->get('year') ?></h2>
  <ul class="a-controls a-blog-browser-controls">
    <li><?php echo link_to('Previous', '@a_event?'.http_build_query($params['prev']), array('class' => 'a-btn icon a-arrow-left nobg', )) ?></li>
    <li><?php echo link_to('Next', '@a_event?'.http_build_query($params['next']), array('class' => 'a-btn icon a-arrow-right nobg', )) ?></li>
  </ul>
  <?php endif ?>
  
  <?php if($sf_user->isAuthenticated()): ?>
  	<?php echo link_to('New Post', '@a_event_admin_new', array('class' => 'a-btn icon')) ?>
  <?php endif ?>

  <?php foreach ($pager->getResults() as $a_event): ?>
  	<?php echo include_partial('aEvent/post', array('a_event' => $a_event)) ?>
  	<hr>
  <?php endforeach ?>    
</div>
  