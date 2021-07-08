<?php

namespace app\controllers;

use Yii;
use \app\models\AppUser;
use \app\models\Picture;
use yii\db\Connection;
use yii\base\Exception;
use \vintage\tinify\UploadedFile;

class UserController extends \yii\web\Controller {
  public function actionIndex($username = "") {
    $profilePicture = '';

    if ($username == "") {
      $user = AppUser::find()->where(['username' => Yii::$app->user->identity->username])->one();
    } else {
      $user = AppUser::find()->where(['username' => $username])->one();
    }

    if ($user->photo == null) {
      $profilePicture = 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
    } else {
      $picture        = Picture::findOne($user->photo);
      $profilePicture = $picture['link'];
    }

    return $this->render('index', ['data' => $user, 'pic' => $profilePicture]);
  }

  public function actionChangePhoto() {
    $model = new Picture();
    if (Yii::$app->request->isPost) {
      $connection = Yii::$app->db;
      $transaction = $connection->beginTransaction();

      try {
        /* Save photo */
        $model->file = UploadedFile::getInstance($model, 'file');
        $model->file->resize()
                    ->cover()
                    ->width(512)
                    ->height(512)
                    ->process();
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
      $transaction = Yii::$app->db->beginTransaction();
      
      try {
        $user = $model->findOne(Yii::$app->user->identity->id);
        $user->username    = Yii::$app->request->post('AppUser')['username'];
        $user->email       = Yii::$app->request->post('AppUser')['email'];
        $user->description = Yii::$app->request->post('AppUser')['description'];
        $user->save();

        $transaction->commit();
      } catch (Exception $e) {
        $transaction->rollBack();
        throw $e;
      }

      return $this->redirect('user');
    }

    return $this->render('update-profile', [
      'model' => $model,
    ]);
  }
}
