<?php
/* @var $this SiteController */
if (Yii::app ()->user->getState ( 'isManager' ))
	$this->pageTitle = Yii::app ()->user->getState ( 'companyName' );
else 
	$this->pageTitle = Yii::app ()->name;


?>
<center>
<?php $this->widget('ext.LangPick.ELangPick', array(
	    //'excludeFromList' => array('pl', 'en'), // list of languages to exclude from list
	    'pickerType' => 'dropdown',              // buttons, links, dropdown
	    //'linksSeparator' => '<b> | </b>',   // if picker type is set to 'links'
	    'buttonsSize' => 'small',                // mini, small, large
	    'buttonsColor' => 'primary',            // primary, info, success, warning, danger, inverse
	)); ?>
	<br>	
	<br>
	<br>	
	<h2>
		<?php echo Yii::t('strings','Welcome to');?> <i>
		<?php 
			if (Yii::app()->user->getState('isManager')) {
				echo CHtml::encode(Yii::app()->user->getState('globalName'));
			}
			else {
				echo CHtml::encode(Yii::app ()->name);
			}
		?>
		</i>
	</h2>

	<h4><?php echo Yii::t('strings',"This page is for managing tax consulting company's data.");?></h4>
	<br>
	<br>
	<?php 
	if(!Yii::app()->user->isGuest && Yii::app()->user->getState('isManager')) {
		echo "<p></p>";
		$this->widget ( 'booster.widgets.TbButton', array (
				'label' => 'Check for RSS new post',
				'context' => 'danger',
				'htmlOptions' => array(
						'onclick' => "js:$.ajax({
		               		url: '".Yii::app()->baseUrl."/rssNotification/getFeeds',
		                	success: function(data) {
								if(data!='')
									alert(data);
								else
									alert('No RSS found!');
		  					},
	           			});"
				)
		)
		);
	}
	echo "<br>";
	echo "<br>";
	$this->widget('ext.EFullCalendar.EFullCalendar', array(
			// polish version available, uncomment to use it
			'lang'=>'en',
			// you can create your own translation by copying locale/pl.php
			// and customizing it
	
			// remove to use without theme
			// this is relative path to:
			// themes/<path>
			'themeCssFile'=>'cupertino/theme.css',
	
			// raw html tags
			'htmlOptions'=>array(
					// you can scale it down as well, try 80%
					'style'=>'width:70%'
			),
			// FullCalendar's options.
			// Documentation available at
			// http://arshaw.com/fullcalendar/docs/
			'options'=>array(
					'header'=>array(
							'left'=>'prev,next',
							'center'=>'title',
							'right'=>'today'
					),
					'lazyFetching'=>true,
					//'events'=>$calendarEventsUrl, // action URL for dynamic events, or
					'events'=>Reminder::model()->getCompanyRemindersForDisplaying(Yii::app()->user->getState('globalId')), // pass array of events directly
	
					// event handling
					// mouseover for example
					//'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
					'dayClick'=>'js:function(dayClick){
						var dayInSecond = (dayClick.getTime()/1000);
                       	window.location.href = "manager/reminder/default/create?day="+dayInSecond
                    }',
			)
	));
	?>
	<br>
	<br>
	<br>
	<br>
	<iframe src="https://www.google.com/calendar/embed?src=duongqhuynh%40gmail.com&ctz=Asia/Saigon" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
	<br>
	<br>
	<h5><?php echo Yii::t('strings','A tax consulting company application developed by');?></h5>
	<?php 
	echo CHtml::image('http://appromobile.com/wp-content/uploads/2013/06/cropped-Logo.png');
// 		echo CHtml::textField('tripTotal','',array('size'=>60,'id' => 'push'));
// 		echo "<p></p>";
// 		$this->widget ( 'booster.widgets.TbButton', array (
// 				'label' => 'Push Notification to one device',
// 				'type' => 'info',
// 				'htmlOptions' => array(
//             		'onclick' => "js:$.ajax({
// 	               		url: '".Yii::app()->baseUrl."/site/push',
// 	                	type: 'POST',
// 	                	data: 'data='+$('#push').val(),
// 	                	success: function(data) {
// 							if(data!='') 
// 								alert('Successfully');
// 							else 
// 								alert('Message can not be empty!');
// 	  					},
// 	           		});"
// 	        	)
// 	    	)
// 	    );
// 		echo "<p></p>";
// 		$this->widget ( 'booster.widgets.TbButton', array (
// 				'label' => 'Push Notification to many device',
// 				'type' => 'danger',
// 				'htmlOptions' => array(
//             		'onclick' => "js:$.ajax({
// 	               		url: '".Yii::app()->baseUrl."/site/PushMultiDevice',
// 	                	type: 'POST',
// 	                	data: 'data='+$('#push').val(),
// 	                	success: function(data) {
// 							if(data!='') 
// 								alert('Successfully');
// 							else 
// 								alert('Message can not be empty!');
// 	  					},
//            		});"
//         		)
//     		)
//     	);
	?>
	
</center>