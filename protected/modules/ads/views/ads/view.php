<?php
/**
 * @var Ads $ads
 */
?>
<small><?=Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm',strtotime($ads->created_at))?>, <?=Yii::t('app', '{n} просмотр|{n} просмотра|{n} просмотров|{n} просмотра', $ads->views)?></small>
<div class="categories">
	<strong>Категории</strong>: <?=$ads->getCategories()?>
</div>
<div class="description">
	<h3>Описание</h3>
	<?=$ads->description?>
</div>