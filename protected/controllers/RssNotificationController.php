<?php

class RssNotificationController extends Controller
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
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionPushRSS() {
		$content = '';
		if(isset($_POST['company_id']) && $_POST['company_id']!=='')
		{
			$content = $_POST['data'];
			$message = 'testing';
			$push_tokens = array('APA91bF5RbiRiHEsVQv7Usj3LE82WQNULV2B6-Z36tYg8pR5zcZ7E5vUiKAC2iQaCJwT40s9ZyH8NNJ5HlG_XBvOPjohSRGTGIkz2b-XqwdmQWV1Cqy7GVZQZ4vWzT-4QnWbs0EmxObYoN4heIoMX2Mc9SG5z4ukWg','APA91bGtYCCfcNGvZb2uiabB5wOiy72TMIIjFSUOZJ8iJqDRHfj3n-426D2oGXqurTCvmGDFfrN-JFUVGYd31L6JJMRceD2SX4rrxoxnHaof6C55FAFHjfinVbagO4gpniMq1v7R72W2bwBt6rt-PpEbzu3cFfmhaQ');
			$gcm = Yii::app()->gcm;
			$gcm->sendMulti($push_tokens, $message, array('extra' => 'multi devices ', 'title'=> $content, 'value' =>''), array( 'delayWhileIdle' => true ));
		}
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RssNotification;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RssNotification']))
		{
			$model->attributes=$_POST['RssNotification'];
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

		if(isset($_POST['RssNotification']))
		{
			$model->attributes=$_POST['RssNotification'];
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
		$dataProvider=new CActiveDataProvider('RssNotification');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RssNotification('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RssNotification']))
			$model->attributes=$_GET['RssNotification'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RssNotification the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RssNotification::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RssNotification $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rss-notification-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	function strip_cdata($string)
	{    preg_match_all('/<!\[cdata\[(.*?)\]\]>/is', $string, $matches);
		  return str_replace($matches[0], $matches[1], $string);
	}
	public static function getAllFeeds()
	{
		$companies = Company::model()->getAllRssUrl();
		if(!is_null($companies)) {
			foreach ($companies as $company) {
				if($company->rss_url!='') {				
				$rawFeed = file_get_contents($company->rss_url);
				if($rawFeed!='') {
					// give an XML object to be iterate
					$xml = new SimpleXMLElement($rawFeed);
					$criteria = new CDbCriteria();
					$criteria->condition = 't.company_id=:company_id';
					$criteria->params = array(':company_id'=>$company->id);
					$rss_notification = RssNotification::model()->find($criteria);
					
					$post_pubDate = "";
					$post_url = "";
					$post_title = "";
					$data = '';
					foreach($xml->channel->item as $item)
					{
						$post_pubDate = $item->pubDate;
						$post_url = self::strip_cdata($item->link);
						$post_title = self::strip_cdata($item->title);
						if(strtotime($post_pubDate)>strtotime($rss_notification->last_post_pubDate)) {
							$data.= $post_pubDate;
							$data.= "\n";
							
							$info = new Info();
							$info->user_id = Yii::app()->user->getState('userId');
							$info->company_id = Yii::app()->user->getState('globalId');
							$info->access_level_id = 1;
							$info->info_type_id = 1;
							$info->title = $post_title; 
							$info->content = $post_url;
							$info->date_create = date('Y-m-d H:i:s', strtotime($post_pubDate));
							$info->save();
						}
					}
					//update the last post date time to now
					RssNotification::model ()->updateByPk ( $rss_notification->id, array (
						'last_post_pubDate' => date('Y-m-d H:i:s')
					) );
					echo $data;
					}
				}
			}
		}
	}
// 	public static function getFeeds($rssUrl='')
	public static function getFeeds()
	{
		$rssUrl = Yii::app()->user->getState('rss_url');
		$rawFeed = file_get_contents($rssUrl);
		if($rawFeed!='') {
			// give an XML object to be iterate
			$xml = new SimpleXMLElement($rawFeed);
			$criteria = new CDbCriteria();
			$criteria->condition = 't.company_id=:company_id';
			$criteria->params = array(':company_id'=>Yii::app()->user->getState('globalId'));
			$rss_notification = RssNotification::model()->find($criteria);
			
			$post_pubDate = "";
			$post_url = "";
			$post_title = "";
			$data = '';
			foreach($xml->channel->item as $item)
			{
				$post_pubDate = $item->pubDate;
				$post_url = self::strip_cdata($item->link);
				$post_title = self::strip_cdata($item->title);
				if(strtotime($post_pubDate)>strtotime($rss_notification->last_post_pubDate)) {
					$data.= $post_pubDate;
					$data.= "\n";
					
					$info = new Info();
					$info->user_id = Yii::app()->user->getState('userId');
					$info->company_id = Yii::app()->user->getState('globalId');
					$info->access_level_id = 1;
					$info->info_type_id = 2;
					$info->title = $post_title; 
					$info->content = $post_url;
					$info->date_create = date('Y-m-d H:i:s', strtotime($post_pubDate));
					$info->save();
				}
			}
			//update the last post date time to now
			RssNotification::model ()->updateByPk ( $rss_notification->id, array (
				'last_post_pubDate' => date('Y-m-d H:i:s')
			) );
			echo $data;
		}
	}
	
	public function run()
	{
		if($this->checkConnection())
			echo $feeds = $this->getFeeds();
	}
	
	/** check if the pc is connected to internet
	 * @return TRUE if there is a connection
	 */
	private function checkConnection()
	{
		// Initiates a socket connection to www.google.com at port 80
		$conn = @fsockopen("www.google.com", 80);
		if($conn)
		{
			// there is a connection
			fclose($conn);
			return TRUE;
		}
	
		return FALSE;
	}
}
