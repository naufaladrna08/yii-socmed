<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

use app\models\Picture;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $description
 * @property string|null $authKey
 * @property int|null $photo 
 */
class AppUser extends ActiveRecord implements IdentityInterface {
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'users';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['username', 'email', 'password', 'description'], 'string'],
      [['photo'], 'default', 'value' => null],
      [['photo'], 'integer'],
      [['authKey'], 'string', 'max' => 32],
      [['firstname', 'lastname'], 'string', 'max' => 200],
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'username' => 'Username',
      'email' => 'Email',
      'password' => 'Password',
      'description' => 'Description',
      'authKey' => 'Auth Key',
      'photo' => 'Photo',
      'firstname' => 'Firstname',
      'lastname' => 'Lastname',
    ];
  }

  public static function findIdentity($id) {
    return static::findOne($id);
  }

  public static function findIdentityByAccessToken($token, $type = null) {
    //return static::findOne(['access_token' => $token]);
    throw new NotSupportedException();
  }

  public function getId() {
    return $this->id;
  }

  public function getAuthKey() {
    return $this->authKey;
  }

  public function validateAuthKey($authKey) {
    return $this->getAuthKey() === $authKey;
  }

  public static function findByUsername($username) {
    return self::findOne(['username' => $username]);
  }

  public function validatePassword($password) {
    return Yii::$app->security->validatePassword($password, $this->password);
  }

  public function setPassword($password) {
    $this->password = Yii::$app->security->generatePasswordHash($password);
  }

  public function generateAuthKey() {
    $this->authKey = Yii::$app->security->generateRandomString();
  }

  public function getArticles() {
    return $this->hasMany(Article::class, ['uid' => 'id']);
  }

  public function getProfilePicture() {
    $user = self::findOne(['id' => Yii::$app->user->identity->id]);

    if ($user->photo == null) {
      $profilePicture = 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
    } else {
      $picture        = Picture::findOne($user->photo);
      $profilePicture = $picture['link'];
    }

    return $profilePicture;
  }
}
