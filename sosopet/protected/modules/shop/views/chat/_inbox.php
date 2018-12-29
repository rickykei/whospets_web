<div class="col-main">
<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'chat-grid',
			'dataProvider'=>$model->searchInbox(),
			//'filter'=>$model,
			'rowCssClassExpression'=>'$data->isUnread()?"row-unread":""',
			'columns'=>array(				
				//'title',
				array(
						'name'=>'title',
						'type'=>'html',
						'value'=>'$data->title',
						//'htmlOptions'=>array('style' => 'font-weight: bold;'),
					),
				array(
						'name'=>'user_id',
						'type'=>'html',
						'value'=>'$data->user->username',
						//'htmlOptions'=>array('style' => 'font-weight: bold;'),
					),
				'modified',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}',
				),
			),
		)); ?>
</div>