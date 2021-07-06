<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $user_id
 */
class Like extends \yii\db\ActiveRecord {
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'likes';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['article_id', 'user_id'], 'default', 'value' => null],
      [['article_id', 'user_id'], 'integer'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'article_id' => 'Article ID',
      'user_id' => 'User ID',
    ];
  }
}
