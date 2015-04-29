<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $role
 * @property string $date_added
 * @property integer $university_id
 */
class User extends CActiveRecord
{
	public $repeat_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, firstname, lastname, role, date_added, university_id, repeat_password', 'required'),
			array('university_id', 'numerical', 'integerOnly'=>true),
			array('username, password, firstname, lastname', 'length', 'max'=>255),
			array('role', 'length', 'max'=>20),
			array('repeat_password', 'compare', 'compareAttribute'=>'password','on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, username, password, firstname, lastname, role, date_added, university_id', 'safe', 'on'=>'search'),
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
			'university' => array(self::BELONGS_TO, 'University', 'university_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'password' => 'Password',
			'repeat_password' => 'Repeat Password',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'role' => 'Role',
			'date_added' => 'Date Added',
			'university_id' => 'Educational institution',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('university_id',$this->university_id);

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

	public function beforeSave(){

		$this->password = md5($this->password);

		return parent::beforeSave();
	}

	public function checkLogin($username, $password){

		$criteria = new CDbCriteria();

		$criteria->condition = "username=:1 AND password=:2 ";
		$criteria->params = array(
			':1'	=>	$username,
			':2'	=>	md5($password),
		);

		$models = User::model()->with(array('university'))->find($criteria);

		if($models) return $models;
		else return array();

	}
	
}
