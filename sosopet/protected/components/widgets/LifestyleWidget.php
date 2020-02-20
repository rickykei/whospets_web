<?php
class LifestyleWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $item;
	
    public function run()
    {
        $this->render('lifestyle', array('item' => $this->item,));
    }
}
?>