<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=Yii::app()->name?> <?=$this->pageTitle?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

</head>

<body>
<?php $this->renderPartial('//layouts/parts/header')?>
<div class="container">

	<?php
	$this->widget('bootstrap.widgets.TbTabs', array(
		'type' => 'tabs',
		'placement' => 'left',
		'tabs' => Category::getMenuItems(),
		'htmlOptions' => array(
			'class' => 'category-menu'
		)
	));
	?>
	<div class="main-content">
		<h1><?=$this->pageTitle?></h1>
		<?php
		$this->widget('application.widgets.ExtendedTbAlert', array(
			'block'=>true, // display a larger alert block?
			'fade'=>true, // use transitions?
			'closeText'=>'×', // close link text - if set to false, no close link is displayed
			'alerts'=>array( // configurations per alert type
				'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
				'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
				'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
			),
		));
		echo $content
		?>
	</div>
</div> <!-- /container -->
</body>
</html>