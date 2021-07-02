<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>Please fill out the following fields to register:</p>

  <?php $form = ActiveForm::begin([
    'id' => 'register-form',
    'layout' => 'horizontal'
  ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'description')->textarea() ?>

    <div class="form-group">
      <div class="col-lg-offset-1 col-lg-11 px-0">
        <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
      </div>
    </div>

  <?php ActiveForm::end(); ?>

  <div class="col-lg-offset-1" style="color:#999;">
    You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
    To modify the username/password, please check out the code <code>app\models\User::$users</code>.
  </div>
</div>
