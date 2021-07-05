<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
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
          <?= Html::a('Login', ['site/login'], ['class' => 'nav-link active']) ?>
          <?= Html::a('Login', ['site/register'], ['class' => 'nav-link']) ?>
          <?= Html::a('Login', ['site/contact'], ['class' => 'nav-link']) ?>
        </nav>
      </div>
    </header>

    <main role="main" class="inner cover text-center" style="width: 80%;">
      <div class="title my-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="lead"> Please fill this form to Login! </p>
      </div>

      <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'class' => 'text-center'
      ]); ?>
      
        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
          <div class="col-lg-offset-1 col-lg-12 px-0">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <?= Html::a('Register', ['/site/register'], ['class'=>'btn btn-success']) ?>
          </div>   
        </div>

      <?php ActiveForm::end(); ?>
    </main>

    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p> Copyright YiiBook <?= date('Y') ?> </p>
      </div>
    </footer>
  </div>
