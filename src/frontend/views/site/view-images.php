<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Просмотр изображений';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'filename',
        'uploaded_at:datetime',
        [
            'format' => 'raw',
            'value' => function ($model) {
                $imagePath = Yii::getAlias('@web/uploads/' . $model->filename);
                return Html::a(Html::img($imagePath, ['width' => '100', 'height' => '100']), $imagePath, ['class' => 'image-link']);
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{download}',
            'buttons' => [
                'download' => function ($url, $model, $key) {
                    $url = ['download-image', 'filename' => $model->filename];
                    return Html::a('Скачать в архиве', $url, ['class' => 'btn btn-primary']);
                },
            ],
        ],
    ],
]);