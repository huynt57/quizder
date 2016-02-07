<?php

class QuizController extends Controller {

    public function actionGetMostPlayedQuizziesRecently() {
        $request = Yii::app()->request;
        try {
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $recent_range = StringHelper::filterString($request->getQuery('recent_range'));
            $data = Quiz::model()->getMostPlayedQuizziesRecently($recent_range, $limit);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetNewestQuizziesInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));

            $data = Quiz::model()->getNewestQuizziesInCategory($category);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetMostPlayedQuizziesInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));

            $data = Quiz::model()->getMostPlayedQuizziesInCategory($category);
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetBestRatedQuizziesInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));

            $data = Quiz::model()->getBestRatedQuizziesInCategory($category);
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
