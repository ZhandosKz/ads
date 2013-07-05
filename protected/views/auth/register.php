<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'registration_form',
	'enableClientValidation'=>true,
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('class'=>'well'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'passwordConfirm', array('class'=>'span3')); ?>
<?php echo $form->checkboxRow($model, 'acceptRules'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Регистрация')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Сбросить')); ?>
</div>
<?php $this->endWidget();?>