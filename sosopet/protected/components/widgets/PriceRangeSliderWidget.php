<?php
class PriceRangeSliderWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $model;
	public $maxField='minPrice';
	public $minField='maxPrice';
	public $maxValue=0;
	public $minValue=5000;
	
    public function run()
    {
        $this->render('priceRangeSlider', array('model' => $this->model,
												'maxField' => $this->maxField,
												'minField' => $this->minField,
												'maxValue' => $this->maxValue,
												'minValue' => $this->minValue,
											)
					);
    }
}
?>