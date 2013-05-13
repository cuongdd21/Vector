<?php

/**
 * This is the model class for table "vt_payslip".
 *
 * The followings are the available columns in table 'vt_payslip':
 * @property integer $id
 * @property string $number
 * @property string $date_create
 * @property string $date_start
 * @property string $date_end
 * @property integer $status
 * @property string $grade
 * @property integer $total
 * @property integer $staff_id
 * @property integer $common_id
 * @property string $payslip_notes
 */
class Payslip extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payslip the static model class
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
		return 'vt_payslip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, status, grade, total', 'required'),
			array('status, total, staff_id, common_id', 'numerical', 'integerOnly'=>true),
			array('number, grade', 'length', 'max'=>255),
			array('date_create, date_start, date_end, payslip_notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, date_create, date_start, date_end, status, grade, total, staff_id, common_id, payslip_notes', 'safe', 'on'=>'search'),
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
               'payslip' => array(self::BELONGS_TO, 'Staff', 'staff_id'), 
                    
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
			'date_start' => 'Date Start',
			'date_end' => 'Date End',
			'status' => 'Status',
			'grade' => 'Grade',
			'total' => 'Total',
			'staff_id' => 'Staff',
			'common_id' => 'Common',
			'payslip_notes' => 'Payslip Notes',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('staff_id',$this->staff_id);
		$criteria->compare('common_id',$this->common_id);
		$criteria->compare('payslip_notes',$this->payslip_notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}