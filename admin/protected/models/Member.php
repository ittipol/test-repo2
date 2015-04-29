<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $member_id
 * @property string $member_firstname
 * @property string $member_lastname
 * @property string $member_tel
 * @property string $member_birthdate
 * @property string $member_address
 * @property string $member_email
 * @property string $member_password
 * @property integer $university_id
 * @property integer $university_id
 * @property string $faculty
 * @property string $major
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_firstname, member_lastname, member_tel, member_birthdate, member_address, member_email, member_password, university_id, university_id, faculty, major', 'required'),
			array('university_id, university_id', 'numerical', 'integerOnly'=>true),
			array('member_firstname, member_lastname, faculty, major', 'length', 'max'=>150),
			array('member_tel, member_birthdate', 'length', 'max'=>20),
			array('member_email, member_password', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('member_id, member_firstname, member_lastname, member_tel, member_birthdate, member_address, member_email, member_password, university_id, university_id, faculty, major', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' => 'Member',
			'member_firstname' => 'Member Firstname',
			'member_lastname' => 'Member Lastname',
			'member_tel' => 'Member Tel',
			'member_birthdate' => 'Member Birthdate',
			'member_address' => 'Member Address',
			'member_email' => 'Member Email',
			'member_password' => 'Member Password',
			'university_id' => 'School',
			'university_id' => 'University',
			'faculty' => 'Faculty',
			'major' => 'Major',
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

		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('member_firstname',$this->member_firstname,true);
		$criteria->compare('member_lastname',$this->member_lastname,true);
		$criteria->compare('member_tel',$this->member_tel,true);
		$criteria->compare('member_birthdate',$this->member_birthdate,true);
		$criteria->compare('member_address',$this->member_address,true);
		$criteria->compare('member_email',$this->member_email,true);
		$criteria->compare('member_password',$this->member_password,true);
		$criteria->compare('university_id',$this->university_id);
		$criteria->compare('university_id',$this->university_id);
		$criteria->compare('faculty',$this->faculty,true);
		$criteria->compare('major',$this->major,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getMemberBySchoolId($id = 0){

		$criteria = new CDbCriteria();

		if($id > 0){
			$criteria->condition = "university_id = :id";
			$criteria->params = array(
					":id" => $id,
				);
		}

		$model = Member::model()->find($criteria);

		if ($model) return $model;
		else return array();

	}

	public function getTotalMemberBySchoolId($id = 0){

		$criteria = new CDbCriteria();

		if($id > 0){
			$criteria->condition = "university_id = :id";
			$criteria->params = array(
					":id" => $id,
				);
		}
		
		$model = Member::model()->count($criteria);

		if ($model) return $model;
		else return 0;

	}
}
