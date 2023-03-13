<?php

namespace app\controllers;

use app\models\Assegnazione;
use app\models\Assistito;
use app\models\AssistitoSearch;
use app\models\Caregiver;
use app\models\Esercizio;
use app\models\EsercizioSearch;
use app\models\LoginForm;
use app\models\CaregiverSearch;
use app\models\LogopedistaSearch;
use app\models\Logopedista;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CaregiverController implements the CRUD actions for Caregiver model.
 */
class CaregiverController extends Controller
{
    public $layout = '@app/views/layouts/caregiver';
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Caregiver models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CaregiverSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionLogout()
    {
        Yii::$app->caregiver->logout();

        return $this->redirect(['site/index']);
    }

    /**
     * Displays a single Caregiver model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => Caregiver::findOne($id)]);
    }

    /**
     * Creates a new Caregiver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Caregiver();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Caregiver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Caregiver model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Caregiver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Caregiver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Caregiver::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function actionVediLogopedista()
    {
        $searchModel = new LogopedistaSearch();
        $dataProvider= $searchModel->search($this->request->queryParams);


        $query = Logopedista::find()->where(['id' => Yii::$app->session->get('id_logopedista')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('vedi-logopedista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function actionVediAssistiti()
{
    $searchModel = new AssistitoSearch();
    $dataProvider= $searchModel->search($this->request->queryParams);


    $query = Assistito::find()->where(['id_caregiver' => Yii::$app->session->get('id')]);

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    return $this->render('vedi-assistiti', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,

    ]);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function actionVedi_esercizi($assistito_id)
    {
        // Crea un oggetto Assegnazione per la tabella "assegnazione"
        $assegnazione = new Assegnazione();

        // Recupera i record delle assegnazioni per l'assistito corrente
        $query = $assegnazione::find()
            ->where(['id_assistito' => $assistito_id]);
//            ->andWhere(['eseguito' => 0]);

        // Crea un oggetto ActiveDataProvider per gli esercizi correlati
        $dataProvider = new ActiveDataProvider([
            'query' => Esercizio::find()->where(['id' => $query->select('id_esercizio')]),
        ]);

        // Renderizza la vista con i dati del DataProvider
        return $this->render('vedi_esercizi', [
            'dataProvider' => $dataProvider,
            'id_assistito' =>$assistito_id,

        ]);
    }


    public function actionSvolgi_esercizio($assistito_id, $esercizio_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Esercizio::find()->where(['id' => $esercizio_id]),
        ]);


        // Recupera l'oggetto Assegnazione corrispondente all'assistito ed all'esercizio correnti
        $assegnazione = Assegnazione::findOne(['id_assistito' => $assistito_id, 'id_esercizio' => $esercizio_id]);

        if ($assegnazione !== null) {
            // Imposta il valore di "eseguito" a 1
            $assegnazione->eseguito = 1;
            $assegnazione->save(false); // salva senza validazione
        }

        return $this->render('svolgi_esercizio', [
            'dataProvider' => $dataProvider,
            'id_assistito' =>$assistito_id,

        ]);

    }
    public function actionEsercizio($assistito_id, $esercizio_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Esercizio::find()->where(['id' => $esercizio_id]),
        ]);


        // Recupera l'oggetto Assegnazione corrispondente all'assistito ed all'esercizio correnti
        $assegnazione = Assegnazione::findOne(['id_assistito' => $assistito_id, 'id_esercizio' => $esercizio_id]);


        return $this->render('svolgi_esercizio', [
            'dataProvider' => $dataProvider,
            'id_assistito' =>$assistito_id,

        ]);

    }





}