<?php
class ProductShowcaseWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $title;
	public $noOfItems=6;
	public $items=array();
	
    public function run()
    {
        $this->render('productShowcase', array('title'=>$this->title, 'noOfItems'=>$this->noOfItems,'items' => $this->items,));
    }
}
?>