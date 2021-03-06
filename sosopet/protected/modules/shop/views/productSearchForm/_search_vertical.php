<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->
<section class="section_offset">
	<h3><?php echo Yii::t('shop','Filter Pets Profile');?></h3>
	<div class="table_layout list_view">
		<div class="table_row">
			<!-- - - - - - - - - - - - - - Category filter - - - - - - - - - - - - - - - - -->
			<div class="table_cell">
				<?php
					echo Yii::t('shop','Pet Breed');
					echo CHtml::hiddenField('hidden_cat',$model->category);
					if (Yii::app()->language=='en'){
						$opts = CHtml::listData(Category::model()->findAll('parent_id = 0'),'category_id','title');	
					}else if (Yii::app()->language=='zh'){
						$opts = CHtml::listData(Category::model()->findAll('parent_id = 0'),'category_id','title_zh');	
					}
					echo $form->dropDownList($model,'sub_category',$opts,array('empty'=>Yii::t('shop','-- Please Select --'),
					'ajax' => array(
									'type'=>'POST',
									//'url'=>CController::createUrl('dynamicStates'),
									'url'=>Yii::app()->createUrl('shop/category/dynamicCat'),
									'update'=>'#SearchProductsForm_category',
									'data'=>'js:$(this).serialize()+"&hidden_state='.$model->category.'"',
			 
					)));
					$opts = array();
					if(isset($model->sub_category) && $model->sub_category!='')
					{
							if (Yii::app()->language=='en'){
								$opts = CHtml::listData(Category::model()->findAll('parent_id = '.$model->sub_category),'category_id','title');
							}else if (Yii::app()->language=='zh'){
								$opts = CHtml::listData(Category::model()->findAll('parent_id = '.$model->sub_category),'category_id','title_zh');
							}
					}
					echo $form->dropDownList($model,'category',$opts,array('empty'=>Yii::t('shop','-- Please Select --')));
				
					/*
					if(isset($model->category)){ 
						$category=Category::model()->findByPk($model->category); 
						$subcats=Category::model()->findAllByAttributes(array('parent_id'=>$model->category));
						$allcats=Category::model()->findAll();
						if (isset($category->title))
							echo $category->title;
						//if ($subcats)
						//	echo $form->dropDownList($model, 'category', CHtml::listData($subcats, 'category_id', 'title'),array('empty'=>'-- Please Select --')); 
						//else
						//	echo $form->hiddenField($model, 'category');
						//
						echo $form->dropDownList($model, 'category', CHtml::listData($allcats, 'category_id', 'title'),array('empty'=>'-- Please Select --')); 
					}
					*/
				?>
			</div><!--/ .table_cell -->
			<!-- - - - - - - - - - - - - - End of category filter - - - - - - - - - - - - - - - - -->
			
			<!--- Country-->
			<div class="table_cell">
				<?php
					echo Yii::t('shop','Country');
					echo CHtml::hiddenField('hidden_con',$model->country);
					if (Yii::app()->language=='en'){
						$opts = CHtml::listData(Country::model()->findAll('parent_id = 0'),'country_id','title');	
					}else if (Yii::app()->language=='zh'){
						$opts = CHtml::listData(Country::model()->findAll('parent_id = 0'),'country_id','title_zh');	
					}
					echo $form->dropDownList($model,'country_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --'),
					'ajax' => array(
									'type'=>'POST',
									//'url'=>CController::createUrl('dynamicStates'),
									'url'=>Yii::app()->createUrl('shop/country/dynamicCou'),
									'update'=>'#SearchProductsForm_sub_country_id',
									'data'=>'js:$(this).serialize()+"&hidden_state='.$model->country.'"',
			 
					)));
					$opts = array();
					if(isset($model->sub_country) && $model->sub_country!='')
					{
							if (Yii::app()->language=='en'){
								$opts = CHtml::listData(Country::model()->findAll('parent_id = '.$model->country),'country_id','title');
							}else if (Yii::app()->language=='zh'){
								$opts = CHtml::listData(Country::model()->findAll('parent_id = '.$model->country),'country_id','title_zh');
							}
					}
					echo $form->dropDownList($model,'sub_country_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --')));
				
					/*
					if(isset($model->category)){ 
						$category=Category::model()->findByPk($model->category); 
						$subcats=Category::model()->findAllByAttributes(array('parent_id'=>$model->category));
						$allcats=Category::model()->findAll();
						if (isset($category->title))
							echo $category->title;
						//if ($subcats)
						//	echo $form->dropDownList($model, 'category', CHtml::listData($subcats, 'category_id', 'title'),array('empty'=>'-- Please Select --')); 
						//else
						//	echo $form->hiddenField($model, 'category');
						//
						echo $form->dropDownList($model, 'category', CHtml::listData($allcats, 'category_id', 'title'),array('empty'=>'-- Please Select --')); 
					}
					*/
				?>
			</div>
			
			<!-- end of country filter -->
			<!-- - - - - - - - - - - - - - Price 
			<div class="table_cell">
				<fieldset>
					<legend>Reward</legend>
					<?php/*
						Yii::app()->clientScript->registerCssFile(
							Yii::app()->clientScript->getCoreScriptUrl().
							'/jui/css/base/jquery-ui.css'
						);
						if(!isset($model->minPrice))
							$model->minPrice=0;
						if(!isset($model->maxPrice))
							$model->maxPrice=5000;
						$this->widget('application.components.widgets.PriceRangeSliderWidget',array(
										'model' => $model,
										'minField' => 'minPrice',
										'maxField' => 'maxPrice',
										'minValue' => $model->minPrice,
										'maxValue' => $model->maxPrice,
										)
									);
									*/
					?>
				</fieldset>
			</div><!--/ .table_cell -->
			<!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Age - - - - - - - - - - - - - - - - -->
			<div class="table_cell">
			<?php
				echo $form->labelEx($model, Yii::t('shop','Age'));
				echo $form->numberField($model, 'age');
			?>
			</div>
			<!-- - - - - - - - - - - - - - End Age - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Country - - - - - - - - - - - - - - - - -->
			<!--- <div class="table_cell"> -->
			<?php
			/*Stephen
					echo Shop::getCountryChooser($form, $model,array('prompt'=>'-- Please Select --'));
			*/
			?>
			<!--</div>-->
			<!-- - - - - - - - - - - - - - End country - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Gender - - - - - - - - - - - - - - - - -->
			<div class="table_cell">
			<?php
				echo $form->labelEx($model, Yii::t('shop','Gender'));
				echo $form->dropDownList($model, 'gender', Shop::module()->genderOptions,array('empty'=>Yii::t('shop','-- Please Select --')));
			?>
			</div>
			<!-- - - - - - - - - - - - - - End gender - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Pet Status - - - - - - - - - - - - - - - - -->
			<div class="table_cell">
			<?php
				echo $form->labelEx($model, Yii::t('shop','Pet status'));
				echo $form->dropDownList($model, 'pet_status', Shop::module()->petStatusOpt,array('empty'=>Yii::t('shop','-- Please Select --')));
			?>
			</div>
			<!-- - - - - - - - - - - - - - End pet status - - - - - - - - - - - - - - - - -->
		</div><!--/ .table_row -->
	</div><!--/ .table_layout -->
	<?php echo $form->hiddenField($model,'keywords'); ?>
	<footer class="bottom_box">
		<div class="buttons_row">
			<button type="submit" class="button_blue middle_btn"><?php echo Yii::t('shop','Search');?>
</button>
			<button type="reset" class="button_grey middle_btn filter_reset"><?php echo Yii::t('shop','Reset');?>
</button>
		</div>
	</footer>
</section>
<!-- - - - - - - - - - - - - - End of filter - - - - - - - - - - - - - - - - -->
