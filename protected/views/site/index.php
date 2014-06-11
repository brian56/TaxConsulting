<?php
/* @var $this SiteController */
if (Yii::app ()->user->getState ( 'isManager' ))
	$this->pageTitle = Yii::app ()->user->getState ( 'companyName' );
else 
	$this->pageTitle = Yii::app ()->name;

?>
<center>
	<h3>
		Welcome to <i>
		<?php 
			if (Yii::app()->user->getState('isManager')) {
				echo CHtml::encode(Yii::app()->user->getState('companyName',''));
			}
			else {
				echo CHtml::encode(Yii::app ()->name);
			}
		?>
		</i>
	</h3>

	<p>This page is for managing company's data.</p>
	
	
	<?php 
	 ?>
	<p></p>
	<?php 
		echo CHtml::textField('tripTotal','',array('size'=>60,'id' => 'push'));
		echo "<p></p>";
		$this->widget ( 'booster.widgets.TbButton', array (
				'label' => 'Push Notification to one device',
				'type' => 'info',
				'htmlOptions' => array(
            		'onclick' => "js:$.ajax({
	               		url: '".Yii::app()->baseUrl."/site/push',
	                	type: 'POST',
	                	data: 'data='+$('#push').val(),
	                	success: function(data) {
							if(data!='') 
								alert('Successfully');
							else 
								alert('Message can not be empty!');
	  					},
	           		});"
	        	)
	    	)
	    );
		echo "<p></p>";
		$this->widget ( 'booster.widgets.TbButton', array (
				'label' => 'Push Notification to many device',
				'type' => 'danger',
				'htmlOptions' => array(
            		'onclick' => "js:$.ajax({
	               		url: '".Yii::app()->baseUrl."/site/PushMultiDevice',
	                	type: 'POST',
	                	data: 'data='+$('#push').val(),
	                	success: function(data) {
							if(data!='') 
								alert('Successfully');
							else 
								alert('Message can not be empty!');
	  					},
           			});"
        		)
    		)
    	);
	?>
	
</center>