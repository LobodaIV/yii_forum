<?php

/**
 * This is the model class for table "topics".
 *
 * The followings are the available columns in table 'topics':
 * @property integer $topic_id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $title
 * @property string $body
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Replies[] $replies
 * @property Users $user
 * @property Categories $category
 */
class Topic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'topics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, user_id, title, body', 'required'),
			array('category_id, user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('topic_id, category_id, user_id, title, body, create_date', 'safe', 'on'=>'search,insert'),
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
			'replies' => array(self::HAS_MANY, 'Reply', 'topic_id',),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'topic_id' => 'topic_id',
			'category_id' => 'category_id',
			'user_id' => 'user_id',
			'title' => 'title',
			'body' => 'body',
			'create_date' => 'create_date',
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

		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Topic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
