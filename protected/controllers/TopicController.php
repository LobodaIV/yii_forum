<?php

class TopicController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',
				'actions'=>array('create','update, edit, reply, list, delete'),
				'users'=>array('?'),
				'deniedCallback'=> function() {
					Yii::app()->user->setFlash('authRequired',"Access Denied");
					$this->redirect(array("/site/login"));
				}
			),
			array('allow',
				'actions' => array('create','update, edit, reply, list, delete'),
				'users' => array('@'),
			),
			
		);

	}

	/**
	* Display a particular topic
	* @param integer $id the id of the topic to be displayed
	*/
	public function actionView($id) 
	{
		$mTopic = $this->loadModel($id);
		$mCategory = Category::model()->findAll();
		$mUser = $mTopic->user;

		$mReply = Reply::model();
		$cmd = Yii::app()->db->createCommand();
		$cmd->select('count(*) as itemCount, r.reply_id, r.topic_id')
		->from('replies r')
		->join('users u', 'r.user_id = u.id')
		->where('r.topic_id = ' . $id);
		$count = $cmd->queryAll();
		$count = (int)$count[0]['itemCount'];
		
		$pagination = new CPagination($count);
		$pagination->pageSize = 2;
		
		$cmd->reset();
		$cmd->select('r.reply_id,r.topic_id,u.username,u.avatar, r.body,r.create_date')
		->from('replies r')
		->join('users u','r.user_id = u.id')
		->having('r.topic_id = ' . $id)
		->order('r.create_date')
		->limit($pagination->limit, $pagination->offset);
		$replies = $cmd->queryAll();


		$this->render('topic', array(
			'topic' => $mTopic, 
			'categories' => $mCategory,
			'replies' => $replies,
			'mReply' => $mReply,
			'user' => $mUser,
			'pagination' => $pagination
			) 
		);
	}

	public function actionReply($id) 
	{

		$mTopic = $this->loadModel($id);
		$mCategory = Category::model();
		$mUser = $mTopic->user;
		$mReply = new Reply('insert');

		$cmd = Yii::app()->db->createCommand();
		$cmd->select('r.reply_id,r.topic_id,u.username,u.avatar, r.body,r.create_date')
		->from('replies r')
		->join('users u','r.user_id = u.id')
		->having('r.topic_id = ' . $id)
		->order('r.create_date');
		$replies = $cmd->queryAll();
		$replyModel = null;
		$required_fields = array("topic_id","user_id","body");

		if ($_POST) {

			foreach ($_POST as $key => $value) {
				if (in_array($key, $required_fields)) {
					$replyModel['Reply'][$key] = $value;
				}
			}

			$mReply->attributes = $replyModel['Reply'];
			if ($mReply->validate()) {
				$mReply->save();
				$this->redirect(array("/topic/view/" . $replyModel['Reply']['topic_id']));
			}
		}

		$this->render('topic', array(
			'topic' => $mTopic, 
			'categories' => $mCategory,
			'replies' => $replies,
			'mReply' => $mReply,
			'user' => $mUser
			) 
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionList()
	{
		$mCategory = Category::model()->findAll();
		$cmd = Yii::app()->db->createCommand();
		$cmd->select('t.topic_id,u.username,t.title,t.create_date,')
		->from('topics t')
		->join('users u','t.user_id = u.id');
		$mTopic = $cmd->queryAll();
		$this->render('list',array('topics'=>$mTopic,'categories' => $mCategory));	
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$mTopic = new Topic("insert");
		$mCategory = Category::model()->findAll();
		
		if ($_POST && isset($_POST['Topic'])) {
			$mTopic->attributes = $_POST['Topic'];
			if ($mTopic->save()) {
				Yii::app()->user->setFlash('success',"Topic has been created");
			}
		}

		$this->render('create', array('topic'=> $mTopic, 'categories' => $mCategory));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		if(isset($_POST['Topic']))
		{
			$id = (int)$_POST['Topic']['topic_id'];
			$mTopic=$this->loadModel($id);
			
			$mTopic->attributes=$_POST['Topic'];
			if($mTopic->save())
				$this->redirect(array("/topic/list"));
		}

		$this->render('edit',array(
			'model'=>$model,
		));
	}

	public function actionEdit($id) 
	{
		$mCategory = Category::model()->findAll();
		$mTopic = $this->loadModel($id)->findByPk($id);
		$this->render('edit', array('topic'=>$mTopic, 'categories' => $mCategory));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{

		if ($this->loadModel($id)->delete()) {
			Yii::app()->user->setFlash('success', "Topic has been deleted");
			$this->redirect('/topic/list');
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Topic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Topic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Topic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='topic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
