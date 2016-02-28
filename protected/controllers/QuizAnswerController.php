<?php

class QuizAnswerController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetAnswersOfQuiz() {
        $request = Yii::app()->request;
        try {
            $quiz_id = StringHelper::filterString($request->getQuery('quiz_id'));
            $data = QuizAnswer::model()->findAllByAttributes(array('quiz_id'=>$quiz_id));
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
