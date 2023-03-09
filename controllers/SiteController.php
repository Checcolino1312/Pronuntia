<?php

namespace app\controllers;

use app\models\Caregiver;
use app\models\Logopedista;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;








class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        if(Yii::$app->logopedista->getIdentity() instanceof Logopedista){
            return $this->redirect(array('/logopedista'));
        }
        if(Yii::$app->caregiver->getIdentity() instanceof Caregiver){
            return $this->redirect(array('/caregiver'));
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if($model->_user instanceof Logopedista) {
//             return $this->redirect(array('/logopedista'));


//                return $this->redirect(['/logopedista/index', 'id' => Yii::$app->logopedista->getIdentity()->getId()]);

                Yii::$app->session->setFlash('id', Yii::$app->logopedista->getIdentity()->getId());
                Yii::$app->session->setFlash('cognome', Yii::$app->logopedista->getIdentity()->getCognome());
//                Yii::$app->session->setFlash('valori', [
//                    'id' => Yii::$app->logopedista->getIdentity()->getId(),
//                    'nome' => Yii::$app->logopedista->getIdentity()->getNome(),
//                    'cognome' => Yii::$app->logopedista->getIdentity()->getCognome(),
//                ]);

                return Yii::$app->response->redirect(['/logopedista/index']);


            }

            if($model->_user instanceof Caregiver){
                return $this->redirect(array('/caregiver'));
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
            public function actionLogout()
            {
                Yii::$app->user->logout();

                return $this->goHome();
            }


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }









}
