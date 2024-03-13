<?php

namespace frontend\controllers;

use frontend\models\ImageUploadForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\UploadedFiles;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ImageUploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if ($model->upload()) {
                Yii::$app->session->setFlash('success', 'Изображения успешно загружены.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionViewImages()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UploadedFiles::find(),
            'sort' => [
                'defaultOrder' => [
                    'uploaded_at' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('view-images', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDownloadImage($filename)
    {
        $uploadPath = Yii::getAlias('@webroot/uploads/');

        $imagePath = $uploadPath . $filename;

        if (!file_exists($imagePath)) {
            throw new \yii\web\NotFoundHttpException('Изображение не найдено');
        }

        $zip = new \ZipArchive();
        $zipName = 'image_' . $filename . '.zip';
        $zipPath = Yii::getAlias('@webroot/' . $zipName);

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            $zip->addFile($imagePath, $filename);
            $zip->close();
        } else {
            throw new \yii\web\ServerErrorHttpException('Не удалось создать архив');
        }

        Yii::$app->response->sendFile($zipPath)->send();
    }
}
