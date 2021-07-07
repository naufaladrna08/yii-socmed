<?php

namespace app\controllers;

use Yii;
use \app\models\AppUser;
use \app\models\Picture;
use yii\web\UploadedFile;
use yii\db\Connection;
use yii\base\Exception;

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

  public function actionChangePhoto() {
    $model = new Picture();
    if (Yii::$app->request->isPost) {
      $connection = Yii::$app->db;
      $transaction = $connection->beginTransaction();

      try {
        /* Save photo */
        $model->file = UploadedFile::getInstance($model, 'file');
        $fileName = 'uploads/' .  time() . '.' . $model->file->extension;
        $model->file->saveAs($fileName);
        $model->author = Yii::$app->user->identity->id;
        $model->link   = $fileName;
        $model->save();

        unset($model);
        /* Update userdata */
        $model = Picture::find()->where(['link' => $fileName])->one();
        $user = AppUser::findOne(Yii::$app->user->identity->id);
        $user->photo = $model->id;
        $user->save();
        
        $transaction->commit();
      } catch (\Exception $e) {
        $transaction->rollBack();
        throw $e;
      } catch (\Throwable $e) {
        $transaction->rollBack();
        throw $e;
      }

      return $this->redirect(['user/']);
    }

    return $this->render('change-photo', ['model' => $model]);
  }

  
  public function actionUpdateProfile() {
    $model = new AppUser();

    if ($model->load(Yii::$app->request->post())) {
      $user = $model->findOne(Yii::$app->user->identity->id);
      $user->username    = Yii::$app->request->post('AppUser')['username'];
      $user->email       = Yii::$app->request->post('AppUser')['email'];
      $user->description = Yii::$app->request->post('AppUser')['description'];
      
      if ($user->save()) {

      } else {
        echo $user->createCommand()->getRawSql();        
      }

      return $this->redirect('user');
    }

    return $this->render('update-profile', [
      'model' => $model,
    ]);
  }
}
