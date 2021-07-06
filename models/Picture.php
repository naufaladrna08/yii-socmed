<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pictures".
 *
 * @property int $id
 * @property int|null $author
 * @property string|null $link
 */
class Picture extends \yii\db\ActiveRecord {
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'pictures';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['author'], 'default', 'value' => null],
      [['author'], 'integer'],
      [['link'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'author' => 'Author',
      'link' => 'Link',
    ];
  }
}
