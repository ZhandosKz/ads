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

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#"><?=Yii::app()->name?></a>
		</div>
	</div>
</div>

<div class="container">
	<h1><?=$this->pageTitle?></h1>
	<?=$content?>
</div> <!-- /container -->
</body>
</html>