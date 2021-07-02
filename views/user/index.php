<?php
/* @var $this yii\web\View */
use Yii;
use yii\helpers\Html;

$this->title = "YiiBook - " . Yii::$app->user->identity->username;
?>
<title> <?= Html::encode($this->title) ?> </title>

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="img-thumbnail" width="100%">

    </div>
    <div class="col-md-10">
      <div class="display-4"> <?= Html::encode(Yii::$app->user->identity->username) ?>'s Profile </div>

      <div class="row mt-4">
        <div class="col-md-12"> <h5> Username </h5> </div>
        <div class="col-md-12"> <p class="lead"> <?= Html::encode(Yii::$app->user->identity->username) ?> </p> </div>
      </div>
      <div class="row">
        <div class="col-md-12"> <h5> Description </h5> </div>
        <div class="col-md-12"> <p class="lead"> <?= Html::encode(Yii::$app->user->identity->description) ?> </p> </div>
      </div>
    </div>
  </div>
  
</div>