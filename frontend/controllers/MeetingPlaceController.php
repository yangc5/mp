<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\MeetingPlace;
use frontend\models\MeetingPlaceSearch;
use frontend\models\Place;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetingPlaceController implements the CRUD actions for MeetingPlace model.
 */
class MeetingPlaceController extends Controller
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
     * Lists all MeetingPlace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeetingPlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MeetingPlace model.
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
     * Creates a new MeetingPlace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate($meeting_id)
     {
       $mtg = new Meeting();
       $title = $mtg->getMeetingTitle($meeting_id);
         $model = new MeetingPlace();
         $model->meeting_id= $meeting_id;
         $model->suggested_by= Yii::$app->user->getId();
         $model->status = MeetingPlace::STATUS_SUGGESTED;
         $posted_form = Yii::$app->request->post(); 
         if ($model->load($posted_form)) {
          // check if both are chosen and return an error
           if ($model->place_id<>'' and $posted_form['MeetingPlace']['google_place_id']<>'') {    
             $model->addErrors(['place_id'=>Yii::t('frontend','Please choose one or the other')]);
             return $this->render('create', [
                  'model' => $model,
                   'title' => $title,
              ]);             
           }
           if ($posted_form['MeetingPlace']['google_place_id']<>'') {
             // a google place is selected
             // is google place already in the Place database?
             // or, can we create a new place for this Google Place
             $model->place_id = Place::googlePlaceSuggested($posted_form['MeetingPlace']);
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
     * Updates an existing MeetingPlace model.
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
     * Deletes an existing MeetingPlace model.
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
      // meeting_place_id needs to be set active
      // other meeting_place_id for this meeting need to be set inactive
      $meeting_id = intval($id);
      $mtg=Meeting::find()->where(['id'=>$meeting_id])->one();
      if (Yii::$app->user->getId()!=$mtg->owner_id) return false;
      // to do - also check participant id if participants allowed to choose
      foreach ($mtg->meetingPlaces as $mp) {
        if ($mp->id == intval($val)) {
          $mp->status = MeetingPlace::STATUS_SELECTED;          
        }
        else {
          $mp->status = MeetingPlace::STATUS_SUGGESTED;          
        }
        $mp->save();
      }
      return true;
    }

    /**
     * Finds the MeetingPlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeetingPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeetingPlace::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
