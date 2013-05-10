<?php

/**
 * This is the model class for table "vt_student".
 *
 * The followings are the available columns in table 'vt_student':
 * @property integer $id
 * @property integer $term_id
 * @property string $display_name
 * @property string $name
 * @property integer $gender
 * @property string $contact
 * @property string $email
 * @property integer $year
 * @property integer $parent_id
 * @property integer $school_id
 * @property string $st_notes
 */
class Student extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vt_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('term_id, display_name, name, gender, contact, email, year', 'required'),
			array('term_id, gender, year, parent_id, school_id', 'numerical', 'integerOnly'=>true),
			array('name, contact, email', 'length', 'max'=>255),
			array('st_notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, term_id, display_name, name, gender, contact, email, year, parent_id, school_id, st_notes', 'safe', 'on'=>'search'),
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
        'lessons' => array(self::HAS_MANY, 'Studentlesson', 'student_id'),
          'invoices' => array(self::HAS_MANY, 'Invoice', 'student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'term_id' => 'Term',
			'display_name' => 'Display Name',
			'name' => 'Name',
			'gender' => 'Gender',
			'contact' => 'Contact',
			'email' => 'Email',
			'year' => 'Year',
			'parent_id' => 'Parent',
			'school_id' => 'School',
			'st_notes' => 'St Notes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('term_id',Term::model()->getLatest()->id);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('school_id',$this->school_id);
		$criteria->compare('st_notes',$this->st_notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}