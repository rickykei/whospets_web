<div class="col-main">
<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'chat-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'columns'=>array(				
				array(
						'name'=>'subject',
						'type'=>'html',
						'value'=>'$data->chat->title',
						//'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
				array(
						'name'=>'recipient',
						'type'=>'html',
						'value'=>'$data->chat->recipient->username',
						//'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
				//'user_id',
				'message',
				'modified',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{update}{delete}',
					'buttons' => array(
                                'update' => array(
                                    'url' => 'Yii::app()->createUrl("/shop/chat/update", array("id"=>$data->chat_id))',       
                                ),                        
                        ),
					),
			),
		)); ?>
</div>
