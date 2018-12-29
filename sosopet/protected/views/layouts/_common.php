<!doctype html>
<html lang="en">
	<head>
		<!-- Basic page needs
		============================================ -->
		<title>WHOSPETS | Home</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas
		============================================ -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/fav_icon.ico">

		<!-- Google web fonts
		============================================ -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

		<!-- Libs CSS
		============================================ -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animate.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontello.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
		
		<!-- Theme CSS
		============================================ -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.min.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/layerslider/css/layerslider.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/owlcarousel/owl.carousel.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/arcticmodal/jquery.arcticmodal.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">

		<!-- JS Libs
		============================================ -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script>

		<!-- Old IE stylesheet
		============================================ -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oldie.css">
		<![endif]-->
	</head>
	<body class="front_page">

		

		<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

		<div class="wide_layout">

			<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
			<?php include('_header.php');?>
			<!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - -->
			
			<?php echo $content; ?>

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->
			<?php include('_footer.php');?>
			<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

		</div><!--/ [layout]-->
		
		<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->
		<?php include('_social_feed.php');?>
		<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->
		
		<!-- Include Libs & Plugins
		============================================ -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-2.1.1.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/queryloader2.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.elevateZoom-3.0.8.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/jquery.fancybox.pack.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-media.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/layerslider/js/greensock.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/layerslider/js/layerslider.transitions.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.appear.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/owlcarousel/owl.carousel.min.js"></script>

		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.countdown.plugin.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.countdown.min.js"></script>
			<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.countdown-zh-TW.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/arcticmodal/jquery.arcticmodal.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/twitter/jquery.tweet.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/colorpicker/colorpicker.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/retina.min.js"></script>
		<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js"></script>

		<!-- Theme files
		============================================ -->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/theme.plugins.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/theme.core.js"></script>
		
	</body>
</html>