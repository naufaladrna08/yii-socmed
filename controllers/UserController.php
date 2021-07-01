<?php

namespace app\controllers;

use Yii;
use \app\models\AppUser;

class UserController extends \yii\web\Controller {
  public function actionIndex($username = "") {
    $user = new AppUser();
    
    if ($username == "") {
      $user->findByUsername(Yii::$app->user->identity->username);
    } else {
      $user->findByUsername($username);
    }

    return $this->render('index', ['data' => $user, 'username' => $username]);
  }
}
