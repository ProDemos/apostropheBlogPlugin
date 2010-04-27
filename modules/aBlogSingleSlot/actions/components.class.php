<?php
class aBlogSingleSlotComponents extends BaseaSlotComponents
{
  protected $modelClass = 'aBlogPost';
  protected $formClass = 'aBlogSingleSlotForm';
  
  public function executeEditView()
  {
    // Must be at the start of both view components
    $this->setup();
    
    // Careful, don't clobber a form object provided to us with validation errors
    // from an earlier pass
    if (!isset($this->form))
    {
      $this->form = new $this->formClass($this->id, $this->slot->getArrayValue());
    }
  }
  public function executeNormalView()
  {
    $this->setup();
    $this->values = $this->slot->getArrayValue();
    if(isset($this->values['blog_item']))
    {
      $this->aBlogItem = Doctrine::getTable($this->modelClass)->findOneBy('id', $this->values['blog_item']);
      aBlogItemTable::populatePages(array($this->aBlogItem));
    }
  }
}