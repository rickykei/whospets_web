<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>
	<div class="">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<div class="">
            <i class=""></i>
            <div><?php echo $this->t('1#Add files|0#Choose file', $this->multiple); ?></div>
			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
		</div>
        <?php if ($this->multiple) { ?>
		<input type="submit" class="">
			<i class=""></i>
			<div>Start upload</div>
		</input>
		<input type="reset" class="">
			<i class=""></i>
			<div>Cancel upload</div>
		</input>
		<input type="button" class="">
			<i class=""></i>
			<div>Delete</div>
		</input>
		<input type="checkbox" class="">
        <?php } ?>
	</div>
<!-- The loading indicator is shown during image processing -->
<br>
<!-- The table listing the files available for upload/download -->
<table class="">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
</table>
<?php if ($this->showForm) echo CHtml::endForm();?>
