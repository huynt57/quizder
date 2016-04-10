<?php

class ThesisController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetEnglishEntries() {
        $request = Yii::app()->request;
        try {
            $begin = StringHelper::filterString($request->getQuery('beginWith'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $sql = "SELECT * FROM tbl_english_entries WHERE word LIKE '" . $begin . "%' LIMIT $offset, $limit";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      'inlineFilterName',
      // return the filter configuration for this controller, e.g.:
      return array(
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
