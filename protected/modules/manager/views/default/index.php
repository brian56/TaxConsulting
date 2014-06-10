<?php
/* @var $this DefaultController */
$this->breadcrumbs=array(
	$this->module->id,
); ?>
<h4> Manage page for managing company's information</h4>
<?php 
		echo CHtml::link("- Manager infos",Yii::app()->baseUrl."/manager/info/default/admin",array("style"=>"color: darkblue;"));
		echo "<p></p>";
		echo CHtml::link("- Manager users",Yii::app()->baseUrl."/manager/user/default/admin",array("style"=>"color: darkblue;"));
		echo "<p></p>";
		echo CHtml::link("- Log events",Yii::app()->baseUrl."/manager/infotype/default/admin",array("style"=>"color: darkblue;"));
?>