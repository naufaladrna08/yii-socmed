<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int|null $uid
 * @property string|null $title
 * @property string|null $content
 */
class Article extends \yii\db\ActiveRecord {
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'articles';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['id'], 'required'],
      [['id', 'uid'], 'default', 'value' => null],
      [['id', 'uid'], 'integer'],
      [['title', 'content'], 'string'],
      [['id'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'uid' => 'Uid',
      'title' => 'Title',
      'content' => 'Content',
    ];
  }

  public function getUser() {
    return $this->hasOne(AppUser::class, ['id' => 'uid']);
  }
}
