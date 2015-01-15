<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Place;
use frontend\models\PlaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\User;

/**
 * PlaceController implements the CRUD actions for Place model.
 */
class PlaceController extends Controller
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
     * Lists all Place models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Place model.
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
     * Creates a new Place model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Place();        
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->getIsGuest()) {
              $model->created_by = 1;
            } else {
              $model->created_by= Yii::$app->user->getId();
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Place model.
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
     * Deletes an existing Place model.
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
     * Finds the Place model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Place the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Place::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
      * Creates a new Place model from Google Place
      * If creation is successful, the browser will be redirected to the 'view' page.
      * @return mixed
      */
     public function actionCreate_place_google()
     {
       $model = new Place();        
       if ($model->load(Yii::$app->request->post())) {
           if (Yii::$app->user->getIsGuest()) {
             $model->created_by = 1;
           } else {
             $model->created_by= Yii::$app->user->getId();
           }
           $form = Yii::$app->request->post();
           $model->save();
           // add GPS entry in PlaceGeometry
           $model->addGeometry($model,$form['Place']['location']);
           // var_dump(json_decode($pst['Place']['location'],true));
           return $this->redirect(['view', 'id' => $model->id]);
       } else {
           return $this->render('create_place_google', [
               'model' => $model,
           ]);
       }

         $model = new Place();

         if ($model->load(Yii::$app->request->post())) {
           // && $model->save()) {
             die();
             return $this->redirect(['view', 'id' => $model->id]);
         } else {
             return $this->render('create_place_google', [
                 'model' => $model,
             ]);
         }
     }    

     /**
      * Creates a new Place model via Geolocation
      */
     public function actionCreate_geo()
     {
         $model = new Place();

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['view', 'id' => $model->id]);
         } else {
             return $this->render('create_geo', [
                 'model' => $model,
             ]);
         }
     }  

     public function actionLocate()
     {
         $searchModel = new PostPlace();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         return $this->render('locate', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }
    
}
