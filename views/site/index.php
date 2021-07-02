<?php

/* @var $this yii\web\View */

use Yii;
use yii\helpers\Html;
use yii\helpers\textarea;
use yii\bootstrap4\ActiveForm;

$this->title = 'YiiBook - Home';
$this->params['breadcrumbs'][] = "";
?>

<div class="site-index mt-4">
  <div class="row">
    <div class="col-md-2">
      <div class="card" width="100%">
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="card-img-top img-thumbnail">
        <div class="card-body">
          <p class="card-text"> <i class="fa fa-user"></i> <?= Html::encode(Yii::$app->user->identity->username) ?> </p>
        </div>
      </div>
    </div>

    <div class="col-md-8">
    <a class="btn btn-primary mb-4" data-toggle="collapse" href="#create-article-form" role="button" aria-expanded="false" aria-controls="collapseExample">
      Create a new Article
    </a>

    <div class="collapse my-2" id="create-article-form">
      <?php $form = ActiveForm::begin(['id' => 'create-article-form']) ?>
      
      <?= $form->field($new, 'title')->textInput() ?>
      <?= $form->field($new, 'content')->textarea() ?>

      <div class="form-group">
        <div class="col-lg-offset-1 col-lg-12 px-0">
          <?= Html::submitButton('Post', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>   
      </div>

      <?php ActiveForm::end()  ?>
    </div>

    <?php foreach ($articles as $a): ?>
      <div class="media border rounded p-2">
        <img class="mr-3 img-thumbnail" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" width="64" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="mt-0"> <?= $a['title'] ?> </h5>
          <?= $a['content'] ?>

          <div class="media-footer mt-2">
            ~ <?= Html::a($a['user']['username'], ['user/', 'username' => $a['user']['username']]) ?> <br>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
    
    <div class="col-md-2">
    
    </div>
  </div>
</div>
