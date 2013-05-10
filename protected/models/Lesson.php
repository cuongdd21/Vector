<?php

/**
 * This is the model class for table "vt_lesson".
 *
 * The followings are the available columns in table 'vt_lesson':
 * @property integer $id
 * @property integer $term_id
 * @property integer $day
 * @property integer $slot
 * @property integer $staff_id
 * @property integer $start_week
 * @property integer $end_week
 * @property string $name
 * @property integer $group
 * @property integer $type
 * @property integer $status
 * @property integer $total
 * @property integer $subject_id
 * @property integer $price_id
 * @property integer $student_id
 * @property string $lesson_notes
 */
class Lesson extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lesson the static model class
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
		return 'vt_lesson';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('term_id, day, slot, staff_id, start_week, end_week, group', 'required'),
			array('term_id, day, slot, staff_id, start_week, end_week, group, type, status, total, subject_id, price_id, student_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('lesson_notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, term_id, day, slot, staff_id, start_week, end_week, name, group, type, status, total, subject_id, price_id, student_id, lesson_notes', 'safe', 'on'=>'search'),
		);
	}

    public function getDayText()
    {
        if($this->day==1) return 'Monday';
        if($this->day==2) return 'Tuesday';
        if($this->day==3) return 'Wednesday';
        if($this->day==4) return 'Thursday';
        if($this->day==5) return 'Friday';
        if($this->day==6) return 'Sartuday';
        if($this->day==7) return 'Sunday';
        return 'unknown';
    }
    public function getStaffText()
    {
        $staff = Staff::model()->findByPk($this->staff_id);
        return $staff->name;
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
         'sessions' => array(self::HAS_MANY, 'Session', 'lesson_id'),
                  'students' => array(self::HAS_MANY, 'Studentlesson', 'lesson_id'),
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
			'day' => 'Day',
			'slot' => 'Slot',
			'staff_id' => 'Staff',
			'start_week' => 'Start Week',
			'end_week' => 'End Week',
			'name' => 'Name',
			'group' => 'Group',
			'type' => 'Type',
			'status' => 'Status',
			'total' => 'Total',
			'subject_id' => 'Subject',
			'price_id' => 'Price',
			'student_id' => 'Student',
			'lesson_notes' => 'Lesson Notes',
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
		$criteria->compare('term_id',$this->term_id);
		$criteria->compare('day',$this->day);
		$criteria->compare('slot',$this->slot);
		$criteria->compare('staff_id',$this->staff_id);
		$criteria->compare('start_week',$this->start_week);
		$criteria->compare('end_week',$this->end_week);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('group',$this->group);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
		$criteria->compare('total',$this->total);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('price_id',$this->price_id);
        //new
        $criteria->alias = 'Lesson';
        $criteria->join='LEFT JOIN vt_studentlesson ON Lesson.id=vt_studentlesson.lesson_id';
        $criteria->condition='vt_studentlesson.student_id='.$student_id;
		//$criteria->compare('student_id',$student_id);
		$criteria->compare('lesson_notes',$this->lesson_notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
}