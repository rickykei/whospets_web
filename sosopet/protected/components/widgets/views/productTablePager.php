<?php
	//echo 'Current Page'.$currentPage.'<br>';
	//echo 'itemCount Page'.$itemCount.'<br>';
	//echo 'pageSize Page'.$pageSize.'<br>';
	//echo 'maxButtonCount Page'.$maxButtonCount.'<br>';
	//echo 'no of pages'.ceil($itemCount/$pageSize).'<br>';
	//echo Yii::app()->request->requestUri.'<br>';
	//echo Yii::app()->baseURL.'/'.Yii::app()->request->getPathInfo().'<br>';
?>
<footer class="bottom_box on_the_sides">
	<div class="left_side">
		<p><!--Showing 1 to 3 of 45 (15 Pages)--></p>
	</div>
	<div class="right_side">
		<ul class="pags">
			<?php
			 
				$currentPage++;
				$noOfPages = ceil($itemCount/$pageSize);
				
				$q_str="hidden_cat=".Yii::app()->request->getParam('hidden_cat');
				$SearchProductsForm['SearchProductsForm']=Yii::app()->request->getParam("SearchProductsForm");
				$q_str.='&'.http_build_query($SearchProductsForm);
			 
				
				//$currentUrl = Yii::app()->baseURL.'/'.Yii::app()->request->getPathInfo().'?'.Yii::app()->request->getQueryString();
				//$currentUrl = Yii::app()->baseURL.'/'.Yii::app()->request->getPathInfo();
				$currentUrl = Yii::app()->baseURL.'/'.Yii::app()->request->getPathInfo().'?'.$q_str;
				$startPage = 1;
				$endPage = $noOfPages;
				
				//$currentPage = 9;
				//$noOfPages = 10;
				//$maxButtonCount =6;
				
				$sideButtonCount = floor($maxButtonCount/2);
				
				if ($noOfPages>$maxButtonCount) {
					if (($currentPage-$sideButtonCount)<=0){
						$startPage = 1;
						$endPage = $maxButtonCount;
						//echo '<<<<';
					}elseif (($currentPage+$sideButtonCount)>$noOfPages){
						$startPage = $noOfPages - $maxButtonCount + 1;
						$endPage = $noOfPages;
						//echo '>>>>';
					}else{
						$startPage = $currentPage - $sideButtonCount;
						$endPage = $startPage + $maxButtonCount - 1;
						//echo 'normal';
					}
				}
				
				 
				if ($noOfPages>1){
					if ($currentPage==1)
						echo '<li><a href="'.$currentUrl.'&'.$pageParam.'='.($currentPage).'"></a></li>';
					else
						echo '<li><a href="'.$currentUrl.'&'.$pageParam.'='.($currentPage-1).'"></a></li>';
					
					for ($i = $startPage; $i <= $endPage; $i++) {
						if ($i==$currentPage)
							echo '<li class="active"><a href="'.$currentUrl.'&'.$pageParam.'='.$i.'">'.$i.'</a></li>';
						else
							echo '<li><a href="'.$currentUrl.'&'.$pageParam.'='.$i.'">'.$i.'</a></li>';
					}
					if ($currentPage==$noOfPages)
						echo '<li><a href="'.$currentUrl.'&'.$pageParam.'='.$currentPage.'"></a></li>';
					else
						echo '<li><a href="'.$currentUrl.'&'.$pageParam.'='.($currentPage+1).'"></a></li>';
				}
			?>
		</ul>
	</div>
</footer>
