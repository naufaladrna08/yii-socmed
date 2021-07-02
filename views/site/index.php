<?php

/* @var $this yii\web\View */

use Yii;
use yii\helpers\Html;

$this->title = 'YiiBook - Home';
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

    <?php foreach ($articles as $a): ?>
    <div class="col-md-8">
      <div class="media border rounded p-2">
        <img class="mr-3 img-thumbnail" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" width="64" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="mt-0"> <?= $a['title'] ?> </h5>
          <?= $a['content'] ?>

          <div class="media-footer mt-2">
            ~ <?= $a['user']['username'] ?> <br>
            <i class="fa fa-thumbs-up"></i> 10
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    
    <div class="col-md-2">
    
    </div>
  </div>
</div>
