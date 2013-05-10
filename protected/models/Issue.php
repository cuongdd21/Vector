<?php

/**
 * This is the model class for table "tbl_issue".
 *
 * The followings are the available columns in table 'tbl_issue':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $project_id
 * @property integer $type_id
 * @property integer $status_id
 * @property integer $owner_id
 * @property integer $requester_id
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property User $requester
 * @property User $owner
 * @property Project $project


 */
class Issue extends CDActiveRecord
{
    
// Phan nay de dinh nghia them
const TYPE_BUG=0;
const TYPE_FEATURE=1;
const TYPE_TASK=2;

const STATUS_NOTYET=0;
const STATUS_YET=1;
const STATUS_FINAL=2;

public function getStatusText()
{
$statusOptions=$this->statusOptions;
return isset($statusOptions[$this->status_id]) ?
$statusOptions[$this->status_id] : "unknown status ({$this->status_id})";
}
/**
* @return string the type text display for the current issue
*/
public function getTypeText()
{
	$typeOptions=$this->typeOptions;
	return isset($typeOptions[$this->type_id]) 
? $typeOptions[$this->type_id] : "unknown type ({$this->type_id})";
}

public function getUserOptions()
{
    $usersArray = CHtml::listData($this->users,'id','username');
    return $userArray;
    // return ra 1 donh nhung user lien quan de display trong form
}

public function getStatusOptions()
	{
			return array(
				self::STATUS_NOTYET=>'NOT READY',
				self::STATUS_YET=>'READY',
				self::STATUS_FINAL=>'COMPLETE',
			);	
	}
public static function getAllowedStatusRange()
	{
		return array(
			self::STATUS_NOTYET,
			self::STATUS_YET,
			self::STATUS_FINAL,
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Issue the static model class
	 */
    public function getTypeOptions()
    {
        return array(
        self::TYPE_BUG=>'Bug',
        self::TYPE_FEATURE=>'Feature',
        self::TYPE_TASK=>'Task',
        );
    }
    public static function getAllowedTypeRange()
{
	return array(
		self::TYPE_BUG,
		self::TYPE_FEATURE,
		self::TYPE_TASK,
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
		return 'tbl_issue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('status_id', 'in', 'range'=>self::getAllowedStatusRange()),
            // DOAN CODE NHAM DE VALIDATE STATUS_ID NO THUOC TRONG RANGE DA DANG KY, VALIDATE TRONG FORM
			array('name', 'required'),
            array('type_id', 'in', 'range'=>self::getAllowedTypeRange()),
			array('project_id, type_id, status_id, owner_id, requester_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, project_id, type_id, status_id, owner_id, requester_id', 'safe', 'on'=>'search'),
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
			'requester' => array(self::BELONGS_TO, 'User', 'requester_id'),
			'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'users' => array(self::MANY_MANY,'User','tbl_project_user_assignment(project_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'project_id' => 'Project',
			'type_id' => 'Type',
			'status_id' => 'Status',
			'owner_id' => 'Owner',
			'requester_id' => 'Requester',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('requester_id',$this->requester_id);

        $criteria->condition='project_id=:projectID';
        $criteria->params=array(':projectID'=>$this->project_id);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}