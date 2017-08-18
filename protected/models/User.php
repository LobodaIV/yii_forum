<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $avatar
 * @property string $username
 * @property string $password
 * @property string $about
 * @property string $join_date
 * @property string $role
 *
 * The followings are the available model relations:
 * @property Replies[] $replies
 * @property Topics[] $topics
 */
class User extends CActiveRecord
{
	public $password2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('name, email, avatar', 'length', 'max'=>100),
			array('username', 'length', 'max'=>20),
			array('password', 'length', 'max'=>64),	
			array('password2', 'compare', 'compareAttribute' => 'password', 'on' => 'register'),
			array('role', 'length', 'max'=>1),
			array('avatar','file','maxSize' => 500000, 'types'=>"jpg,png", "allowEmpty"=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, email, username, password', 'safe', 'on'=>'search'),
			array('name,username,email,password,role', 'required', 'on'=> 'insert,update')
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'replies' => array(self::HAS_MANY, 'Replies', 'user_id'),
			'topics' => array(self::HAS_MANY, 'Topics', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'avatar' => 'Avatar',
			'username' => 'Username',
			'password' => 'Password',
			'password2' => "Confirm password",
			'about' => 'About',
			'join_date' => 'Join Date',
			'role' => 'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('join_date',$this->join_date,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	* Password validation functions
	*/
	public function validatePassword($password) 
	{
		return CPasswordHelper::verifyPassword($password, $this->password);
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

}
