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

    public function actionAddRatingQuiz() {
        $request = Yii::app()->request;
        try {
            $rating = StringHelper::filterString($request->getPost('rating'));
            $comment = StringHelper::filterString($request->getPost('comment'));
            $quiz_id = StringHelper::filterString($request->getPost('quiz_id'));
            $player_id = StringHelper::filterString($request->getPost('player_id'));
            if (Quiz::model()->addRatingQuiz($rating, $comment, $quiz_id, $player_id)) {
                ResponseHelper::JsonReturnSuccess('');
            } else {
                ResponseHelper::JsonReturnSuccess('');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionEditRatingQuiz() {
        $request = Yii::app()->request;
        try {
            $id = StringHelper::filterString($request->getPost('id'));
            $comment = StringHelper::filterString($request->getPost('comment'));
            $rating = StringHelper::filterString($request->getPost('rating'));
            if (Quiz::model()->editRatingQuiz($id, $comment, $rating)) {
                ResponseHelper::JsonReturnSuccess('');
            } else {
                ResponseHelper::JsonReturnSuccess('');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionDeleteRatingQuiz() {
        $request = Yii::app()->request;
        try {
            $id = StringHelper::filterString($request->getPost('id'));
            if (Quiz::model()->delelteRatingQuiz($id)) {
                ResponseHelper::JsonReturnSuccess('');
            } else {
                ResponseHelper::JsonReturnSuccess('');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetRatingQuizByQuiz() {
        $request = Yii::app()->request;
        try {
            $quiz_id = StringHelper::filterString($request->getQuery('quiz_id'));
            $data = QuizRating::model()->findAllByAttributes(array('quiz_id' => $quiz_id));
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetRatingQuizByPlayer() {
        $request = Yii::app()->request;
        try {
            $player_id = StringHelper::filterString($request->getQuery('player_id'));
            $data = QuizRating::model()->findAllByAttributes(array('player_id' => $player_id));
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }
    
    public function actionGetRatingQuizOfPlayer()
    {
        $request = Yii::app()->request;
        try {
            $quiz_id = StringHelper::filterString($request->getPost('quiz_id'));
            $player_id = StringHelper::filterString($request->getPost('player_id'));
            $data = QuizRating::model()->findAllByAttributes(array('player_id' => $player_id, 'quiz_id'=>$quiz_id));
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
