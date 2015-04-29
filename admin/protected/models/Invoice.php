<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $invoice_id
 * @property string $invoice_info_id
 * @property string $invoice_info_referance_code
 * @property string $invoice_info_amount
 * @property string $invoice_info_detail
 * @property string $invoice_info_status
 * @property integer $member_id
 * @property string $invoice_info_payed_date
 * @property string $invoice_student_name
 * @property string $invoice_student_major
 * @property string $invoice_student_faculty
 * @property integer $university_id
 * @property integer $university_id
 * @property integer $course_id
 */
class Invoice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_info_id, invoice_info_referance_code, invoice_info_amount, invoice_info_detail, invoice_info_status, member_id, invoice_info_payed_date, invoice_student_name, invoice_student_major, invoice_student_faculty, university_id, university_id, course_id', 'required'),
			array('member_id, university_id, university_id, course_id', 'numerical', 'integerOnly'=>true),
			array('invoice_info_id, invoice_info_referance_code', 'length', 'max'=>50),
			array('invoice_info_amount', 'length', 'max'=>10),
			array('invoice_info_status', 'length', 'max'=>66),
			array('invoice_student_name, invoice_student_major, invoice_student_faculty', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('invoice_id, invoice_info_id, invoice_info_referance_code, invoice_info_amount, invoice_info_detail, invoice_info_status, member_id, invoice_info_payed_date, invoice_student_name, invoice_student_major, invoice_student_faculty, university_id, university_id, course_id', 'safe', 'on'=>'search'),
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
			'invoice_id' => 'Invoice',
			'invoice_info_id' => 'Invoice Info',
			'invoice_info_referance_code' => 'Invoice Info Referance Code',
			'invoice_info_amount' => 'Invoice Info Amount',
			'invoice_info_detail' => 'Invoice Info Detail',
			'invoice_info_status' => 'Invoice Info Status',
			'member_id' => 'Member',
			'invoice_info_payed_date' => 'Invoice Info Payed Date',
			'invoice_student_name' => 'Invoice Student Name',
			'invoice_student_major' => 'Invoice Student Major',
			'invoice_student_faculty' => 'Invoice Student Faculty',
			'university_id' => 'University',
			'university_id' => 'School',
			'course_id' => 'Course',
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

		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('invoice_info_id',$this->invoice_info_id,true);
		$criteria->compare('invoice_info_referance_code',$this->invoice_info_referance_code,true);
		$criteria->compare('invoice_info_amount',$this->invoice_info_amount,true);
		$criteria->compare('invoice_info_detail',$this->invoice_info_detail,true);
		$criteria->compare('invoice_info_status',$this->invoice_info_status,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('invoice_info_payed_date',$this->invoice_info_payed_date,true);
		$criteria->compare('invoice_student_name',$this->invoice_student_name,true);
		$criteria->compare('invoice_student_major',$this->invoice_student_major,true);
		$criteria->compare('invoice_student_faculty',$this->invoice_student_faculty,true);
		$criteria->compare('university_id',$this->university_id);
		$criteria->compare('university_id',$this->university_id);
		$criteria->compare('course_id',$this->course_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Invoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTotalInvoice($status,$id){

		$criteria = new CDbCriteria();

		$criteria->condition = "invoice_info_status = :status AND university_id = :id";

		$criteria->params = array(
				":status"=>$status,
				":id"=>$id,
			);

		$model = Invoice::model()->count($criteria);

		if($model) return $model;
		else return 0;

	}
}
