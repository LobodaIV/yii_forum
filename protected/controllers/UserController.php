<?php

class UserController extends Controller {

	public function filters() {
		return array('accessControl');
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('new'),
				'users' => array('?')
			),
			array('allow',
				'actions' => array('index','edit','create','update','delete'),
				'users' => array('@'),
				),
			array('deny'),
		);
	}

	public function actionIndex() {
		$mUser = User::model()->findAll();
		$mCategories = Category::model()->findAll();
		$this->render('index', array('users' => $mUser, 'categories' => $mCategories));
	}

	public function actionEdit($id) {

		$mUser = $this->loadModel($id);
		$mCategory = Category::model()->findAll();

		if($_POST['User']) {
			
			$avatar = CUploadedFile::getInstance($mUser,"avatar");
			if($avatar) {
				$photo = CUploadedFile::getInstance($mUser,"avatar");
				$dir = dirname(__DIR__).'/../themes/forum/images/avatars/';
				$avatar = $photo->getName();
				$photo->saveAs($dir.$avatar,true);
				$_POST['User']['avatar'] = $avatar;
			} else {
				$avatar = "default.png";
				$_POST['User']['avatar'] = $avatar;
			}

			if (empty($_POST['User']['password'])) {
				$_POST['User']['password'] = $mUser->password;
			} else {
				$_POST['User']['password'] = $mUser::hashPassword($_POST['User']['password']);
			}
			
			if($mUser->validate()) {
				$mUser->updateByPk($id, $_POST['User']);
				Yii::app()->user->setFlash('success','User settings updated');
			} else {
				$mUser->getErrors();
			}
		}

		$this->render('edit',array("user"=>$mUser,"categories" => $mCategory));
	}

	public function actionCreate() {
		
		$required_fields = array("name","email","avatar","username","password","role");
		$mUser = new User();
		$category = Category::model()->findALl();
		$userModel = null;
		$ava = null;

		if ($_POST) {
			
			foreach ($_POST as $key => $value) {
				if (in_array($key, $required_fields)) {
					$userModel['User'][$key] = $value;
				}
			}

			$avatar = CUploadedFile::getInstanceByName("avatar");
			$dir = dirname(__DIR__).'/../themes/forum/images/avatars/';
			//check if avatar is empty
			if ($avatar) {
				$ava = $avatar->getName();
				$avatar->saveAs($dir.$ava,true);
			} else {
				$ava = "default.png";
			}
			
			$userModel['User']['password'] = $mUser::hashPassword($userModel['User']['password']);
			$userModel['User']['avatar'] = $ava;
			//var_dump($userModel);
			//die();
			$mUser->setAttributes($userModel['User']);
			if ($mUser->validate()) {
				$mUser->save();
				Yii::app()->user->setFlash('success','User has been created');
				$this->redirect(array("/user/create"));
			}
		} 

		$this->render('create',array('user'=>$mUser, 'categories' => $category));
	}

	public function actionNew()
	{
		$categories = Category::model()->findAll();
		$mUser = new User('register');
		$ava = null;

		if($_POST['User']) {

			$avatar = CUploadedFile::getInstanceByName("User[avatar]");
			$dir = dirname(__DIR__).'/../themes/forum/images/avatars/';

			if ($avatar) {
				$ava = $avatar->getName();
				$avatar->saveAs($dir.$ava,true);
			} else {
				$ava = "default.png";
			}
			
			$_POST['User']['password'] = $mUser::hashPassword($_POST['User']['password']);
			$_POST['User']['password2'] = $_POST['User']['password'];

			$mUser->attributes = $_POST['User'];

			if($mUser->validate()) {
				$mUser->save();
				$this->render("/user/new_created", array('categories' => $categories, 'user' => $mUser));
			}
		} else {
			$this->render('new',array('categories' => $categories, 'user' => $mUser));
		}
	}

	public function actionDelete($id) {
		$mUser = $this->loadModel($id);
		if( $mUser->delete() ) {
			Yii::app()->user->setFlash("success", 'User has been deleted');
			$this->redirect('/users');
		}
	}

	public function loadModel($id) {
		$model = User::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404,"The requested page does not exist");
		}
		return $model;
	}
}