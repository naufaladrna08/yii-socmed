<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\Article;
use app\models\AppUser;

class CreateArticleForm extends Model {
  public $uid;
  public $title;
  public $content;

  public function rules() {
    return [
      [['uid', 'title', 'content'], 'required']
    ];
  }

  public function create() {
    if ($this->validate()){
      $article = new Article();
    
      $article->uid     = $this->uid;
      $article->title   = $this->title;
      $article->content = $this->content;
      
      return $article->save(false) ? $article : null;
    }
    
    return null;
  }
}