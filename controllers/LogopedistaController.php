<?php

namespace app\controllers;

use app\models\Assegnazione;
use app\models\Assistito;
use app\models\AssistitoSearch;
use app\models\Bambino;
use app\models\Caregiver;
use app\models\CaregiverSearch;
use app\models\Esercizio;
use app\models\EsercizioSearch;
use app\models\LoginForm;
use app\models\LogopedistaSearch;

use Yii;
use app\models\Logopedista;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\IdentityInterface;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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



    public function actionLogout()
    {
        Yii::$app->logopedista->logout();

        return $this->redirect(['site/index']);
    }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function actionCreate_caregiver()
    {
        $id = Yii::$app->request->post('id');
        $model = new Caregiver();

        $model->id_logopedista = $id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

//                Yii::$app->session->set('id', $id);
                return Yii::$app->response->redirect(['logopedista/vedi-caregiver']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create_caregiver', [
            'model' => $model,

        ]);

    }

    public function actionVediCaregiver()
    {
        $searchModel = new CaregiverSearch();
        $dataProvider= $searchModel->search($this->request->queryParams);


        $query = Caregiver::find()->where(['id_logopedista' => Yii::$app->session->get('id')]);

        if ($searchModel->nome) {
            $query->andWhere(['like', 'nome', $searchModel->nome]);
        }
        if ($searchModel->cognome) {
            $query->andWhere(['like', 'cognome', $searchModel->cognome]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('vedi-caregiver', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }



//    public function actionView($id){
//
//        return $this->render('view');
//    }

    public function actionDettaglio_caregiver($id){

        return $this->render('dettaglio_caregiver', ['model' => Caregiver::findOne($id)]);
    }

    public function actionModifica_caregiver($id)
    {
        $model = Caregiver::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if($model->save()){
                return $this->redirect(['vedi-caregiver', 'id_caregiver' => $model->id]);
            }
        }

        return $this->render('modifica_caregiver', [
            'model' => $model,
        ]);
    }

    public function actionElimina_caregiver($id)
    {
        Caregiver::findOne($id)->delete();
        return $this->redirect(['vedi-caregiver']);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function actionCreate_assistito($id_caregiver)
    {
        $model = new Assistito();
        $id = Yii::$app->session->get('id');


        $model->id_logopedista = $id;
        $model->id_caregiver = $id_caregiver;


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                if($model->save()){

                return $this->redirect(['vedi-assistiti']);
               }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create_assistito', [
            'model' => $model,

        ]);

    }


    public function actionVediAssistiti()
    {
        $searchModel = new AssistitoSearch();
        $dataProvider= $searchModel->search($this->request->queryParams);


        $query = Assistito::find()->where(['id_logopedista' => Yii::$app->session->get('id')]);

        if ($searchModel->nome) {
            $query->andWhere(['like', 'nome', $searchModel->nome]);
        }
        if ($searchModel->cognome) {
            $query->andWhere(['like', 'cognome', $searchModel->cognome]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('vedi-assistiti', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }
    public function actionDettaglio_assistito($id)
    {
        $assistito = Assistito::findOne($id);
        $valutazioni = Assegnazione::find()
            ->select(['id_esercizio', 'valutazione'])
            ->where(['id_assistito' => $id])
            ->all();

        $data = [];
        $data[] = ['ID', 'Valutazione'];

        $totale_valutazioni = 0;
        $num_valutazioni = count($valutazioni);

        foreach ($valutazioni as $valutazione) {
            $data[] = [(string)$valutazione->id_esercizio, (int)$valutazione->valutazione];
            $totale_valutazioni += $valutazione->valutazione;
        }

        $media_valutazioni = ($num_valutazioni > 0) ? ($totale_valutazioni / $num_valutazioni) : 0;

        return $this->render('dettaglio_assistito', [
            'data' => $data,
            'model' => $assistito,
            'media_valutazioni' => $media_valutazioni,
        ]);
    }


    public function actionModifica_assistito($id)
    {
        $model = Assistito::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            if($model->save()){
                return $this->redirect(['vedi-assistiti', 'id_assistito' => $model->id]);
            }
        }

        return $this->render('modifica_assistito', [
            'model' => $model,
        ]);
    }

    public function actionElimina_assistito($id)
    {
        Assistito::findOne($id)->delete();
        return $this->redirect(['vedi-assistiti']);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function actionCrea_esercizio()
    {
        $model = new Esercizio();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $nameim = UploadedFile::getInstance($model,'immagine');
                $nameau = UploadedFile::getInstance($model,'audio');

                $pathim = 'uploads/'.md5($nameim->baseName).'.'.$nameim->extension;
                $pathau = 'uploads/'.md5($nameau->baseName).'.'.$nameau->extension;

                if($nameim->saveAs($pathim) && $nameau->saveAs($pathau)){

                    $model->immagine = $nameim->baseName.'.'.$nameim->extension;
                    $model->audio = $nameau->baseName.'.'.$nameau->extension;

                    $model->immagine_filepath = $pathim;
                    $model->audio_filepath = $pathau;

                    //l'esercizio viene associato al logopedista che l' ha creato
                    $model->id_logopedista = Yii::$app->session->get('id');
                    if($model->save()){
                        return $this->redirect(['vedi_esercizi']);
                    }
                }
            }
        }
        return $this->render('crea_esercizio', [
            'model' => $model,
        ]);

    }

    public function actionVedi_esercizi()
    {
        $searchModel = new EsercizioSearch();
        $dataProvider= $searchModel->search($this->request->queryParams);


        $query = Esercizio::find()->where(['id_logopedista' => Yii::$app->session->get('id')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('vedi_esercizi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    public function actionModifica_esercizio($id)
    {
        $model = Esercizio::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            if($model->save()){
                return $this->redirect(['vedi_esercizi']);
            }
        }

        return $this->render('modifica_esercizio', [
            'model' => $model,
        ]);
    }

    public function actionElimina_esercizio($id)
    {
        Esercizio::findOne($id)->delete();
        return $this->redirect(['vedi_esercizi']);
    }



    public function actionAssegna_esercizi($id)
    {
        $assistito = Assistito::findOne($id);

        return $this->render('assegna_esercizi', [
            'assistito' => $assistito,
        ]);
    }
    public function actionCrea_assegnazione($id_assistito, $id_esercizio)
    {
        $assistito = Assistito::findOne($id_assistito);
        $model = new Assegnazione();
        $model->id_esercizio = $id_esercizio;
        $model->id_assistito = $id_assistito;

        if ($model->save()) {
            $assegnazioni = $assistito->assegnazioni;
            return $this->render('assegna_esercizi', [
                'assegnazioni' => $assegnazioni,
                'assistito' => $assistito,
            ]);
        }

        return $this->render('assegna_esercizi', [
            'id_assistito' => $id_assistito,
            'assistito' => $assistito,
        ]);
    }


    public function actionVedi_esercizi_assegnati($assistito_id)
    {
        $assistito = Assistito::findOne($assistito_id);
        $assegnazioni = $assistito->assegnazioni;

        return $this->render('vedi_esercizi_assegnati', [
            'assegnazioni' => $assegnazioni,
            'assistito' => $assistito,
        ]);
    }

    public function actionEliminaAssegnazione($assistito_id, $assegnazione_id)
    {
        Assegnazione::findOne($assegnazione_id)->delete();

        return $this->redirect(['vedi_esercizi_assegnati', 'assistito_id' => $assistito_id]);
    }










    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

}
