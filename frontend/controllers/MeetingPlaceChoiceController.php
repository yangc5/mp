<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\MeetingPlace;
use frontend\models\MeetingPlaceChoice;
use frontend\models\Place;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MeetingPlaceChoiceController extends \yii\web\Controller
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
      // caution - incoming AJAX type issues with val
      $id=str_replace('mpc-','',$id);      
      $mpc = $this->findModel($id);      
      if (Yii::$app->user->getId()!=$mpc->user_id) return false;        
      if (intval($state) == 0 or $state=='false')
        $mpc->status = MeetingPlaceChoice::STATUS_NO;
      else
        $mpc->status = MeetingPlaceChoice::STATUS_YES;
      $mpc->save();
      return $mpc->id;
    }
    
    /**
     * Finds the MeetingPlaceChoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeetingPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeetingPlaceChoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
