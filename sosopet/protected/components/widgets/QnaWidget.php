<?php
class QnaWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $item;
	
    public function run()
    {
        $this->render('qna', array('item' => $this->item,));
    }
}
?>