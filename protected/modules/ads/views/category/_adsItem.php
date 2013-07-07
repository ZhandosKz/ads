<?php
/**
 * @var Ads $data
 */
?>

<h4><?=CHtml::link($data->title, array('/ads/ads/view', 'alias' => $data->alias))?></h4>
<small><?=Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm',strtotime($data->created_at))?>, <?=Yii::t('app', '{n} просмотр|{n} просмотра|{n} просмотров|{n} просмотра', $data->views)?></small>
<div class="categories">
	<strong>Категории</strong>: <?=$data->getCategories()?>
</div>
<div class="description">
	<?php StringManipulation::truncate($data->description, 200) ?>
	<?=CHtml::link('Подробнее', array('/ads/ads/view', 'alias' => $data->alias))?>
</div>
<hr/>