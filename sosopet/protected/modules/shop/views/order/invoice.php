<?php
Shop::register('css/shop_print.css', 'print');
Shop::register('js/print.js');
Yii::app()->clientScript->registerScript('print',  " $('#slip').printElement(); " );

?>

<div id="slip" style="broder: solid 1px; padding: 10px;">

<?php $this->renderPartial(Shop::module()->headerView); ?>

  <table width="100%" border="0">
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php $model->deliveryAddress->renderAddress(); ?><br>
            <br>
            <strong><?php echo Shop::t('Payment Method'); ?></strong> 
						<?php echo $model->paymentMethod->title; ?><br>
            <strong><?php echo Shop::t('Order number'); ?></strong> 
						<?php echo $model->order_id; ?><br>
            <strong><?php echo Shop::t('date'); ?></strong> 
						<?php echo date(Shop::module()->dateFormat, $model->ordering_date); ?><br>
            </font></td>
          <td width="1"><?php echo CHtml::image(Shop::module()->logoPath, ''); ?></td>
        </tr>
      </table>
      <br>
      <!-- address -->
      <table style="border-top:1px solid; border-bottom:1px solid;border-color: #888;" width="100%" border="0">
        <tr bgcolor="#f1f1f1"> 
          <td width="50%" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"> 
            <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
		<?php echo Shop::t('Delivery address'); ?>
            </strong>
          </font></td>
          <td style="border-bottom: 1px solid; border-color: #888;"> 
            <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
  		</strong><strong>
		<?php echo Shop::t('Billing address'); ?>
            </strong>
          </font></td>
        </tr>
        <tr>
          <td style="border-right: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
							<?php $model->deliveryAddress->renderAddress(); ?>
          </font></td>
          <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
							<?php $model->billingAddress->renderAddress(); ?>
          </font></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
  </tr>
</table>

<!-- product -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo Shop::t('Products'); ?></strong></font></td>
  </tr>
  <tr>
    <td>
	<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-top: 1px solid; border-color: #888;">
        <tr bgcolor="f1f1f1"> 
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::t('Product number'); ?></font></strong></td>
          <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::t('Product'); ?></font></strong></td>
          <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::t('Price Single'); ?></font></strong></td>
          <td width="30" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::t('Amount'); ?></font></strong></td>
	  <td style="border-bottom: 1px solid; border-color: #888;text-align: center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::t('Price'); ?></font></strong></td>
        </tr>
<?php foreach($model->positions as $position) { ?>
        <tr> 
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $position->product_id; ?></font></td>
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $position->product->title; ?></strong> <em><?php echo $position->listSpecifications(); ?></em></font></td>
	  <td wiidth="60" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::priceFormat($position->getPrice()/$position->amount); ?></font></td>
          <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $position->amount; ?></font></td>
	  <td width="60" style="border-bottom: 1px solid; border-color: #888;text-align: right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::priceFormat($position->getPrice()); ?></font></td>
        </tr>


<?php } ?>

<!-- shipping cost -->
<?php if($model->shippingMethod) { ?>
        <tr> 
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">---</font></td>
          <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $model->shippingMethod->title; ?></strong> </font></td>
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::priceFormat($model->shippingMethod->price); ?></font></td>
          <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">1</font></td>
	  <td style="border-bottom: 1px solid; border-color: #888;text-align: right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo Shop::priceFormat($model->shippingMethod->price); ?></font></td>
        </tr>
<?php } ?> 

<!-- discount position -->
<?php foreach($model->discounts as $discount) { ?>
        <tr> 
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">---</font></td>
	  <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo 'ポイント利用値引き'; ?></strong> <em><?php echo ''; ?></em></font></td>
	  <td wiidth="60" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo '▲'.Shop::priceFormat($discount->amount); ?></font></td>
          <td style="border-right: 1px solid; border-bottom: 1px solid; border-color: #888;text-align: center;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">1</font></td>
	  <td width="60" style="border-bottom: 1px solid; border-color: #888;text-align: right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo '▲'.Shop::priceFormat($discount->getPrice()); ?></font></td>
        </tr>
<?php } ?> 



 </table>
	</td>
  </tr>
</table>

<!-- tax calculation -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td nowrap> <table width="100%" border="0" cellpadding="3" cellspacing="0">
        <tr> 
          <td nowrap width="100%" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;"><div align="right"><font size="1" face="Arial, Helvetica, sans-serif"><?php echo Shop::t('Total value'); ?>
              <?php echo Shop::priceFormat($model->getTotalPrice()); ?></font></div></td>
        </tr>
        <tr> 
          <td nowrap width="100%" style="border-right: 1px solid; border-bottom: 1px solid; border-color: #ffffff;"><div align="right"><font size="1" face="Arial, Helvetica, sans-serif">(<?php echo Shop::t('Tax amount'); ?>
	  <?php echo Shop::priceFormat($model->getTaxAmount()); ?>)</font></div></td>
        </tr>

        </table></td>
  </tr>
</table>

<br />
<br />

<?php if(Yii::app()->params['pointEnable']) { ?>

<!-- point -->
	<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-top: 1px solid; border-color: #888;">
          <tr bgcolor="f1f1f1">
　　　      <td style="text-align:center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">前回までのポイント</font></strong></td>
　　　      <td style="border-left: 1px solid; border-color:#888;text-align:center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">今回利用ポイント</font></strong></td>
　　　      <td style="border-left: 1px solid; border-color:#888;text-align:center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">今回獲得ポイント</font></strong></td>
　　　      <td style="border-left: 1px solid; border-color:#888;text-align:center;"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">次回のポイント</font></strong></td>
          </tr>
          <tr>
            <td style="border-top: 1px solid;border-bottom: 1px solid;text-align:right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">13,000</font></td>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-left: 1px solid; border-color:#888;text-align:right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">2,000</font></td>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-left: 1px solid; border-color:#888;text-align:right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">500</font></td>
            <td style="border-top: 1px solid;border-bottom: 1px solid;border-left: 1px solid; border-color:#888;text-align:right;"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">11,500</font></td>
          </tr>
        </table>


<br />
<br />
<br />
<?php } ?>


<div id="print-footer">
<?php $this->renderPartial(Shop::module()->footerView); ?>
</div>
</div>
