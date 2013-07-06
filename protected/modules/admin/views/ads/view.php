<?php
/* @var $this CategoryController */
/* @var $data Ads */
?>
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => $this->getPageTitle(),
	'headerIcon' => 'icon-eye-open',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
	<table class="table table-bordered">
		<tr>
			<td><strong><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></strong></td>
			<td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></td>
		</tr>
		<tr>
			<td><strong><?php echo CHtml::encode($data->getAttributeLabel('title')); ?></strong></td>
			<td><?php echo CHtml::encode($data->title); ?></td>
		</tr>
		<tr>
			<td><strong><?php echo CHtml::encode($data->getAttributeLabel('categories')); ?></strong></td>
			<td><?php echo implode(', ', CHtml::listData($data->categories, 'id', 'name')); ?></td>
		</tr>
		<tr>
			<td><strong><?php echo CHtml::encode($data->getAttributeLabel('description')); ?></strong></td>
			<td><?php echo $data->description; ?></td>
		</tr>
	</table>
<?php $this->endWidget()?>