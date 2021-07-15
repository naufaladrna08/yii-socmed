<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = "YiiBook - " . $data['username'];
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
        <div class="col-md-12"> <h5> Name </h5> </div>
        <div class="col-md-12"> <p class="lead"> <?= Html::encode($data['firstname'] . ' ' . $data['lastname']) ?> </p> </div>
      </div>
      <div class="row">
        <div class="col-md-12"> <h5> Username </h5> </div>
        <div class="col-md-12"> <p class="lead"> <?= Html::encode($data['username']) ?> </div>
      </div>
      <div class="row">
        <div class="col-md-12"> <h5> Description </h5> </div>
        <div class="col-md-12"> <p class="lead"> <?= Html::encode($data['description']) ?> </p> </div>
      </div>
      <div class="row" id="articles">
        
      </div>
    </div>
  </div>
</div>

<?php 

$js = <<< JS
  $(document).ready(() => {
    showArticle()
  })

  function showArticle() {
    $.ajax({
      url: "http://localhost:8080/index.php?r=article/get-user-articles",
      type: "POST",
      dataType: "html",
      data: {
        id: 3,
        start: 0,
        offset: 0
      },
      success: function(data) {
        $("#articles").html(data)
      }
    })
  }
JS;

$this->registerJs($js, View::POS_READY, 'article-handler');
?>