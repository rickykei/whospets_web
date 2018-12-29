<?php
class TabList extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $tabs=array();
	
    public function run()
    {
        $this->render('tabList', array('tabs' => $this->tabs));
    }
}
?>