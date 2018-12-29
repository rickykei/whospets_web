<?php
class ProductTableWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $title;
	public $noOfItems=9;
	public $noOfRowItems=3;
	public $items=array();
	
    public function run()
    {
		
		
        $this->render('productTable', array('title'=>$this->title, 
											'noOfItems'=>$this->noOfItems,
											'noOfRowItems'=>$this->noOfRowItems,
											'items' => $this->items,
										)
									);
    }
}
?>