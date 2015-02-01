<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\Participant;
use frontend\models\ParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ParticipantController implements the CRUD actions for Participant model.
 */
class ParticipantController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Participant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Participant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Participant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($meeting_id)
    {
      $mtg = new Meeting();
      $title = $mtg->getMeetingTitle($meeting_id);
        $model = new Participant();
        $model->meeting_id= $meeting_id;
        $model->invited_by= Yii::$app->user->getId();
        // to do move into model
        // load user's friends into email list array for autocomplete
        $friend_list = \frontend\models\Friend::find()->where(['user_id' => Yii::$app->user->getId()])->all();
        $email_list = [];
        foreach ($friend_list as $x) {
          $email_list[] = $x->friend->email;
        }
        if ($model->load(Yii::$app->request->post())) {
          // to do fix saving and validation
          // add new user when needed
          // validate the form against model rules
          if ($model->validate()) {
              // all inputs are valid
              $model->add();
              // $model->save();              
              return $this->redirect(['view', 'id' => $model->id]);
          } else {
            var_dump($model->getErrors());
            die();
              // validation failed
              return $this->render('create', [
                  'model' => $model,
                'title' => $title,
                'friends'=>$email_list,
              ]);
          }          
        } else {
          return $this->render('create', [
              'model' => $model,
            'title' => $title,
            'friends'=>$email_list,
          ]);          
        }
    }

    /**
     * Updates an existing Participant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Participant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Participant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Participant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
