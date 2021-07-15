<?php

use Yii;
use yii\helpers\Html;
?>

<?php foreach ($model as $article): ?>
<?php 
  /* Like or Disklike Button */
  $id 	 = $user_id;
  $user  = $article['user'];

  $thumb = $like->find()
  							->where(['uid' => $id, 'aid' => $article['id']])
  							->exist() === true ? '<i class="fa fa-thumbs-up"> </i> ' : '<i class="fa fa-thumbs-down"> </i> ';
  $likes = $thumb . $like->find()
  											 ->where(['aid' => $article['id']])
  											 ->count();
  $btnId = $like->find()
  							->where(['uid' => $id, 'aid' => $article['id']])
  							->count() == 0 ? 'like-post' : 'dislike-post';

  $pictures       = $picture->findOne($user['photo']);
  $profilePicture = $pictures['link'];
?>

<div class="media border rounded p-2 my-2" id="<?= $article['id'] ?>">
  <img class="mr-3 img-thumbnail" src="<?= $profilePicture ?>" width="64" alt="Generic placeholder image">
  <div class="media-body">
    <h5 class="mt-0"> <?= $article['title'] ?> </h5>
    <?= Html::encode(strip_tags($article['content'])) ?>

    <div class="media-footer mt-2">
      ~ <?= Html::a($user['username'], ['user/', 'username' => $user['username']]) ?> <br>
      <a href="javascript:void(0);"> <?= $likes ?> </a>
    </div>
    <br>
  </div>
</div>
<?php endforeach; ?>