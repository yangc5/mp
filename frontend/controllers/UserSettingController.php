<?php

namespace frontend\controllers;

use Yii;
use frontend\models\UserSetting;
use frontend\models\UserSettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * UserSettingController implements the CRUD actions for UserSetting model.
 */
class UserSettingController extends Controller
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
     * Lists all UserSetting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserSetting model.
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
     * Creates a new UserSetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserSetting();
        if ($model->load(Yii::$app->request->post())) {
          $model->user_id = Yii::$app->user->getId();
            Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/avatar/';
           $image = UploadedFile::getInstance($model, 'image');
           // store the source file name
          $model->filename = $image->name;
          $ext = end((explode(".", $image->name)));
          // generate a unique file name
          $model->avatar = Yii::$app->security->generateRandomString().".{$ext}";
          $model->avatar_square = Yii::$app->security->generateRandomString().".{$ext}";
          $model->avatar_small = Yii::$app->security->generateRandomString().".{$ext}";
          // the path to save file, you can set an uploadPath
          // in Yii::$app->params (as used in example below)
          $path = Yii::$app->params['uploadPath'] . $model->avatar;

          if($model->save()){
            
            $image->saveAs($path);

            Image::thumbnail(Yii::$app->params['uploadPath'].$model->avatar, 120, 120)
                ->save(Yii::$app->params['uploadPath'].$model->avatar_square, ['quality' => 50]);
              Image::thumbnail(Yii::$app->params['uploadPath'].$model->avatar, 30, 30)
                    ->save(Yii::$app->params['uploadPath'].$model->avatar_small, ['quality' => 50]);
            return $this->redirect(['view', 'id' => $model->id]);
          } else {
            // error in saving model
            var_dump($model->getErrors());
            echo 'error';die();
          }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserSetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $model->user_id = Yii::$app->user->getId();
          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/avatar/';
           $image = UploadedFile::getInstance($model, 'image');
           // store the source file name
          $model->filename = $image->name;
          $ext = end((explode(".", $image->name)));
          // generate a unique file name
          $model->avatar = Yii::$app->security->generateRandomString().".{$ext}";
          $model->avatar_square = Yii::$app->security->generateRandomString().".{$ext}";
          $model->avatar_small = Yii::$app->security->generateRandomString().".{$ext}";
          // the path to save file, you can set an uploadPath
          // in Yii::$app->params (as used in example below)
          $path = Yii::$app->params['uploadPath'] . $model->avatar;

          if($model->save()){
            $image->saveAs($path);
            
            Image::thumbnail(Yii::$app->params['uploadPath'].$model->avatar, 120, 120)
                ->save(Yii::$app->params['uploadPath'].$model->avatar_square, ['quality' => 50]);
              Image::thumbnail(Yii::$app->params['uploadPath'].$model->avatar, 30, 30)
                    ->save(Yii::$app->params['uploadPath'].$model->avatar_small, ['quality' => 50]);

            return $this->redirect(['view', 'id' => $model->id]);
          } else {
            // error in saving model
            echo 'error';die();
          }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserSetting model.
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
     * Finds the UserSetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserSetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserSetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
