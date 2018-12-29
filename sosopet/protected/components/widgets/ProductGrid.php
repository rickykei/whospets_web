<?php
class ProductGrid extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $products=array();
	public $size=4;
	
    public function run()
    {
        $this->render('productGrid', array('products' => $this->products, 'size' => $this->size));
    }
}
?>