<?php
class BreadcrumbsWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $items=array();
	
    public function run()
    {
        $this->render('breadcrumbs', array('items' => $this->items,));
    }
}
?>