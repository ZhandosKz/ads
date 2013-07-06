<?php $this->widget('bootstrap.widgets.TbJsonGridView', array(
	'dataProvider' => $model->search(),
	'type' => 'striped bordered condensed',
	'summaryText' => false,
	'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
	'cacheTTLType' => 's', // type can be of seconds, minutes or hours
	'columns' => array(
		'id',
		'title',
		'is_published',
		array(
			'header' => Yii::t('ses', 'Операции'),
			'class' => 'bootstrap.widgets.TbJsonButtonColumn',
			'template' => '{update} {view} {delete}',
		),
	),
)); ?>