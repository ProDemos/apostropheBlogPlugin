<?php
  // Compatible with sf_escaping_strategy: true
  $a_event = isset($a_event) ? $sf_data->getRaw('a_event') : null;
  $form = isset($form) ? $sf_data->getRaw('form') : null;
  $popularTags = isset($popularTags) ? $sf_data->getRaw('popularTags') : null;
  $existingTags = isset($existingTags) ? $sf_data->getRaw('existingTags') : null;
?>

<?php use_helper("a") ?>

<form method="POST" action="<?php echo url_for('a_event_admin_update',$a_event) ?>" id="a-admin-form" class="a-ui blog">
<?php a_js_call('apostrophe.formUpdates(?)', array('selector' => '#a-admin-form', 'update' => 'a-admin-blog-post-form')) ?>

<?php if (!$form->getObject()->isNew()): ?><input type="hidden" name="sf_method" value="PUT" /><?php endif; ?>

<div class="a-hidden">
	<?php echo $form->renderHiddenFields() ?>
</div>

<?php // Title and Slug are hidden and handled with inputs in the editSuccess ?>
<div class="post-title post-slug option">
  <?php echo $form['title']->render() ?>
  <?php echo $form['slug']->render() ?>
  <?php echo $form['slug']->renderError() ?>
</div>

<?php // Huge Publish Button and Publish Date ?>
<div class="published section a-form-row">
	
	<div class="a-form-row">
		<a href="#" class="a-btn big a-publish-post <?php echo ($a_event['status'] == 'published')? 'published':'' ?>" onclick="return false;" id="a-blog-publish-button">
	  	<span class="publish"><?php echo __('Publish', array(), 'apostrophe') ?></span>
	  	<span class="unpublish"><?php echo __('Unpublish', array(), 'apostrophe') ?></span>
		</a>
	
		<a href="#" class="a-btn big a-save-event" id="a-event-save-button">
	  	<span class="unpublish"><?php echo __('Save', array(), 'apostrophe') ?></span>
		</a>
	</div>

	<div id="a-blog-item-update" class="a-btn big a-publish-post">Saved</div>

	<div class="post-status option">
  	<?php echo $form['status']->render() ?>
	</div>

	<div class="post-published <?php echo ($a_event['status'] != 'published')? 'draft':'published' ?>">
		<span class="draft">
			<?php echo __('Publish now or', array(), 'apostrophe_blog') ?>  <a href="#" onclick="return false;" class="post-date-toggle"><?php echo __('set a date', array(), 'apostrophe_blog') ?></a>
		</span>		
		<span class="published">
			<?php echo __('Published on '.aDate::medium(strtotime($a_event['published_at'])), array(), 'apostrophe_blog') ?><br/>
			<a href="#" onclick="return false;" class="post-date-toggle"><?php echo __('change date', array(), 'apostrophe_blog') ?></a>		
		</span>
		<div class="post-published-at option">
		  <?php echo $form['published_at']->render(array('onClose' => 'aBlogUpdateMulti')) ?>
		  <?php echo $form['published_at']->renderError() ?>
		</div>
	</div>

	<div class="post-published-at option">
	  <?php echo $form['published_at']->render(array('onClose' => 'aBlogUpdateMulti')) ?>
	  <?php echo $form['published_at']->renderError() ?>
	</div>
</div>



<?php // Event Date Range ?>
<hr />
<div class="event-date section a-form-row">
	<h4>Start Date</h4>
	<div class="start_date">
		<?php echo $form['start_date']->render(array('beforeShow' => 'aBlogSetDateRange', 'onClose' => 'aBlogUpdateMulti')) ?>
		<?php echo $form['start_date']->renderError() ?>
		
		<div class="start_time">
    	<?php echo $form['start_time'] ?>
    	<?php echo $form['start_time']->renderError() ?>
		</div>
	</div>
	<div class="end_date">
		<h4>End Date</h4>
		<?php echo $form['end_date']->render(array('beforeShow' => 'aBlogSetDateRange', 'onClose' => 'aBlogUpdateMulti')) ?>
		<?php echo $form['end_date']->renderError() ?>
    <?php echo $form['end_time'] ?>
    <?php echo $form['end_time']->renderError() ?>
	</div>

	<div class="all_day">
		<h4>All Day Event</h4>
		<?php echo $form['all_day']->renderLabel() ?>
		<?php echo $form['all_day']->render() ?>
		<?php echo $form['all_day']->renderError() ?>
	</div>
	
</div>



<?php // Author & Editors Section ?>
<hr />
<div class="author section a-form-row">

	<?php // Blog Post Author ?>
	<div class="post-author">
	  	<h4><?php echo __('Author', array(), 'apostrophe') ?>
			<?php if ($sf_user->hasCredential('admin')): ?>
				</h4>
				<div class="author_id option">
				<?php echo $form['author_id']->render() ?>
				<?php echo $form['author_id']->renderError() ?>
				</div>
			<?php else: ?>: <span><?php echo $a_event->Author ?></span></h4><?php endif ?>

	</div>

	<?php // Blog Post Editors ?>
  <?php if(isset($form['editors_list'])): ?>
	<div class="post-editors">

		<?php if (!count($a_event->Editors)): ?>
		  <a href="#" onclick="return false;" class="post-editors-toggle a-sidebar-toggle"><?php echo __('allow others to edit this post', array(), 'apostrophe') ?></a>
	  	<div class="post-editors-options option" id="editors-section">
		<?php else: ?>
			<hr/>
	  	<div class="post-editors-options option show-editors" id="editors-section">
		<?php endif ?>

	    <h4><?php echo __('Editors', array(), 'apostrophe') ?></h4>
	    <?php echo $form['editors_list']->render()?>
	    <?php echo $form['editors_list']->renderError() ?>

      </div>
    </div>
  </div>
  <?php endif ?>


	<?php // Blog Post Templates ?>
	<?php if(isset($form['template'])): ?>
	<hr />
	<div class="template section">
		<h4><?php echo __('Template', array(), 'apostrophe') ?></h4>
		<?php echo $form['template']->render() ?>
		<?php echo $form['template']->renderError() ?>
	</div>
	<?php endif ?>


	<?php // Blog Post Comments ?>
	<?php if(isset($form['allow_comments'])): ?>
	<hr />
	<div class="comments section">
		<h4><a href="#" class="allow_comments_toggle <?php echo ($a_event['allow_comments'])? 'enabled' : 'disabled' ?>"><span class="enabled" title="<?php echo __('Click to disable comments', array(), 'apostrophe') ?>"><?php echo __('Comments are enabled', array(), 'apostrophe') ?></span><span class="disabled" title="<?php echo __('Click to enable comments', array(), 'apostrophe') ?>"><?php echo __('Comments are disabled', array(), 'apostrophe') ?></span></a></h4>
		<div class="allow_comments option">
			<?php echo $form['allow_comments']->render() ?>
			<?php echo $form['allow_comments']->renderError() ?>
		</div>
	</div>
	<?php endif ?>


	<?php // Blog Post Categories ?>
	<hr />
	<div class="categories section a-form-row" id="categories-section">
		<h4><?php echo __('Categories', array(), 'apostrophe') ?></h4>
		<?php if($sf_user->hasCredential('admin')): ?>
			<?php echo link_to('<span class="icon"></span>'.a_('edit categories'),'@a_category_admin', array('class' => 'a-btn icon a-edit no-label lite edit-categories', 'title' => a_('edit categories'))) ?>
	  <?php endif ?>
		<?php echo $form['categories_list']->render() ?>
		<?php echo $form['categories_list']->renderError() ?>
	</div>

	<?php // Blog Post Tags ?>
	<hr />
	<div class="tags section a-form-row">
		<?php echo $form['tags']->render() ?>
		<?php echo $form['tags']->renderError() ?>
		<?php a_js_call('pkInlineTaggableWidget(?, ?)', '#a-blog-post-tags-input', array('popular-tags' => $popularTags, 'existing-tags' => $existingTags, 'typeahead-url' => url_for('taggableComplete/complete'), 'tagsLabel' => 'Tags')) ?>
	</div>

	<?php if($a_event->userHasPrivilege('delete')): ?>
		<hr />
		<div class="delete preview section a-form-row">
			<?php $engine = $a_event->findBestEngine(); ?>
	    <?php aRouteTools::pushTargetEnginePage($engine) ?>
			<?php echo link_to('<span class="icon"></span>'.__('Preview', array(), 'apostrophe'), 'a_blog_post', array('preview' => 1) + $a_event->getRoutingParams(), array('class' => 'a-btn icon a-search lite a-align-left', 'rel' => 'external')) ?>
			<?php echo link_to('<span class="icon"></span>'.__('Delete', array(), 'apostrophe'), 'a_event_admin_delete', $a_event, array('class' => 'a-btn icon a-delete lite a-align-right', 'method' => 'delete', 'confirm' => __('Are you sure you want to delete this event?', array(), 'apostrophe'), )) ?>
		</div>
	<?php endif ?>

</form>
<?php include_partial('formScripts', array('a_event' => $a_event, 'form' => $form)) ?>
