<?php

namespace api\controllers;

use yii\web\Controller;


class SiteController extends Controller
{
    public function actionIndex()
    {
        return [1, 2, 3];
    }
}
