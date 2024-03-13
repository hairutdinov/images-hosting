<?php

namespace frontend\models;

use common\models\UploadedFiles;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\Inflector;

class ImageUploadForm extends Model
{
    /**
     * @var UploadedFile[] загруженные файлы
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 5],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $fileName = Inflector::slug($file->baseName) . '.' . $file->extension;
                $basePath = Yii::getAlias('@frontend') . '/web';
                $uploadsPath = $basePath . '/uploads/';
                $filePath = $uploadsPath . $fileName;

                $i = 0;
                while (file_exists($filePath)) {
                    $i++;
                    $fileName = Inflector::slug($file->baseName) . '_' . $i . '.' . $file->extension;
                    $filePath = $uploadsPath . $fileName;
                }

                if ($file->saveAs($filePath)) {
                    $uploadedFile = new UploadedFiles();
                    $uploadedFile->filename = $fileName;
                    $uploadedFile->uploaded_at = date('Y-m-d H:i:s');
                    $uploadedFile->save();
                }
            }
            return true;
        } else {
            return false;
        }
    }
}