<?php
class TableWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $title;
	public $noOfItems=9;
	public $noOfRowItems=3;
	public $headings=array();
	public $items=array();
	
    public function run()
    {
        $this->render('table', array('title'=>$this->title, 
											'noOfItems'=>$this->noOfItems,
											'noOfRowItems'=>$this->noOfRowItems,
											'headings' => $this->headings,
											'items' => $this->items,
										)
									);
    }
}
?>