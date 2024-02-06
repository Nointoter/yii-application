<?php

namespace backend\controllers;

use Yii;
use yii\rest\Controller;
use backend\models\User;

class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'index'  => ['GET', 'POST'],
                    // 'login'  => ['GET', 'POST'],
                    'view'   => ['GET'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'PUT', 'POST'],
                    'delete' => ['POST', 'DELETE'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if (Yii::$app->getRequest()->getMethod() !== 'GET') {
            Yii::$app->getResponse()->setStatusCode(405);
        }
        $response = Yii::$app->getResponse();
        $response->setStatusCode(201)->content = 'login';
        return $response;
    }
    
    public function actionSignup()
    {
        $request = Yii::$app->getRequest();
        if ($request->getMethod() === 'POST')
        {
            $body = $request->getBodyParams();
            if (User::findAnyByUsername(strval($body["username"])) !== null)
            {
                return Yii::$app->getResponse()->setStatusCode(400)->content = 'user exists';
            }

            $user = new User();
            $user->username = strval($body["username"]);
            $user->email = strval($body["email"]);
            $user->created_at = $time = time();
            $user->updated_at = $time;
            $user->setPassword(strval($body["password"]));
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            
            if ($user->save() === true)
            {
                $response = Yii::$app->getResponse();
                return $response->setStatusCode(200)->content = 'signup completed ' . $body["username"];
            }

            $response = Yii::$app->getResponse();
            return $response->setStatusCode(402)->content = 'exeption while saving ';
        }
        // if (Yii::$app->getRequest()->getMethod() !== 'GET') {
        //     Yii::$app->getResponse()->setStatusCode(405);
        // }
        $response = Yii::$app->getResponse();
        $response->setStatusCode(400)->content = 'bad method';
        return $response;
    }
}