<?php 

function renderVariation($variation, $i) { 
	if(!ProductSpecification::model()->findByPk(1))
		return false;
	if(!$variation) {
		$variation = new ProductVariation;
		$variation->specification_id = 1;
	}

	$str = '<tr> <td>';
	//$str .= CHtml::dropDownList("Variations[{$i}][specification_id]",
	//		$variation->specification_id, CHtml::listData(
	//			ProductSpecification::model()->findall(), "id", "title"), array(
	//			'empty' => '-'));  
	$str .= CHtml::hiddenField("Variations[{$i}][specification_id]",$variation->specification_id?$variation->specification_id:1);
	$str .='Size';
	
	$str .= '</td> <td>';
	//$str .= CHtml::textField("Variations[{$i}][title]", $variation->title); 
	$str .= CHtml::dropDownList("Variations[{$i}][title]", $variation->title, SizeGuide::model()->getSizeOptions(), array('prompt'=>'Please select'));	
	$str .= '</td> <td>';

	$str .= CHtml::textField("Variations[{$i}][quantity]", $variation->quantity); 
	$str .= '</td></tr>';

return $str;
} ?>
<main class="col-md-9 col-sm-8">
	<div class="shipping-form-container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'product-form',
		)); ?>
		<?php 
			Shop::renderFlash();
			echo $form->errorSummary(array($model)); 
		?>
		<h3><?php echo Yii::t('shop','Pet Info');?></h3>
		<ul class="form-fields">
		<li>
		<?php
			echo $form->labelEx($model, 'title');
			echo $form->textField($model, 'title');
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'name_of_pet');
			echo $form->textField($model, 'name_of_pet');
		?>
		</li>
		<li>
			<?php
				echo $form->labelEx($model, 'date_born');
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'date_born',
				'value'=>$model->date_born,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeMonth'=>true,
					'changeYear'=>true,
					'yearRange'=>'1900:'.date('Y'),
					'showButtonPanel'=>true,
					'autoSize'=>true,
					'dateFormat'=>'yy-mm-dd',
					'defaultDate'=>$model->date_born,
					),
				'htmlOptions'=>array(
					'class'=>'date',
					),
				)
				); 
			?>
		</li>
		<li>
		<?php echo $form->labelEx($model,'sub_category'); ?>
		<?php 
		/*
		$this->widget('application.modules.shop.components.Relation', array(
			'model' => $model,
			'relation' => 'category',
			'fields' => array('title','parent_id','category_id'),
			'template' => '{fields}',
			'showAddButton' => false,
		));
		*/
		echo CHtml::hiddenField('hidden_cat',$model->category_id);
		if (Yii::app()->language=='zh'){
			$opts = CHtml::listData(Category::model()->findAll('parent_id = 0'),'category_id','title_zh');
		}else{
			$opts = CHtml::listData(Category::model()->findAll('parent_id = 0'),'category_id','title');
		}
		echo $form->dropDownList($model,'sub_category',$opts,array('empty'=>Yii::t('shop','-- Please Select --'),
		'ajax' => array(
                        'type'=>'POST',
                        //'url'=>CController::createUrl('dynamicStates'),
						'url'=>Yii::app()->createUrl('shop/category/dynamicCat'),
                        'update'=>'#Products_category_id',
                        'data'=>'js:$(this).serialize()+"&hidden_state='.$model->category_id.'"',
 
        )));     

		?>
		</li>
		<li>
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php 
		/*$this->widget('application.modules.shop.components.Relation', array(
			'model' => $model,
			'relation' => 'category',
			'fields' => array('title','parent_id','category_id'),
			'template' => '{fields}',
			'showAddButton' => false,
		));*/
		$opts = array();
		if(isset($model->sub_category)){
			if (Yii::app()->language=='zh'){
				$opts = CHtml::listData(Category::model()->findAll('parent_id = '.$model->sub_category),'category_id','title_zh');
			}else{
				$opts = CHtml::listData(Category::model()->findAll('parent_id = '.$model->sub_category),'category_id','title');	
			}
		}
			
		echo $form->dropDownList($model,'category_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --')));
		
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'description');
			echo $form->textArea($model, 'description',array('maxlength' => 300, 'rows' => 6, 'cols' => 50));
		?>
		</li>

		<li>
		<?php
			echo $form->labelEx($model, 'pet_id');
			echo $form->textField($model, 'pet_id');
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'gender');
			//echo $form->textField($model, 'gender');
			echo $form->dropDownList($model, 'gender', Shop::module()->genderOptions,array('empty'=>Yii::t('shop','-- Please Select --')));
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'color');
			if (Yii::app()->language=='zh'){
				$opts = CHtml::listData(Color::model()->findAll(),'color','color_zh');
			}else{
				$opts = CHtml::listData(Color::model()->findAll(),'color','color');
			}
			echo $form->dropDownList($model,'color',$opts,array('empty'=>Yii::t('shop','-- Please Select --'))); 
			//echo $form->textField($model, 'color');
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'size');
			//echo $form->textField($model, 'size');
			echo $form->dropDownList($model, 'size', SizeGuide::model()->getSizeOptions(),array('empty'=>Yii::t('shop','-- Please Select --')));
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'weight');
			echo $form->textField($model, 'weight');
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'height');
			echo $form->textField($model, 'height');
		?>
		</li>

		<li>
		<?php echo $form->labelEx($model,'country'); ?>
		<?php 
	 
		echo CHtml::hiddenField('hidden_cou',$model->country_id);
		if (Yii::app()->language=='zh'){
			$opts = CHtml::listData(Country::model()->findAll('parent_id = 0'),'country_id','title_zh');
		}else{
			$opts = CHtml::listData(Country::model()->findAll('parent_id = 0'),'country_id','title');
		}
		echo $form->dropDownList($model,'country_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --'),
		'ajax' => array(
                        'type'=>'POST',
                        
						'url'=>Yii::app()->createUrl('shop/country/dynamicCou'),
                        'update'=>'#Products_sub_country_id',
                        'data'=>'js:$(this).serialize()+"&hidden_state='.$model->country_id.'"',
 
        )));     

		?>
		</li>
		<li>
		<?php echo $form->labelEx($model,'sub_country_id'); 
		  
		$opts = array();
		if(isset($model->sub_country_id) && $model->country_id !=""){
			if (Yii::app()->language=='zh'){
				$opts = CHtml::listData(Country::model()->findAll('parent_id = '.$model->country_id),'country_id','title_zh');
			}else{
				$opts = CHtml::listData(Country::model()->findAll('parent_id = '.$model->country_id),'country_id','title');	
			}
		}
			
		echo $form->dropDownList($model,'sub_country_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --')));
		
		?>
		</li>
		<li>
		<?php
			//echo $form->labelEx($model, 'country');
			//echo $form->textField($model, 'country');
			//echo Shop::getCountryChooser($form, $model,array('prompt'=>Yii::t('shop','-- Please Select --')));
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'contact');
			echo $form->textField($model, 'contact');
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'pet_status');
			//echo $form->textField($model, 'pet_status');
			echo $form->dropDownList($model, 'pet_status', Shop::module()->petStatusOpt);
		?>
		</li>
            <li>
			<?php
				echo $form->labelEx($model, 'date_lost');
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'date_lost',
				'value'=>$model->date_lost,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeMonth'=>true,
					'changeYear'=>true,
					'yearRange'=>'1900:'.date('Y'),
					'showButtonPanel'=>true,
					'autoSize'=>true,
					'dateFormat'=>'yy-mm-dd',
					'defaultDate'=>$model->date_lost,
					),
				'htmlOptions'=>array(
					'class'=>'date',
					),
				)
				); 
			?>
		</li>
		<li>
			<?php
				echo $form->labelEx($model, 'count_down_end_date');
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'count_down_end_date',
				'value'=>$model->count_down_end_date,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeMonth'=>true,
					'changeYear'=>true,
					'yearRange'=>'1900:'.date('Y'),
					'showButtonPanel'=>true,
					'autoSize'=>true,
					'dateFormat'=>'yy-mm-dd',
					'defaultDate'=>$model->count_down_end_date,
					),
				'htmlOptions'=>array(
					'class'=>'date',
					),
				)
				); 
			?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'price');
			echo $form->textField($model,'price');
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'last_seen_appearance');
			echo $form->textArea($model, 'last_seen_appearance',array('maxlength' => 1000, 'rows' => 20, 'cols' => 50));
		?>
		</li>
		<li>
		<?php
			//echo $form->labelEx($model, 'questions');
			//echo $form->textArea($model, 'questions',array('maxlength' => 300, 'rows' => 6, 'cols' => 50));
		?>
		</li>
		<li>
		<?php
			echo $form->labelEx($model, 'status');
			//echo $form->textField($model,'status');
			echo $form->dropDownList($model, 'status', array('1'=>Yii::t('shop','Active'),'0'=>Yii::t('shop','Inactive'),));
		?>
		</li>
		<li>
		<div class="clearfix"></div>
		<br>
		<?php
			echo $form->hiddenField($model,'condition',array('value'=>0));
			//echo $form->hiddenField($model,'price',array('value'=>0));
			echo $form->hiddenField($model,'tax_id',array('value'=>0));
			//echo $form->hiddenField($model, 'sub_category',array('value'=>''));
			//echo $form->hiddenField($model, 'status',array('value'=>'1'));
		?>
			<?php
			$this->widget('xupload.XUpload', array(
								'url' => Yii::app()->createUrl("shop/products/upload", array("parent_id" => 1)),
								'model' => $upload,
								'attribute' => 'file',
								'multiple' => true,
								'options' => array(
									'maxNumberOfFiles'=>Shop::module()->imageLimit,
									//'maxFileSize' => 3000000,
									//'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
								),
								'htmlOptions' => array('id'=>'product-form'),
			));

		?>
		<input class="button_blue middle_btn" type="submit" value="<?php echo Yii::t('shop','Save');?>" />
		</li>
		</ul>
		<br><br>
	
		
		<br>
		<?php $this->endWidget(); ?>
		
		<?php 
		if(!$model->isNewRecord) {
		?>
		<div class="shipping-form-container">
			<div class="form-title"><?php echo Yii::t('shop','Product Image');?></div>
			<ul class="form-fields">
			<li>
			<?php
				$this->renderPartial('shop.views.image.admin', array('product'=>$model,'images'=>$model->images));
			?>
			</li>
			</ul>
		</div>
		<?php
		}
		?>
	</div>
</main><!--/ [col]-->



