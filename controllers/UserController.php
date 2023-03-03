<?php

namespace app\controllers;


use app\models\forms\SignupForm;
use yii\web\Controller;

class UserController extends Controller
{
    /**
     * Displays the signup page.
     *
     * @return string
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}