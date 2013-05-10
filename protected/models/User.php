<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Issue[] $issues
 * @property Issue[] $issues1
 * @property Project[] $tblProjects
 */
class User extends CDActiveRecord
{
    protected function afterValidate()
{
	parent::afterValidate();
	if(!$this->hasErrors())
	$this->password = $this->hashPassword($this->password);
}

// FUNCTION DE GIAI MA PASSWORD

public function validatePassword($password)
{
return $this->hashPassword($password)===$this->password;
}
/**
* Generates the password hash.
* @param string password
* @return string hash
*/
public function hashPassword($password)
{
	return md5($password);
}

    
    
    public $password_repeat;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
     public function behaviors()
{
	return array('CTimestampBehavior' => array(
		'class' => 'zii.behaviors.CTimestampBehavior',
		'createAttribute' => 'create_time',
		'updateAttribute' => 'update_time',
		'setUpdateOnCreate' => true,
		),
	);
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
        array('password', 'compare', 'compareAttribute'=>'password_repeat'),
array('password_repeat', 'safe'),

			array('email, username, password, password_repeat', 'required'),
			array('username', 'length', 'max'=>30),
			array('email', 'length', 'max'=>1000),
			array('password', 'length', 'max'=>255),
            array('email, username', 'unique'),
            array('email', 'email'),
			array('last_login_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, password', 'safe', 'on'=>'search'),
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
			'issues' => array(self::HAS_MANY, 'Issue', 'owner_id'),
			'issues1' => array(self::HAS_MANY, 'Issue', 'requester_id'),
			'tblProjects' => array(self::MANY_MANY, 'Project', 'tbl_project_user_assignment(user_id, project_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'last_login_time' => 'Last Login Time',

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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}