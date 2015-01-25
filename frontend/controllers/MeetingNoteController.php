<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\MeetingNote;
use frontend\models\MeetingNoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetingNoteController implements the CRUD actions for MeetingNote model.
 */
class MeetingNoteController extends Controller
{
    const STATUS_POSTED = 0;
    
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
                        'only' => ['create','update','view','delete'],
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
     * Lists all MeetingNote models.
     * @return mixed
     */
    public function actionIndex()
    {
//      $this->redirect(Yii::getAlias('@web').'/meeting');
      
        $searchModel = new MeetingNoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MeetingNote model.
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
     * Creates a new MeetingNote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($meeting_id)
    {
        $model = new MeetingNote();
        $mtg = new Meeting();
        $title = $mtg->getMeetingTitle($meeting_id);
        $model->meeting_id= $meeting_id;
        $model->posted_by= Yii::$app->user->getId();
        $model->status = self::STATUS_POSTED;
        if ($model->load(Yii::$app->request->post())) {
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
     * Updates an existing MeetingNote model.
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
     * Deletes an existing MeetingNote model.
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
     * Finds the MeetingNote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeetingNote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeetingNote::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
