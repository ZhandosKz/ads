<?php
/* @var $this AdsController */
/* @var $model Ads */
/* @var $form TbActiveForm */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ads_form',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('class'=>'well'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
echo $form->textFieldRow($model, 'title', array('class'=>'span8'));
echo $form->checkBoxRow($model, 'is_published');
echo $form->dropDownListRow($model, 'categories', CHtml::listData(Category::model()->findAll(), 'id', 'name'), array('multiple' => true));
echo $form->ckEditorRow($model, 'description', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Сбросить')); ?>
</div>
<?php $this->endWidget(); ?>
