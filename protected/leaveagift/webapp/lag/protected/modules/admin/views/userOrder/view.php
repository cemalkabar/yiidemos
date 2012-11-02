<?php
$this->breadcrumbs=array(
	'User Orders'=>array('index'),
	$model->title,
);
?>

<h1>View UserOrder #<?php echo $model->id_user_gift; ?></h1>
<hr />
<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		//array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
                //array('label'=>'Update', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id_user_gift)), 'linkOptions'=>array()),
		//array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Print', 'icon'=>'icon-print', 'url'=>'javascript:void(0);return false', 'linkOptions'=>array('onclick'=>'printDiv();return false;')),

)));
$this->endWidget();
?>
<?php

$isReturnGift= isset($model->thankyouid)?'YES':'NO';
?>
<div class='printableArea'>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_user_gift',
                'order_status',
		//'id_cart',
		array(
                      'name'=>'Product',
                      'value'=>$model->product->tags[0]->name, 
                     ),
                array(
                        'name'=>'Ordered by',
                         'type'=>'html',
                        'value'=>CHtml::image("https://graph.facebook.com/".$model->sender->facebook_userid."/picture?width=75&height=70&return_ssl_results=1","",array("style"=>"width:25px;height:25px;")).$model->sender->name,
                       ),
                array(
                        'name'=>'Receiver',
                         'type'=>'html',
                        'value'=>CHtml::image("https://graph.facebook.com/".$model->receiver_fbid."/picture?width=75&height=70&return_ssl_results=1","",array("style"=>"width:25px;height:25px;")).$model->receiver_fbfirstname,
                       ),
		//'receiver_fbfirstname',
		'receiver_fbemail',
		'notify_email',
		//'img_url',
		array('name'=>'message_card','type'=>'html','value'=>$model->message_card),
		'message_post',
		'title',
		//'delivery_date',
                 array(
                        'name'=>'delivery date',
                        'value'=>(isset($model->delivery_date))?date("M-d-Y",strtotime($model->delivery_date)):"Pending",
                      ),  
		//'greeting',
		//'gift_opened',
		//'gift_rating',
		//'facebook_postid',
		//'post_email_status',
		array(
                     'name'=>'is return gift?',
                     'value'=>$isReturnGift,
                     ),
		'date_add',
		'date_upd',
	),
)); ?>
</div>
<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
