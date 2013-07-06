<?php
/* @var $this CategoryController */
/* @var $data Category */
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
			<td><strong><?php echo CHtml::encode($data->getAttributeLabel('name')); ?></strong></td>
			<td><?php echo CHtml::encode($data->name); ?></td>
		</tr>
		<tr>
			<td><strong><?php echo CHtml::encode($data->getAttributeLabel('description')); ?></strong></td>
			<td><?php echo $data->description; ?></td>
		</tr>
	</table>
<?php $this->endWidget()?>