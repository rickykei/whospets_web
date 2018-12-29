<?php
class ProductSlide extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $defaultImage='';
	public $thumbImages=array();
	
    public function run()
    {
        $this->render('productSlide', array('defaultImage' => $this->defaultImage, 'thumbImages' => $this->thumbImages));
    }
}
?>