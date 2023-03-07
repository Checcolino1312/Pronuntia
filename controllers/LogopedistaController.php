<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\LogopedistaSearch;
use Codeception\Lib\Interfaces\ActiveRecord;
use Yii;
use app\models\Logopedista;
use yii\web\Controller;
use yii\web\IdentityInterface;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogopedistaController implements the CRUD actions for Logopedista model.
 */
class LogopedistaController extends Controller
{
    const STATUS_ACTIVE = 1;

    private static function findOne(array $array)
    {

    }

    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => \yii\filters\AccessControl::className(),
//                'only' => ['logopedista/index'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['/logopedista/index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }





    /**
     * Creates a new Logopedista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Logopedista();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['login']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreate_assistito()
    {

          return $this->render('create_assistito');


    }


    public function actionIndex()
    {
        $searchModel = new LogopedistaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,



        ]);
    }




    public function actionView($id){

        return $this->render('view', ['model' => Logopedista::findOne($id)]);
    }



    public function actionLogin(){

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $model->rememberMe = true;
            $searchModel = new LogopedistaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['id' => Yii::$app->user->id]);

//            return $this->redirect(['index']);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'isGuest' => Yii::$app->user->isGuest,
            ]);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }






    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

}
