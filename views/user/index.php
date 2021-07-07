<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = "YiiBook - " . Yii::$app->user->identity->username;
?>

<div class="container">
  <div class="row">
    <div class="col-md-2">
      <img src="<?= $pic ?>" class="img-thumbnail" width="100%">
      <div class="btn-group-vertical mt-4" style="width: 100%">
        <?= Html::a('Edit Profile', ['user/update-profile'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Change Photo', ['user/change-photo'], ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
    <div class="col-md-10">
      <div class="display-4"> <?= Html::encode($data['username']) ?>'s Profile </div>

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