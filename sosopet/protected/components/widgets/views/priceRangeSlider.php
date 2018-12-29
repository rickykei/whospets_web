<div class="range">
	Range :
	<span class="min_val"></span> - 
	<span class="max_val"></span>
	<?php echo CHtml::activeHiddenField($model,$minField,array('class'=>'min_value')); ?>
	<?php echo CHtml::activeHiddenField($model,$maxField,array('class'=>'max_value')); ?>
</div>
<div id="slider"></div>
<script>
window.startRangeValues = [<?php echo $minValue; ?>, <?php echo $maxValue; ?>];
</script>