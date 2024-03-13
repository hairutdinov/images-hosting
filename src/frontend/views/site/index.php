<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Загрузка изображений';
?>

<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="body-content">
        <div class="row">
            <div class="col">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
