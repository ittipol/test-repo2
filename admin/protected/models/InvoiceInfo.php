<?php

/**
 * This is the model class for table "invoice_info".
 *
 * The followings are the available columns in table 'invoice_info':
 * @property string $invoice_info_id
 * @property string $invoice_info_referance_code
 * @property string $invoice_info_amount
 * @property string $invoice_info_detail
 * @property string $invoice_info_status
 * @property string $invoice_info_payed_date
 * @property integer $university_id
 */
class InvoiceInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'invoice_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_info_id, invoice_info_referance_code, invoice_info_amount, invoice_info_detail, invoice_info_status, invoice_info_payed_date, university_id', 'required'),
			array('university_id', 'numerical', 'integerOnly'=>true),
			array('invoice_info_id, invoice_info_referance_code', 'length', 'max'=>20),
			array('invoice_info_amount', 'length', 'max'=>10),
			array('invoice_info_status', 'length', 'max'=>66),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('invoice_info_id, invoice_info_referance_code, invoice_info_amount, invoice_info_detail, invoice_info_status, invoice_info_payed_date, university_id', 'safe', 'on'=>'search'),
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
			'invoice_info_id' => 'Invoice Info',
			'invoice_info_referance_code' => 'Invoice Info Referance Code',
			'invoice_info_amount' => 'Invoice Info Amount',
			'invoice_info_detail' => 'Invoice Info Detail',
			'invoice_info_status' => 'Invoice Info Status',
			'invoice_info_payed_date' => 'Invoice Info Payed Date',
			'university_id' => 'University',
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

		$criteria->compare('invoice_info_id',$this->invoice_info_id,true);
		$criteria->compare('invoice_info_referance_code',$this->invoice_info_referance_code,true);
		$criteria->compare('invoice_info_amount',$this->invoice_info_amount,true);
		$criteria->compare('invoice_info_detail',$this->invoice_info_detail,true);
		$criteria->compare('invoice_info_status',$this->invoice_info_status,true);
		$criteria->compare('invoice_info_payed_date',$this->invoice_info_payed_date,true);
		$criteria->compare('university_id',$this->university_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvoiceInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
