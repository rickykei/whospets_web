<?php
class ShController extends Controller
{
	public function hasStore($user_id=null) {
		if(!$user_id)
			$user_id=Yii::app()->user->id;
		$store=Store::model()->find('user_id=:user_id',
			array(
			  ':user_id'=>$user_id,
			));
		if($store)
			return true;
		else
			return false;
	}
	
	public function checkStore() {
		if(!$this->hasStore()) {
		 	Yum::setFlash('Please create your own store first');
			$this->redirect(Yii::app()->createUrl('/shop/store/create'));
		}
	}
}
?>