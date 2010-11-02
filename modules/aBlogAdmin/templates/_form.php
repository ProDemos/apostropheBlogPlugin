<?php
  // Compatible with sf_escaping_strategy: true
  $a_blog_post = isset($a_blog_post) ? $sf_data->getRaw('a_blog_post') : null;
  $form = isset($form) ? $sf_data->getRaw('form') : null;
  $popularTags = isset($popularTags) ? $sf_data->getRaw('popularTags') : null;
  $existingTags = isset($existingTags) ? $sf_data->getRaw('existingTags') : null;
?>

<?php use_helper("a") ?>

<?php $v = $form['publication']->getValue() ?>
<?php $saveLabels = array('nochange' => a_('Update'), 'draft' => a_('Save'), 'publish' => a_('Publish'), 'schedule' => a_('Update')) ?>
<?php $saveLabel = $saveLabels[$form['publication']->getValue()] ?>
<?php // One tiny difference: if we move from something else *TO* schedule, label it 'Schedule' ?>
<?php $updateLabels = array('nochange' => a_('Update'), 'draft' => a_('Save'), 'publish' => a_('Publish'), 'schedule' => a_('Schedule')) ?>
<?php // Invoked by include_partial in the initial load of the form partial and also directly on AJAX updates of this section ?>
<div class="a-hidden">
	<?php echo $form->renderHiddenFields() ?>
</div>

<div class="published section a-form-row">
  <div class="post-save clearfix">
  	<?php echo a_anchor_submit_button($saveLabel, array('a-save', 'a-save-blog-main', 'big')) ?>							
  </div>
 	<h4><?php echo a_('Status') ?></h4>
  <div class="a-form-row">
    <?php echo $form['publication']->render() ?>
  </div>
  <div class="a-published-at-container">
		<div class="a-form-row">
    <?php echo $form['published_at']->render() ?>
		</div>
   	<?php echo $form['published_at']->renderError() ?>
  </div>  
</div>

<?php // Author & Editors Section ?>
<hr />
<div class="author section a-form-row">

	<?php // Blog Post Author ?>
	<div class="post-author">
	  	<h4><?php echo a_('Author') ?>
			<?php if ($sf_user->hasCredential('admin')): ?>
				</h4>
				<div class="author_id option">
				<?php echo $form['author_id']->render() ?>
				<?php echo $form['author_id']->renderError() ?>
				</div>
			<?php else: ?>: <span><?php echo $a_blog_post->Author ?></span></h4><?php endif ?>
	</div>

	<?php // Blog Post Editors ?>
  <?php if(isset($form['editors_list'])): ?>
	<div class="post-editors">

		<?php if (!count($a_blog_post->Editors)): ?>
		  <a href="#" onclick="return false;" class="post-editors-toggle a-sidebar-toggle"><?php echo a_('allow others to edit this post') ?></a>
	  	<div class="post-editors-options option" id="editors-section">
		<?php else: ?>
			<hr/>
	  	<div class="post-editors-options option show-editors" id="editors-section">
		<?php endif ?>

	    <h4><?php echo a_('Editors') ?></h4>
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
		<h4><?php echo a_('Template') ?></h4>
		<div class="a-form-row">
		<?php echo $form['template']->render() ?>
		</div>
		<?php echo $form['template']->renderError() ?>
	</div>
	<?php endif ?>


	<?php // Blog Post Comments ?>
	<?php if(isset($form['allow_comments'])): ?>
	<hr />
	<div class="comments section">
		<h4><a href="#" class="allow_comments_toggle <?php echo ($a_blog_post['allow_comments'])? 'enabled' : 'disabled' ?>"><span class="enabled" title="<?php echo a_('Click to disable comments') ?>"><?php echo a_('Comments are enabled') ?></span><span class="disabled" title="<?php echo a_('Click to enable comments') ?>"><?php echo a_('Comments are disabled') ?></span></a></h4>
		<div class="allow_comments option">
			<?php echo $form['allow_comments']->render() ?>
			<?php echo $form['allow_comments']->renderError() ?>
		</div>
	</div>
	<?php endif ?>
	
	<?php // Blog Post Categories ?>
	<hr />
	<div class="categories section a-form-row" id="categories-section">
		<h4><?php echo a_('Categories') ?></h4>
		<?php if($sf_user->hasCredential('admin')): ?>
			<?php echo link_to('<span class="icon"></span>'.a_('edit categories'),'@a_category_admin', array('class' => 'a-btn icon a-edit no-label lite edit-categories', 'title' => a_('edit categories'))) ?>
	  <?php endif ?>
		<?php echo $form['categories_list']->render() ?>
		<?php echo $form['categories_list']->renderError() ?>
	</div>

	<?php // Blog Post Tags ?>
	<hr />
	<div class="tags section a-form-row">
	  <?php // Without this we can't tell what it's for at all unless there are popular tags to be shown. If you ?>
	  <?php // remove this think it through. ?>
	  <h4><?php echo a_('Tags') ?></h4>
	  
		<?php echo $form['tags']->render() ?>
		<?php echo $form['tags']->renderError() ?>
		<?php a_js_call('pkInlineTaggableWidget(?, ?)', '#a-blog-post-tags-input', array('popular-tags' => $popularTags, 'existing-tags' => $existingTags, 'typeahead-url' => url_for('taggableComplete/complete'), 'tags-label' => a_('Tags'))) ?>
				
	</div>


	<hr />
	<div class="delete preview section a-form-row">
		<?php $engine = $a_blog_post->findBestEngine(); ?>
	  <?php aRouteTools::pushTargetEnginePage($engine) ?>
		<?php echo link_to('<span class="icon"></span>'.a_('Preview'), 'a_blog_post', array('preview' => 1) + $a_blog_post->getRoutingParams(), array('class' => 'a-btn icon a-search lite a-align-left', 'rel' => 'external')) ?>
	  <?php aRouteTools::popTargetEnginePage($engine->engine) ?>
	  <?php if($a_blog_post->userHasPrivilege('delete')): ?>
		  <?php echo link_to('<span class="icon"></span>'.a_('Delete'), 'a_blog_admin_delete', $a_blog_post, array('class' => 'a-btn icon a-delete lite a-align-right', 'method' => 'delete', 'confirm' => a_('Are you sure you want to delete this post?'), )) ?>
	  <?php endif ?>
	</div>

</form>
<?php a_js_call('aBlogEnableForm(?)', array('update-labels' => $updateLabels, 'reset-url' => url_for('@a_blog_admin_update?' . http_build_query(array('id' => $a_blog_post->id, 'slug' => $a_blog_post->slug))), 'editors-choose-label' => a_('Choose Editors'), 'categories-choose-label' => a_('Choose Categories'), 'categories-add' => $sf_user->hasCredential('admin'), 'categories-add-label' => a_('+ New Category'), 'popularTags' => $popularTags, 'existingTags' => $existingTags, 'template-change-warning' => a_('You are changing templates. Be sure to save any changes to the content at right before saving this change.'))) ?>
