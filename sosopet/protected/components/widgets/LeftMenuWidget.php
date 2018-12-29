<?php
class LeftMenuWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $title='';
	public $items=array();
	
    public function run()
    {
        $this->render('leftMenu', array('title'=>$this->title, 'items' => $this->items,));
    }
}
?>