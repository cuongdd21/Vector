<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php if(!Yii::app()->user->isGuest):?>
<p>
You last logged in on <?php echo Yii::app()->user->lastLogin; ?>.
</p>
<?php endif;?>


Vector Tutoring is a high quality Australian private tutoring centre, well-regarded for its unique learning system and delivery method. Combining critical thinking and learning methods from the top education systems of the world, trained and qualified VCE specialist tutors help high school students achieve academic excellence.
 