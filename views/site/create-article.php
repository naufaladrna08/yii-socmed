<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use dosamigos\ckeditor\CKEditor;

$this->title = "YiiBook - Create an Article";
?>
  <div id="create-article-form">
    <?php $form = ActiveForm::begin(['id' => 'create-article-form']) ?>
    
    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'content')-> widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <div class="form-group">
      <div class="col-lg-offset-1 col-lg-12 px-0">
        <?= Html::submitButton('Post', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
      </div>   
    </div>

    <?php ActiveForm::end()  ?>
  </div>