<div class="layerslider full_width" style="width:100%; height: 522px;">
<?php
	$position='left: 80px;';
	$description='';
	$href='#';
	$itemCount=0;
	$lineCount=0;
	foreach($items as $item) {
		$itemCount = $itemCount + 1;
		
		echo "\xD\xA".'<!-- - - - - - - - - - - - - - Slide '.$itemCount.' - - - - - - - - - - - - - - - - -->'."\xD\xA";
		echo '<div class="ls-slide" data-ls="transition2d: 10, 27, 63, 67, 69;">';
		echo '<img class="ls-bg" src="'.$item['image'].'" alt="">';
		
		if (isset($item['line1'])){
			$lineCount = $lineCount + 1;
			echo '<div class="ls-l layer_'.$lineCount.'" style="'.(isset($item['line1']['style'])?$item['line1']['style']:$position).'top:128px;" data-ls="offsetxin: -60; durationin: 650; easingin: easeOutBack;">'.(isset($item['line1']['description'])?$item['line1']['description']:$description).'</div>';
		}
		if (isset($item['line2'])){
			$lineCount = $lineCount + 1;
			echo '<div class="ls-l layer_'.$lineCount.'" style="'.(isset($item['line2']['style'])?$item['line2']['style']:$position).'top: 188px;" data-ls="offsetxin: -60; durationin: 650; easingin: easeOutBack; delayin: 150;">'.(isset($item['line2']['description'])?$item['line2']['description']:$description).'</div>';
		}
		if (isset($item['line3'])){
			$lineCount = $lineCount + 1;
			echo '<div class="ls-l layer_'.$lineCount.'" style="'.(isset($item['line3']['style'])?$item['line3']['style']:$position).'top: 252px;" data-ls="offsetxin: -60; durationin: 650; easingin: easeOutBack; delayin: 300;">'.(isset($item['line3']['description'])?$item['line3']['description']:$description).'</div>';
		}
		
		if (isset($item['button'])){
			echo '<a href="'.(isset($item['button']['href'])?$item['button']['href']:$href).'" class="ls-l button_blue huge_btn" style="'.(isset($item['button']['style'])?$item['button']['style']:$position).'top: 330px;" data-ls="offsetxin: -60; durationin: 650; easingin: easeOutBack; delayin: 450;">'.(isset($item['button']['description'])?$item['button']['description']:$description).'</a>';
		}
		
		echo '</div>';
		echo "\xD\xA".'<!-- - - - - - - - - - - - - - End of slide '.$itemCount.' - - - - - - - - - - - - - - - - -->'."\xD\xA";
	}
?>
</div><!--/ #layerslider-->
