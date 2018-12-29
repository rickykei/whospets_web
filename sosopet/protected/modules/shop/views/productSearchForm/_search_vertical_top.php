<script language="JavaScript" type="text/javascript">
		<!--
		function sortByPrice()
		{
			$("#SearchProductsForm_sorting").val('price');
			$('#<?php echo $form->id ?>').submit();
		}
		function sortByPriceDesc()
		{
			$("#SearchProductsForm_sorting").val('price_desc');
			$('#<?php echo $form->id ?>').submit();
		}
		function sortByNewest()
		{
			$("#SearchProductsForm_sorting").val('newest');
			$('#<?php echo $form->id ?>').submit();
		}
		function sortBySales()
		{
			$("#SearchProductsForm_sorting").val('sales');
			$('#<?php echo $form->id ?>').submit();
		}
		-->
		</script>

<div class="pager">
	<div class="show-items"> Order By <a class="" href="javascript:sortByPriceDesc();" >Highest Price</a> | <a class="" href="javascript:sortByPrice();" >Lowest Price</a> | <a class="" href="javascript:sortByNewest();" >Newest</a> |<a class="" href="javascript:sortBySales();" >Sales</a></div>
</div>
<?php echo $form->hiddenField($model,'sorting'); ?>