<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
  html,
  body {
    height: 100%;
    background-color: #333;
  }

  body {
    display: -ms-flexbox;
    display: flex;
    color: #fff;
    text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
    box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
  }

  .cover-container {
    max-width: 42em;
  }
</style>

  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand">YiiBook</h3>
        <nav class="nav nav-masthead justify-content-center">  
          <?= Html::a('Login', ['site/login'], ['class' => 'nav-link']) ?>
          <?= Html::a('Register', ['site/register'], ['class' => 'nav-link active']) ?>
          <?= Html::a('About', ['site/contact'], ['class' => 'nav-link']) ?>
        </nav>
      </div>
    </header>

    <main role="main" class="inner cover text-center" style="width: 80%; margin-bottom: 8em">
      <div class="title">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="lead"> Please fill this form to Login! </p>
      </div>

    <?php $form = ActiveForm::begin([
      'id' => 'register-form'
    ]); ?>

      <?= $form->field($model, 'firstname')->textInput(['autofocus' => true, 'placeholder' => 'First Name'])->label(false) ?>
      <?= $form->field($model, 'lastname')->textInput(['autofocus' => true, 'placeholder' => 'Last Name (Optional)'])->label(false) ?>
      <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>
      <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>
      <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
      <?= $form->field($model, 'description')->textarea(['placeholder' => 'Description'])->label(false) ?>

      <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 px-0">
          <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>
      </div>

    <?php ActiveForm::end(); ?>


    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p> Copyright YiiBook <?= date('Y') ?> </p>
      </div>
    </footer>
  </div>
