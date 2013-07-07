<?php
/* @var $this AdsController */
/* @var $model PublishAdsForm */
/* @var $form TbActiveForm */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => PublishAdsForm::FORM_ID,
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('class'=>'well'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
echo $form->textFieldRow($model, 'title', array('class'=>'span8'));
echo $form->dropDownListRow($model, 'categories', CHtml::listData(Category::model()->findAll(), 'id', 'name'), array('multiple' => true));
?>
<div class="ads-publish-phone">
	<?php
	echo $form->textFieldRow($model, 'phone', array('class' => 'span3'));
	echo CHtml::button('Получить код', array('class' => 'btn btn-primary btn-get-code', 'data-loading-text' => 'Подождите...'));
	?>
</div>
<?php
echo $form->textFieldRow($model, 'smsCode', array('class' => 'span1'));
if (Yii::app()->user->isGuest)
{
	echo $form->textFieldRow($model, 'email', array('class' => 'span3'));
}
echo $form->ckEditorRow($model, 'description', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));
?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Сбросить')); ?>
</div>
<?php $this->endWidget(); ?>