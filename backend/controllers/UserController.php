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
        $request = Yii::$app->getRequest();
        if ($request->getMethod() === 'POST') {
            $body = $request->getBodyParams();
            if ($body === null)
            {
                return Yii::$app->getResponse()->setStatusCode(400)->content = 'no content';
            }
            $user = User::findAnyByUsername(strval($body["username"]));
            
            if ($user === null || !$user->validatePassword(strval($body["password"])))
            {
                return Yii::$app->getResponse()->setStatusCode(400)->content = 'bad login or password';
            }
            
            $user->generateAuthKey();
            if ($user->save() === true)
            {
                $response = Yii::$app->getResponse();
                return $response->setStatusCode(200)->content = 'login completed token = ' . $user->auth_key;
            }

            $response = Yii::$app->getResponse();
            return $response->setStatusCode(402)->content = 'exeption while saving ';
        }

        $response = Yii::$app->getResponse();
        $response->setStatusCode(400)->content = 'bad method';
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

        $response = Yii::$app->getResponse();
        $response->setStatusCode(400)->content = 'bad method';
        return $response;
    }
}