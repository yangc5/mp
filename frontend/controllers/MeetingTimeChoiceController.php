<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\MeetingTime;
use frontend\models\MeetingTimeChoice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MeetingTimeChoiceController extends \yii\web\Controller
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

      public function actionSet($id,$state)
      {
        $id=str_replace('mtc-','',$id);
        // caution - incoming AJAX type issues with val
        $mtc = $this->findModel($id);
        if (Yii::$app->user->getId()!=$mtc->user_id) return false;        
        if (intval($state) == 0 or $state=='false')
          $mtc->status = MeetingTimeChoice::STATUS_NO;
        else
          $mtc->status = MeetingTimeChoice::STATUS_YES;
        $mtc->save();
        return $mtc->id;
      }

      /**
       * Finds the MeetingTimeChoice model based on its primary key value.
       * If the model is not found, a 404 HTTP exception will be thrown.
       * @param integer $id
       * @return MeetingTime the loaded model
       * @throws NotFoundHttpException if the model cannot be found
       */
      protected function findModel($id)
      {
          if (($model = MeetingTimeChoice::findOne($id)) !== null) {
              return $model;
          } else {
              throw new NotFoundHttpException('The requested page does not exist.');
          }
      }
}
