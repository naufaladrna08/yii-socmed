<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppUser */
/* @var $form ActiveForm */

$this->title = "YiiBook - Update Profile";
?>
<div class="user-update-profile">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['value' => Yii::$app->user->identity->username]) ?>
        <?= $form->field($model, 'email')->textInput(['value' => Yii::$app->user->identity->email]) ?>
        <?= $form->field($model, 'description')->textarea(['value' => Yii::$app->user->identity->description]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-update-profile -->
