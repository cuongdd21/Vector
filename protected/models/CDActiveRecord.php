<?php
	abstract class CDActiveRecord extends CActiveRecord
    {
        protected function beforeSave()
        {
            if(null !== Yii::app()->user)
	$id=Yii::app()->user->id;
    // neu nhu ton tai user thi lay $id, neu khong cho id = 1
    // trong fan dinh nghia beforeSave thi ta se dinh nghia tat 
    // ca nhung thanh phan de khoi tao nhung ban ghi moi
    // trong do co cac create_time, update_time va hay hon het la
    // create_user etc
		else
	$id=1;
    
	if($this->isNewRecord)
		$this->create_user_id=$id;
		$this->update_user_id=$id;
		return parent::beforeSave();
        // lam tiep nhung thao tac ngam dinh cua beforeSave

            
        }
        public function behaviors()
{
	return array(
		'CTimestampBehavior' => array(
		'class' => 'zii.behaviors.CTimestampBehavior',
		'createAttribute' => 'create_time',
		'updateAttribute' => 'update_time',
		'setUpdateOnCreate' => true,
	),
	);
}

        
        
    }
?>