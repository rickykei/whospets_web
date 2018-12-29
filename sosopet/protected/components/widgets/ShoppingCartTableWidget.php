<?php
class ShoppingCartTableWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $items=array();
	
    public function run()
    {
        $this->render('shoppingCartTable', array('items' => $this->items,));
    }
}
?>