<?php

/**
 * This is the model class for table "vt_session".
 *
 * The followings are the available columns in table 'vt_session':
 * @property integer $id
 * @property string $attendance
 * @property integer $staff_id
 * @property string $students_id
 * @property integer $lesson_id
 * @property integer $status
 * @property integer $classroom_id
 * @property integer $day_id
 * @property integer $slot
 * @property string $session_notes
 */
class Session extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Session the static model class
	 */
          public function getStaffText()
     {
        $lesson = Lesson::model()->findByPk($this->lesson_id);
         return Staff::model()->findByPk($lesson->staff_id)->name;
      }   
     public function getSubject()
     {
        $lesson = Lesson::model()->findByPk($this->lesson_id);
        return $lesson->subject;
     }
     public function getTime()
     {
        $day = Day::model()->findByPk($this->day_id);
        $slot = $this->slot;
        if ($day->day_no <=5)
        {
            switch($day->day_no){
                    case 1:
                    return '16:00';
                    break;
                    case 2:
                    return '16:00';
                    break;
                    case 3:
                    return '16:00';
                    break;
                    case 4:
                    return '17:30';
                    break;
                    case 5:
                    return '17:30';
                    break;
                    case 6:
                    return '17:30';
                    break;
                    case 7:
                    return '19:00';
                    break;
                    case 8:
                    return '19:00';
                    break;
                    case 9:
                    return '19:00';
                    break;
            }
            
        }
        else
        {
                    switch($day->day_no){
                    case 1:
                    return '08:30';
                    break;
                    case 2:
                    return '08:30';
                    break;
                    case 3:
                    return '08:30';
                    break;
                    case 4:
                    return '10:00';
                    break;
                    case 5:
                    return '10:00';
                    break;
                    case 6:
                    return '10:00';
                    break;
                    case 7:
                    return '11:30';
                    break;
                    case 8:
                    return '11:30';
                    break;
                    case 9:
                    return '11:30';
                    break;
                    case 10:
                    return '13:00';
                    break;
                    case 11:
                    return '13:00';
                    break;
                    case 12:
                    return '13:00';
                    break;
                    case 13:
                    return '14:30';
                    break;
                    case 14:
                    return '14:30';
                    break;
                    case 15:
                    return '14:30';
                    break;
                    case 16:
                    return '16:00';
                    break;
                    case 17:
                    return '16:00';
                    break;
                    case 18:
                    return '16:00';
                    break;
                    case 19:
                    return '17:30';
                    break;
                    case 20:
                    return '17:30';
                    break;
                    case 21:
                    return '17:30';
                    break;
                    case 22:
                    return '19:00';
                    break;
                    case 23:
                    return '19:00';
                    break;
                    case 24:
                    return '19:00';
                    break;
            }
            
        }
        
     }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vt_session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' staff_id, students_id, lesson_id, slot', 'required'),
			array('staff_id, lesson_id, day_id, slot', 'numerical', 'integerOnly'=>true),
			array('session_notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, staff_id, students_id, lesson_id, status, classroom_id, day_id, slot, session_notes', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'attendance' => 'Attendance',
			'staff_id' => 'Staff',
			'students_id' => 'Students',
			'lesson_id' => 'Lesson',
			'status' => 'Status',
			'classroom_id' => 'Classroom',
			'day_id' => 'Day',
			'slot' => 'Slot',
			'session_notes' => 'Session Notes',
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
		$criteria->compare('attendance',$this->attendance,true);
		$criteria->compare('staff_id',$this->staff_id);
		$criteria->compare('students_id',$this->students_id,true);
		$criteria->compare('lesson_id',$this->lesson_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('classroom_id',$this->classroom_id);
		$criteria->compare('day_id',$this->day_id);
		$criteria->compare('slot',$this->slot);
		$criteria->compare('session_notes',$this->session_notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}