<?php

/**
 * This is the model class for table "vt_term".
 *
 * The followings are the available columns in table 'vt_term':
 * @property integer $id
 * @property string $start_time
 */
class Term extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Term the static model class
     */

    public $current_term = null;
    public function getLatest()
    {
        if (!isset(Yii::app()->session['current_term'])) {
            $this->getDbCriteria()->mergeWith(array(
                'order' => 'id DESC',
                'limit' => 1,
                ));

            return $this->find();
        } else {
            return Term::model()->findByPk(Yii::app()->session['current_term']);
        }
    }


    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vt_term';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('start_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, start_time',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('weeks' => array(
                self::HAS_MANY,
                'Week',
                'term_id'));

    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Term number',
            'start_time' => 'Start Time',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('start_time', $this->start_time, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
}
