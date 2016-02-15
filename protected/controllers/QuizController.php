<?php

class QuizController extends Controller {

    public function actionGetMostPlayedQuizzesRecently() {
        $request = Yii::app()->request;
        try {
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $recent_range = StringHelper::filterString($request->getQuery('recent_range'));
            $data = Quiz::model()->getMostPlayedQuizzesRecently($recent_range, $limit);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetNewestQuizzesInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));

            $data = Quiz::model()->getNewestQuizzesInCategory($category);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetMostPlayedQuizzesInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));

            $data = Quiz::model()->getMostPlayedQuizzesInCategory($category);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetBestRatedQuizzesInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));

            $data = Quiz::model()->getBestRatedQuizzesInCategory($category);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
