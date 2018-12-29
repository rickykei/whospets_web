<?php
class ProductWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $item;
	
    public function run()
    {
        $this->render('product', array('item' => $this->item,));
    }
}
?>