<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <?php
  NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
      'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
    ],
  ]);
  echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
      ['label' => 'Home', 'url' => ['/site/index']],
      ['label' => 'About', 'url' => ['/site/about']],
      ['label' => 'Contact', 'url' => ['/site/contact']],
      Yii::$app->user->isGuest ? (
        ['label' => 'Login', 'url' => ['/site/login']]
      ) : (
        '<li class="nav-item">'
        . Html::a(Yii::$app->user->identity->username, ['/user'], ['class' => 'nav-link'])
        .'</li>' 
        . '<li class="nav-item">'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
          'Logout',
          ['class' => 'btn btn-success ml-2']
        )
        . Html::endForm()
        . '</li>'
      )
    ],
  ]);
  NavBar::end();
  ?>

  <div class="container" id="main">
    <?= Breadcrumbs::widget([
      'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
      'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
  </div>
</div>

<footer class="footer">
  <div class="container">
    <span class="text-muted"> &copy; YiiBook <?= date('Y') ?> </span>
  </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
