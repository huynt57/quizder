<?php

class GameController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAddGame() {
        try {
            $args = StringHelper::filterArrayString($_POST);
            $data = Game::model()->addGame($args);
            if ($data) {
                ResponseHelper::JsonReturnSuccess($data);
            } else {
                ResponseHelper::JsonReturnError('');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionEditGame() {
        try {
            $args = StringHelper::filterArrayString($_POST);
            $data = Game::model()->editGame($args);
            if ($data) {
                ResponseHelper::JsonReturnSuccess('');
            } else {
                ResponseHelper::JsonReturnError('');
            }
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
