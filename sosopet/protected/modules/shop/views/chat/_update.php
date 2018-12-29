<div class="col-main">
	<h4><?php echo $model->title; ?></h4>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'chat-grid',
			'dataProvider'=>$chatMessages->searchMessages(),
			//'filter'=>$model,
			'columns'=>array(				
				array(
						'name'=>Yii::t('shop','from'),
						'type'=>'html',
						'value'=>'$data->user->username',
						//'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
					),
				//'user_id',
				'message',
				array(            // display 'author.username' using an expression
					'name'=>Yii::t('shop','image(s)'),
					'type'=>'raw',
					'value'=>array($this, '_admin_grid'),
				),
				'modified',
				array(
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'buttons' => array(
                                'delete' => array(
                                    'url' => 'Yii::app()->createUrl("/shop/chatMessage/delete", array("id"=>$data->id))',   
									'visible' => 'Yii::app()->user->id==$data->user_id?true:false',
                                ),                        
                        ),
				),
			),
		)); 
	?>
	<h4><?php echo Yii::t('shop','reply');?></h4>
	<?php
		$this->renderPartial('_reply_form', array('model'=>$messageForm,'upload'=>$upload,));		
	?>
</div>