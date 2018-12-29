<?php
class FeatureProductGrid extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $id='max';
	public $products=array();
	
    public function run()
    {
        $this->render('featureProductGrid', array('id' => $this->id, 'products' => $this->products));
    }
}
?>