<div class="col-main">
<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'chat-grid',
			'dataProvider'=>$model->searchSent(),
			//'filter'=>$model,
			'columns'=>array(				
				'title',
				array(
						'name'=>'user_id',
						'type'=>'html',
						'value'=>'$data->user->username',
						//'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
				'modified',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}',
				),
			),
		)); ?>
</div>