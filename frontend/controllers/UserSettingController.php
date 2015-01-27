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
     * Default path - redirect to update
     * @return mixed
     */
    public function actionIndex()
    {
      // returns record id not user_id
      $id = UserSetting::initialize(Yii::$app->user->getId());
      return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Lists all UserSetting models.
     * @return mixed
     */
    public function actionAdmin()
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
     * Updates an existing UserSetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new UserSetting;
        $model = $this->findModel($id);        
        if ($model->load(Yii::$app->request->post())) {
          // the path to save file, you can set an uploadPath
          // in Yii::$app->params (as used in example below)
          Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/avatar/';
           $image = UploadedFile::getInstance($model, 'image');
           if (!is_null($image)) {
             // path to existing image for post-delete
             $image_delete = $model->avatar;
             // save new image
              // store the source file name
             $model->filename = $image->name;
             $ext = end((explode(".", $image->name)));
             // generate a unique file name to prevent duplicate filenames
             $model->avatar = Yii::$app->security->generateRandomString().".{$ext}";
             $model->user_id = Yii::$app->user->getId();
             if($model->save()){
               $path = Yii::$app->params['uploadPath'] . $model->avatar;
               $image->saveAs($path);            
               Image::thumbnail(Yii::$app->params['uploadPath'].$model->avatar, 120, 120)
                   ->save(Yii::$app->params['uploadPath'].'sqr_'.$model->avatar, ['quality' => 50]);
               Image::thumbnail(Yii::$app->params['uploadPath'].$model->avatar, 30, 30)
                       ->save(Yii::$app->params['uploadPath'].'sm_'.$model->avatar, ['quality' => 50]);
                $model->deleteImage(Yii::$app->params['uploadPath'],$image_delete);
             } else {
               // error in saving model
               // pass thru to form
             }             
           } else {
             // simple save
             $model->save();
             // pass thru to form
           }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
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
