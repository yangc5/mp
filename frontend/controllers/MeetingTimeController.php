<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\MeetingTime;
use frontend\models\MeetingTimeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetingTimeController implements the CRUD actions for MeetingTime model.
 */
class MeetingTimeController extends Controller
{
    const STATUS_PROPOSED = 0;
    const STATUS_SELECTED = 10;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['create','update','view'],
                        'rules' => [
                            // allow authenticated users
                            [
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                            // everything else is denied
                        ],
                    ],            
        ];
    }
    /**
     * Lists all MeetingTime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->redirect(Yii::getAlias('@web').'/meeting');
    }

    /**
     * Displays a single MeetingTime model.
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
     * Creates a new MeetingTime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($meeting_id)
    {
        $mtg = new Meeting();
        $title = $mtg->getMeetingTitle($meeting_id);
        $model = new MeetingTime();
        $model->meeting_id= $meeting_id;
        $model->suggested_by= Yii::$app->user->getId();
        $model->status = self::STATUS_PROPOSED;
        if ($model->load(Yii::$app->request->post())) {
          // convert date time to timestamp
          $model->start = strtotime($model->start);
          // validate the form against model rules
          if ($model->validate()) {
              // all inputs are valid
              $model->save();              
              return $this->redirect(['/meeting/view', 'id' => $model->meeting_id]);
          } else {
              // validation failed
              return $this->render('create', [
                  'model' => $model,
                'title' => $title,
              ]);
          }          
        } else {
          return $this->render('create', [
              'model' => $model,
            'title' => $title,
          ]);          
        }
    }

    /**
     * Updates an existing MeetingTime model.
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
     * Deletes an existing MeetingTime model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionChoose($id,$val) {
      // meeting_time_id needs to be set active
      // other meeting_time_id for this meeting need to be set inactive
      $meeting_id = intval($id);
      $mtg=Meeting::find()->where(['id'=>$meeting_id])->one();
      if (Yii::$app->user->getId()!=$mtg->owner_id) return false;
      // to do - also check participant id if participants allowed to choose      
      foreach ($mtg->meetingTimes as $mt) {
        if ($mt->id == intval($val))
          $mt->status = MeetingTime::STATUS_SELECTED;
        else
          $mt->status = MeetingTime::STATUS_SUGGESTED;
        $mt->save();
      }
      return true;
    }
    /**
     * Finds the MeetingTime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeetingTime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeetingTime::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
