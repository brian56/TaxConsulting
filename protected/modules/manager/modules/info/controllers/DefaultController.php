<?php

class DefaultController extends Controller
{
/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl',
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('advanceManage', 'create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'AjaxIndex', 'question', 'taxInfo', 'notice', 'AjaxQuestion'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('answerCreate', 'trackingQuestion', 'question', 'questionCreate', 'questionUpdate', 'questionView', 'AjaxQuestion'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('answerCreate', 'trackingIndividualPage', 'individualPage', 'individualPageCreate', 'individualPageUpdate', 'individualPageView', 'AjaxIndividualPage'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('taxInfo', 'taxInfoCreate', 'taxInfoView', 'taxInfoUpdate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('notice', 'noticeCreate', 'noticeView', 'noticeUpdate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('trackingAppointment','ajaxAppointment', 'appointment', 'appointmentCreate', 'appointmentView', 'appointmentUpdate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('trackingVisitorComment','ajaxVisitorComment', 'visitorComment', 'visitorCommentCreate', 'visitorCommentView', 'visitorCommentUpdate'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
		$this->getViewPath();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Info;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_create=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 't.company_id=:company_id';
		$criteria->order = 'date_create DESC';
		$criteria->params = array(':company_id'=>Yii::app()->user->getState('companyId'));
		$dataProvider=new CActiveDataProvider('Info', array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Info the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Info::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Info $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionAjaxIndex()
	{
		$model =new Info();
		$model->unsetAttributes();  // clear any default values
	
		//print_r($model);
		$this->renderPartial('_ajaxIndex', array('model'=>$model));
	}
	
	//------------------question actions--------------------------------//
	public function actionAjaxQuestion()
	{
		$model =new Info();
		$model->unsetAttributes();  // clear any default values
	
		//print_r($model);
		$this->renderPartial('_ajaxQuestion', array('model'=>$model));
	}
	public function actionQuestion()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('question',array(
				'model'=>$model,
		));
	}
	public function actionTrackingQuestion()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('trackingQuestion',array(
				'model'=>$model,
		));
	}
	public function actionQuestionCreate()
	{
		$model=new Info;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_create=new CDbExpression('now()');
			$model->info_type_id = 3;
			if($model->save())
				$this->redirect(array('questionView','id'=>$model->id));
		}
	
		$this->render('question_create',array(
				'model'=>$model,
		));
	}
	
	
	//=================controller tao cau tra loi ========================//
	public function actionAnswerCreate()
	{
		
		$model=new InfoComment;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['InfoComment']))
		{
			$model->attributes=$_POST['InfoComment'];
			if($model->save())
				$this->redirect(array('questionView','id'=>$model->info_id));
		}
	}
	
	public function actionQuestionUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('questionView','id'=>$model->id));
		}
	
		$this->render('question_update',array(
				'model'=>$model,
		));
	}
	public function actionQuestionView($id)
	{
		$this->render('question_view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	//-----------------------taxInfo actions---------------------//
	public function actionTaxInfo()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('taxInfo',array(
				'model'=>$model,
		));
	}
	public function actionTaxInfoCreate()
	{
		$model=new Info;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_create=new CDbExpression('now()');
			$model->info_type_id = 2;
			if($model->save())
				$this->redirect(array('taxInfoView','id'=>$model->id));
		}
	
		$this->render('taxInfo_create',array(
				'model'=>$model,
		));
	}
	public function actionTaxInfoUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('taxInfoView','id'=>$model->id));
		}
	
		$this->render('taxInfo_update',array(
				'model'=>$model,
		));
	}
	public function actionTaxInfoView($id)
	{
		$this->render('taxInfo_view',array(
				'model'=>$this->loadModel($id),
		));
	}
	//--------------------------notice actions------------------------//
	public function actionNotice()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('notice',array(
				'model'=>$model,
		));
	}
	public function actionNoticeCreate()
	{
		$model=new Info;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_create=new CDbExpression('now()');
			$model->info_type_id = 1;
			if($model->save())
				$this->redirect(array('noticeView','id'=>$model->id));
		}
	
		$this->render('notice_create',array(
				'model'=>$model,
		));
	}
	public function actionNoticeUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('noticeView','id'=>$model->id));
		}
	
		$this->render('notice_update',array(
				'model'=>$model,
		));
	}
	public function actionNoticeView($id)
	{
		$this->render('notice_view',array(
				'model'=>$this->loadModel($id),
		));
	}
	//--------------------------appointment actions------------------------//
	public function actionAjaxAppointment()
	{
		$model =new Info();
		$model->unsetAttributes();  // clear any default values
	
		//print_r($model);
		$this->renderPartial('_ajaxAppointment', array('model'=>$model));
	}
	public function actionAppointment()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
		//var_dump($this->getViewPath().'appointment');
		//die();
		//$this->render($this->getViewPath().'appointment',array(
		$this->render('appointment',array(
				'model'=>$model,
		));
	}
	public function actionTrackingAppointment()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('trackingAppointment',array(
				'model'=>$model,
		));
	}
	
	//log ra o cai controller ni
	public function actionAppointmentCreate()
	{
		$info=new Info;
		$user=new User;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		
	
		if(isset($_POST['Info'])&& isset($_POST['User']))
		{
			$info->attributes=$_POST['Info'];
			$info->info_type_id = 4;
			$info->date_create=new CDbExpression('now()');
			$user->attributes = $_POST['User'];
			if(isset($user->contact_phone) && $user->contact_phone!='') {
				User::model()->updateByPk($info->user_id, array('contact_phone'=>$user->contact_phone));
			}
			//$model->appointment_date = $_POST['Info']['appointment_date'];
// 			echo "<pre>";
// 			print_r($model->attributes);
// 			echo "</pre>";
// 			die();
			if($info->save())
				$this->redirect(array('appointmentView','id'=>$info->id));
		}
	
		$this->render('appointment_create',array(
				'info'=>$info, 'user' => $user,
		));
	}
	public function actionAppointmentUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save()) {
				if($model->appointment_status==1) {
					$userDeviceId = $model->user->device_id;
					$title = 'Your appointment has been confirmed.';
					SendIndividualPage::actionPushOneDevice($userDeviceId,$title, $model->title, $model->info_type_id, $model->id);
				}
				if($model->appointment_status==-1) {
					$userDeviceId = $model->user->device_id;
					$title = 'Your appointment has been rejected.';
					SendIndividualPage::actionPushOneDevice($userDeviceId,$title, $model->title, $model->info_type_id, $model->id);
				}
				$this->redirect(array('appointmentView','id'=>$model->id));
			}
		}
	
		$this->render('appointment_update',array(
				'model'=>$model,
		));
	}
	public function actionAppointmentView($id)
	{
		$this->render('appointment_view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	//--------------------------appointment actions------------------------//
	public function actionAjaxVisitorComment()
	{
		$model =new Info();
		$model->unsetAttributes();  // clear any default values
	
		//print_r($model);
		$this->renderPartial('_ajaxVisitorComment', array('model'=>$model));
	}
	public function actionVisitorComment()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('visitorComment',array(
				'model'=>$model,
		));
	}
	public function actionTrackingVisitorComment()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('trackingVisitorComment',array(
				'model'=>$model,
		));
	}
	public function actionVisitorCommentCreate()
	{
		$model=new Info;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_create=new CDbExpression('now()');
			$model->info_type_id = 5;
			if($model->save())
				$this->redirect(array('VisitorCommentView','id'=>$model->id));
		}
	
		$this->render('visitorComment_create',array(
				'model'=>$model,
		));
	}
	public function actionVisitorCommentUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('visitorCommentView','id'=>$model->id));
		}
	
		$this->render('visitorComment_update',array(
				'model'=>$model,
		));
	}
	public function actionVisitorCommentView($id)
	{
		$this->render('visitorComment_view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	
	//------------------individualPage actions--------------------------------//
	public function actionAjaxIndividualPage()
	{
		$model =new Info();
		$model->unsetAttributes();  // clear any default values
	
		//print_r($model);
		$this->renderPartial('_ajaxIndividualPage', array('model'=>$model));
	}
	public function actionIndividualPage()
	{
		$model=new Info('individualPage');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('individualPage',array(
				'model'=>$model,
		));
	}
	public function actionTrackingIndividualPage()
	{
		$model=new Info('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Info']))
			$model->attributes=$_GET['Info'];
	
		$this->render('trackingIndividualPage',array(
				'model'=>$model,
		));
	}
	public function actionIndividualPageCreate()
	{
		$model=new Info;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_create=new CDbExpression('now()');
			$model->info_type_id = 3;
			$model->access_level_id = 2;
			if($model->save())
				$this->redirect(array('individualPageView','id'=>$model->id));
		}
	
		$this->render('individualPage_create',array(
				'model'=>$model,
		));
	}
	
	
	//=================controller tao cau tra loi ========================//
// 	public function actionAnswerCreate()
// 	{
	
// 		$model=new InfoComment;
	
// 		// Uncomment the following line if AJAX validation is needed
// 		// $this->performAjaxValidation($model);
	
// 		if(isset($_POST['InfoComment']))
// 		{
// 			$model->attributes=$_POST['InfoComment'];
// 			if($model->save())
// 				$this->redirect(array('individualPageView','id'=>$model->info_id));
// 		}
// 	}
	
	public function actionIndividualPageUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Info']))
		{
			$model->attributes=$_POST['Info'];
			$model->date_update=new CDbExpression('now()');
			if($model->save())
				$this->redirect(array('individualPageView','id'=>$model->id));
		}
	
		$this->render('individualPage_update',array(
				'model'=>$model,
		));
	}
	public function actionIndividualPageView($id)
	{
		$this->render('individualPage_view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	
	public function actionAdvanceManage()
	{
		$this->render('advanceManage');
	}
}
	