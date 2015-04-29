<?php

/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property integer $course_id
 * @property string $course_name
 * @property string $course_detail
 * @property string $course_price
 * @property string $course_type
 * @property string $grade
 * @property integer $class
 * @property integer $subject_id
 * @property integer $university_id
 */
class Course extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_name, course_detail, course_price, course_type, grade, class, subject_id, university_id', 'required'),
			array('class, subject_id, university_id', 'numerical', 'integerOnly'=>true),
			array('course_name', 'length', 'max'=>255),
			array('course_detail', 'length', 'max'=>1000),
			array('course_price, course_type', 'length', 'max'=>11),
			array('grade', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('course_id, course_name, course_detail, course_price, course_type, grade, class, subject_id, university_id', 'safe', 'on'=>'search'),
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
			'course_id' => 'Course',
			'course_name' => 'Course Name',
			'course_detail' => 'Course Detail',
			'course_price' => 'Course Price',
			'course_type' => 'Course Type',
			'grade' => 'Grade',
			'class' => 'Class',
			'subject_id' => 'Subject',
			'university_id' => 'School',
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

		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('course_name',$this->course_name,true);
		$criteria->compare('course_detail',$this->course_detail,true);
		$criteria->compare('course_price',$this->course_price,true);
		$criteria->compare('course_type',$this->course_type,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('class',$this->class);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('university_id',$this->university_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Course the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTotalCouresBySchoolId($id = 0){

		$criteria = new CDbCriteria();

		if($id > 0){
			$criteria->condition = "university_id = :id";
			$criteria->params = array(
					":id" => $id,
				);
		}

		$model = Course::model()->count($criteria);

		if ($model) return $model;
		else return 0;

	}
}
