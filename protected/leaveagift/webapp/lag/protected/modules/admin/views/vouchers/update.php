<?php
$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	$model->voucher_code=>array('view','id'=>$model->voucher_code),
	'Update',
);

?>

<h1>Update Vouchers <?php echo $model->voucher_code; ?></h1>
<hr/>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
                array('label'=>'Update', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->voucher_code)),'active'=>true, 'linkOptions'=>array()),
                array('label'=>'Import', 'icon'=>'icon-upload', 'url'=>Yii::app()->controller->createUrl('Excelimport')),
	),
));
$this->endWidget();
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
