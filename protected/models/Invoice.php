<?php

/**
 * This is the model class for table "vt_invoice".
 *
 * The followings are the available columns in table 'vt_invoice':
 * @property integer $id
 * @property string $number
 * @property string $date_create
 * @property integer $status
 * @property integer $total
 * @property integer $student_id
 * @property integer $lesson_id
 * @property integer $common_id
 * @property string $notes
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return 'vt_invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, status, total', 'required'),
			array('status, total, student_id, lesson_id, common_id', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>255),
			array('date_create, notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date_create, status, total, student_id, lesson_id, common_id, notes', 'safe', 'on'=>'search'),
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
                                        'invoice' => array(self::BELONGS_TO, 'Student', 'student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'date_create' => 'Date Create',
			'status' => 'Status',
			'total' => 'Total',
			'student_id' => 'Student',
			'lesson_id' => 'Lesson',
			'common_id' => 'Common',
			'notes' => 'Notes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($student_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('total',$this->total);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('lesson_id',$this->lesson_id);
		$criteria->compare('common_id',$this->common_id);
		$criteria->compare('notes',$this->notes,true);
                        $criteria->alias = 'Invoice';
        $criteria->join='LEFT JOIN vt_student ON Invoice.student_id=vt_student.id';
        $criteria->condition='Invoice.student_id='.$student_id;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}