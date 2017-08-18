<?php

class SiteController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($authErrors = null)
	{	

		//Fetch all categories
		$cmd = Yii::app()->db->createCommand();
		$cmd->select('*')->from('categories');
		$categories = $cmd->queryAll();

		$cmd->reset();
		//Pagination
		$cmd->select('count(*) as itemCount')
		->from('topics t')
		->join('categories c','t.category_id = c.category_id')
		->join('users u', 't.user_id = u.id');
		$count = $cmd->queryAll();
		$count = (int)$count[0]['itemCount'];
		$pagination = new CPagination($count);
		$pagination->pageSize = 4;

		$cmd->reset();
		//Fetch topics in category
		$cmd->select("t.topic_id,t.title as topic_title, t.create_date, c.category_id as category_id, c.name as category_name, u.name as username, u.avatar")
		->from("topics t")
		->join("categories c","t.category_id = c.category_id")
		->join("users u", "t.user_id = u.id")
		->limit($pagination->limit,$pagination->offset);
		$topics = $cmd->queryAll();

		$cmd->reset();
		//Get replies in topic
		$cmd->select('count(r.reply_id) as replies_in_topic, t.title as topic_title')
		->from('replies r, topics t')
		->where('r.topic_id = t.topic_id')
		->group('r.topic_id');
		$replies = $cmd->queryAll();


		$user = new User();

		if ( (isset($authErrors)) && (!empty($authErrors)) )  {
			$user->addErrors($authErrors);
		}

		$this->render('index',array(
			'categories' => $categories, 
			'topics' => $topics, 
			'replies' => $replies,
			'user' => $user,
			'pagination' => $pagination
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$errText = "";
		$user = new User('search');

		if (isset($_POST['User'])) {
		
			//var_dump($_POST['User']['username']);
			//die();
			$user->attributes = $_POST['User'];

			if ($user->validate()) {

				$identity = new UserIdentity($user->username,$user->password);

				if ( ($identity->authenticate() ) && (Yii::app()->user->login($identity))) {
					
					$userAttrs = $user->findByAttributes(array( 'username' => $_POST['User']['username']))->getAttributes(array('name','about','email'));
					
					foreach($userAttrs as $key=>$attr) {
						Yii::app()->user->setState($key,$attr);
					}
					
					$this->redirect(array("site/index"));

				} else {
					//In case either user or password are not exist
					if ($identity->getErrorCode()) {
						$this->actionIndex(
							array(
							"username" => "Password or Login incorrect",
							"password" => "Password or Login incorrect"
							));
					}
				}
				

			} else {
				//In case form is empty
				$authErrors = $user->getErrors();
				$this->actionIndex($authErrors);

			}
		}

		if ( Yii::app()->request->getRequestType() == "GET") {
			$this->actionIndex();
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}