<?php

namespace app\controllers;

use app\models\Caregiver;
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

    public $layout = '@app/views/layouts/logopedista';
    const STATUS_ACTIVE = 1;

    private static function findOne(array $array)
    {

    }

    /**
     * {@inheritdoc}
     */

    protected function findModel($id)
    {
        if (($model = Logopedista::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIndex() {
        return $this->render('index');

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

//    public function actionCreate_caregiver()
//    {
//        $id = Yii::$app->request->post('id');
//        $model = new Caregiver();
//
//        if ($this->request->isPost) {
//            if ($model->load($this->request->post())) {
//                if($model->save()){
//                    return $this->render('create_caregiver', [
//                    'model' => $model,
//                    'id_logopedista' => $id,
//                    ]);
//                }
//            }
//        } else {
//            $model->loadDefaultValues();
//        }
//
//        return $this->render('create_caregiver', [
//            'model' => $model,
//
//        ]);
//
//    }
    public function actionCreate_caregiver()
    {
        $value = Yii::$app->request->post('id');
        $model = new Caregiver();


        $model->id_logopedista = $value;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                Yii::$app->session->setFlash('id', $value);
                return Yii::$app->response->redirect(['/logopedista/index']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create_caregiver', [
            'model' => $model,

        ]);



    }






    public function actionView($id){

        return $this->render('view', ['model' => Logopedista::findOne($id)]);
    }

    public function actionViewIndex($id)
    {
        $model = Logopedista::find()
            ->select(['nome', 'cognome', 'email']) // seleziona solo alcuni campi
            ->where(['id' => $id])
            ->one();

        return $this->render('view', [
            'model' => $model,
        ]);
    }




    public function actionLogin(){

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $model->rememberMe = true;
            $searchModel = new LogopedistaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['id' => Yii::$app->logopedista->id]);

//            return $this->redirect(['index']);
            return $this->render('/logopedista/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'isGuest' => Yii::$app->logopedista->isGuest,
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
