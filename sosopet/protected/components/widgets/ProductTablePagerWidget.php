<?php
class ProductTablePagerWidget extends CWidget
{
	/**
	 * @var array the data that will be passed to the partial view rendered by each tab.
	 */
	public $currentPage;
	public $itemCount;
	public $pageSize;
	public $maxButtonCount;
	public $pageParam='page';
	
    public function run()
    {
        $this->render('productTablePager', array('currentPage'=>$this->currentPage, 
											'itemCount'=>$this->itemCount,
											'pageSize'=>$this->pageSize,
											'maxButtonCount' => $this->maxButtonCount,
											'pageParam'=> $this->pageParam,
										)
									);
    }
}
?>