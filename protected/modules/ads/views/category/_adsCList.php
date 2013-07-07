<?php
/**
 * @var CActiveDataProvider $dataProvider
 */
?>
<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView' => '_adsItem',
	'ajaxUpdate'=>true, // отключаем ajax поведение
	'emptyText'=>'В данной категории нет объявлений.',
	'summaryText'=>"{start}&mdash;{end} из {count}",
	'pagerCssClass' => 'pagination',
	'template'=>'{summary} {sorter} {items} <hr> {pager}',
	'sorterHeader'=>'Сортировать по:',
	'sortableAttributes'=>array('title'),
	'htmlOptions' => array(
		'class' => 'list-view ads-list'
	),
	'pager'=>array(
		'class'=>'application.extensions.bootstrap.widgets.TbPager',
	),
));