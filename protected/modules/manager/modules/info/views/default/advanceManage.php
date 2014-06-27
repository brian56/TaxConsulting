<?php
echo CHtml::link ( Yii::t ( 'strings', "Manage User" ), Yii::app ()->baseUrl . "/manager/user/default/admin", array (
		"style" => "color: darkblue;" 
) );
echo "<p></p>";
echo CHtml::link ( Yii::t ( 'strings', "Log Events" ), Yii::app ()->baseUrl . "/manager/logevent/default/index", array (
		"style" => "color: darkblue;" 
) );
?>