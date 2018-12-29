<?php
$this->beginContent(Yum::module()->baseLayout); ?>

<?php
if (Yum::module()->debug) {
  echo CHtml::openTag('div', array('class' => 'yumwarning'));
  echo Yum::t(
    'You are running the Yii User Management Module {version} in Debug Mode!', array(
      '{version}' => Yum::module()->version));
  echo CHtml::closeTag('div');
}

echo $content;
?>
<?php $this->endContent(); ?>
