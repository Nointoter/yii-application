<?php

namespace backend\modules\v1\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Link;
use yii\helpers\Url;
use yii\web\Linkable;

/**
 * Companies controller for the `v1` module
 */
class CompaniesController extends ActiveController
{
    public $modelClass = "backend\models\Companies";

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        return $actions;
    }
}
