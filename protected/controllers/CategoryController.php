<?php

class CategoryController extends Controller
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
			array(
				'allow', 
				'actions'=>array('index,view'),
				'users'=>array('*'),
			),
			array(
				'allow',
				'actions' => array('delete,create'),
				'users' => array('@'),
			),
			array(
				'deny',
				'actions' => array('delete,create'),
				'users'=> array('?'),
			)
		);
	}

	public function actionIndex()
	{
		$mCategory = Category::model()->findAll();
		$this->render('index', array('categories' => $mCategory));
	}

	public function actionView($slug) 
	{
		$mCategory = Category::model()->findAll();
		$mUser = new User;
		$cmd = Yii::app()->db->createCommand();
		$cmd->select("c.name as category_name, c.slug as category_slug, u.name as username, u.avatar, t.topic_id, t.title")
		->from("categories c")
		->join("topics t","c.category_id = t.category_id")
		->join("users u", "t.user_id = u.id")
		->where("c.slug = :slug", array(":slug" => $slug));

		$topicsCategory = $cmd->queryAll();
		$this->render("topics", array("topicsInCategory" => $topicsCategory, 
			"categories"=>$mCategory, 'slug'=>$slug, 'user' => $mUser));
	}

	public function actionDelete($slug) 
	{
		if (!empty($slug)) {
			$this->loadModel($slug)->delete();
			$this->redirect(array('/category'));
		} else {
			$this->redirect(array('/category'));
		}
	}

	public function actionCreate() 
	{
		$categories = Category::model()->findAll();
		$mCategory = new Category('insert');
		//$this->performAjaxValidation($mCategory);

		if ($_POST['Category']) {

			$mCategory->attributes = $_POST['Category'];

			if ($mCategory->validate()) {
				$mCategory->save();
				echo CJSON::encode(array('status'=>'success'));
				Yii::app()->end();

			} else {
				$err = CActiveForm::validate($mCategory);
				if ($err != '[]') {
					echo CJSON::encode($err);
				}
				Yii::app()->end();
			}
		}

		if(Yii::app()->request->getRequestType() == "GET" and Yii::app()->user->isGuest) {
			Yii::app()->user->setFlash('authRequired',"Please go through authentication");
			$this->redirect('/site/login');
		}

		$this->render('create',array('category' => $mCategory, 'categories'=> $categories));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Topic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($slug)
	{
		$model=Category::model()->findByAttributes(array("slug" => $slug));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}