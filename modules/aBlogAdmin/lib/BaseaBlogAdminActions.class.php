<?php
require_once dirname(__FILE__).'/aBlogAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/aBlogAdminGeneratorHelper.class.php';
/**
 * Base actions for the aBlogPlugin aBlogAdmin module.
 * 
 * @package     aBlogPlugin
 * @subpackage  aBlogAdmin
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseaBlogAdminActions extends autoABlogAdminActions
{
  protected function buildQuery()
  {
    $query = parent::buildQuery();
     
    $query->andWhere("author_id = ?", $this->getUser()->getGuardUser()->getId());
    
    return $query;
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->a_blog_post = new aBlogPost();
    $this->a_blog_post->Author = $this->getUser()->getGuardUser();
    $this->a_blog_post->save();
    $this->redirect('aBlogAdmin/edit?id='.$this->a_blog_post->getId());
  }
  
  public function executeAddFilter(sfWebRequest $request)
  {
    $filter_field = $request->getParameter('filter_field');
    $filter_value = $request->getParameter('filter_value');
    
    $filters = $this->getUser()->getAttribute('aBlogAdmin.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    //$filters = $this->configuration->getFilterDefaults();
    $filters[$filter_field] = $filter_value;
    $this->getUser()->setAttribute('aBlogAdmin.filters', $filters, 'admin_module');
    
    $this->redirect('@a_blog_admin');    
  }
  
  public function executeRemoveFilter(sfWebRequest $request)
  {
    $name = $request->getParameter('name');
    $value = $request->getParameter('value');
    
    $filters = $this->getUser()->getAttribute('aBlogAdmin.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters[$name] = null;
    $this->getUser()->setAttribute('aBlogAdmin.filters', $filters, 'admin_module');
    
    $this->redirect('@a_blog_admin');
  }
  
}