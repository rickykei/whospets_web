<?php
class ProfileMenuWidget extends CWidget
{
	public $title = '';
	public $items = array();
	
    public function run()
    {
        $this->render('profile_menu', array(
						'title' => $this->title,
						'items' => $this->items,
						));
    }
} 
?>
