<?php

namespace api\controllers;

use common\models\UploadedFiles;
use yii\rest\ActiveController;

class UploadController extends ActiveController
{
    public $modelClass = UploadedFiles::class;

}