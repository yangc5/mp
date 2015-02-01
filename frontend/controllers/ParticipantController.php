<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\Participant;
use frontend\models\ParticipantSearch;
use frontend\models\Friend;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\base\Security;

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
        // load friends for auto complete field
        $friends = Friend::getFriendList(Yii::$app->user->getId());
        if ($model->load(Yii::$app->request->post())) {
          if (!User::find()->where( [ 'email' => $model->email ] )->exists()) {
            // if email not already registered
            //  create new user with temporary username & password
            $temp_email_arr[] = $model->email;
            $model->username = Inflector::slug(implode('-', $temp_email_arr));
            $model->password = Yii::$app->security->generateRandomString(12);
            $model->participant_id = $model->addUser();
          } else {
            // add participant from user record
            $usr = User::find()->where( [ 'email' => $model->email ] )->one();
            $model->participant_id = $usr->id;
          }
          // validate the form against model rules
          if ($model->validate()) {
              // all inputs are valid
              $model->save();              
              return $this->redirect(['/meeting/view', 'id' => $meeting_id]);
          } else {
              // validation failed
              return $this->render('create', [
                  'model' => $model,
                'title' => $title,
                'friends'=>$friends,
              ]);
          }          
        } else {
          return $this->render('create', [
              'model' => $model,
            'title' => $title,
            'friends'=>$friends,
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
