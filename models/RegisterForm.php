<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\AppUser;

class RegisterForm extends Model {
  public $username;
  public $email;
  public $password;
  public $description;

  public function rules() {
    return [
      [['username', 'email', 'password'], 'required'],
      ['username', 'string', 'min' => 3, 'max' => 30],
      ['password', 'string', 'min' => 3, 'max' => 30]
    ];
  }

  public function signup() {
    if (!$this->validate()) {
      return null;
    }

    $user = new AppUser();
    $user->username = $this->username;
    $user->email = $this->email;
    $user->setPassword($this->password);
    $user->description = $this->description;
    $user->generateAuthKey();
    
    return $user->save(false) ? $user : null;
  }
}