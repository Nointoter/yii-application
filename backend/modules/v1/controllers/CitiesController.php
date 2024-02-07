<?php

namespace backend\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Cities controller for the `v1` module
 */
class CitiesController extends ActiveController
{
    public $modelClass = "backend\models\Cities";

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
