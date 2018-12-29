<?php
class ProfileBreadcrumbsWidget extends CWidget
{
	public $items = array();
	
    public function run()
    {
        $this->render('profile_breadcrumbs', array(
						'items' => $this->items,
						));
    }
} 
?>
