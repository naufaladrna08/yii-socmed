<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>Please fill out the following fields to login:</p>

  <?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal'
  ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
      <div class="col-lg-offset-1 col-lg-12 px-0">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Register', ['/site/register'], ['class'=>'btn btn-success']) ?>
      </div>   
    </div>

  <?php ActiveForm::end(); ?>
</div>
