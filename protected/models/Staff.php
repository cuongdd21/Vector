<?php

/**
 * This is the model class for table "vt_staff".
 *
 * The followings are the available columns in table 'vt_staff':
 * @property integer $id
 * @property integer $term_id
 * @property string $display_name
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property string $address
 * @property string $TFN
 * @property string $BSB
 * @property string $AN
 * @property integer $paygrade_id
 * @property string $notes
 */
class Staff extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Staff the static model class
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
		return 'vt_staff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('term_id, display_name, name, contact, email, address, TFN, BSB, AN', 'required'),
			array('term_id, paygrade_id', 'numerical', 'integerOnly'=>true),
			array('name, contact, email, address, TFN, BSB, AN', 'length', 'max'=>255),
			array('notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, term_id, display_name, name, contact, email, address, TFN, BSB, AN, paygrade_id, notes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        $term_id = Term::model()->getLatest()->id;
		return array(
                'lessons' => array(self::HAS_MANY, 'Lesson', 'staff_id','on'=>'lessons.term_id='.$term_id),
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
			'contact' => 'Contact',
			'email' => 'Email',
			'address' => 'Address',
			'TFN' => 'Tfn',
			'BSB' => 'Bsb',
			'AN' => 'An',
			'paygrade_id' => 'Paygrade',
			'notes' => 'Notes',
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
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('TFN',$this->TFN,true);
		$criteria->compare('BSB',$this->BSB,true);
		$criteria->compare('AN',$this->AN,true);
		$criteria->compare('paygrade_id',$this->paygrade_id);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}