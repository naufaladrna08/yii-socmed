<?php

/* @var $this yii\web\View */

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
      <?= Html::a('Create an Article', ['site/create-article'], ['class' => 'btn btn-primary mb-4']) ?>

      <?php foreach ($model as $article): ?>
      <?php 
        $thumb = $like->find()->where(['uid' => Yii::$app->user->identity->id, 'aid' => $article['id']])->count() == 1 ? '<i class="fa fa-thumbs-up"> </i> ' : '<i class="fa fa-thumbs-down"> </i> ';
        $likes = $thumb . $like->find()->where(['aid' => $article['id']])->count();   
      ?>
      
      <div class="media border rounded p-2 my-2">
        <img class="mr-3 img-thumbnail" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" width="64" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="mt-0"> <?= $article['title'] ?> </h5>
          <?= Html::encode(strip_tags($article['content'])) ?>

          <div class="media-footer mt-2">
            ~ <?= Html::a($article['user']['username'], ['user/', 'username' => $article['user']['username']]) ?> <br>
            <?= Html::a($likes, 'article/like') ?>
          </div>
          <br>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    
    <div class="col-md-2">
    
    </div>
  </div>
</div>
