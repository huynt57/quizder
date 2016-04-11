<?php

class PlayerController extends Controller {

    public function actionGetPlayer() {
        $request = Yii::app()->request;
        try {
            $facebook_id = StringHelper::filterString($request->getQuery('facebook_id'));
            $google_id = StringHelper::filterString($request->getQuery('google_id'));
            $twitter_id = StringHelper::filterString($request->getQuery('twitter_id'));
            $id = StringHelper::filterString($request->getQuery('id'));
            $data = NULL;
            if (!empty($facebook_id)) {
                $data = Player::model()->getPlayerByFacebook($facebook_id);
            }
            if (!empty($google_id)) {
                $data = Player::model()->getPlayerByGoogle($google_id);
            }
            if (!empty($twitter_id)) {
                $data = Player::model()->getPlayerByTwitter($twitter_id);
            }
            if (!empty($id)) {
                $data = Player::model()->getPlayerById($id);
            }
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionAddPlayer() {
        try {
            $args = StringHelper::filterArrayString($_POST);
            $data = Player::model()->addPlayer($args);
            if ($data) {
                ResponseHelper::JsonReturnSuccess($data);
            } else {
                ResponseHelper::JsonReturnError('');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionEditPlayer() {
        try {
            $args = StringHelper::filterArrayString($_POST);
            $data = Player::model()->editPlayer($args);
            if ($data) {
                ResponseHelper::JsonReturnSuccess('');
            } else {
                ResponseHelper::JsonReturnError('');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionGetLeaderboardInCategory() {
        $request = Yii::app()->request;
        try {
            $category = StringHelper::filterString($request->getQuery('category'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $user_id = StringHelper::filterString($request->getQuery('user_id'));
            if (!empty($category)) {
                $data = Player::model()->getLeaderboardInCategory($category, $limit, $offset, $user_id);
            } else {
                $data = Player::model()->getLeaderboardAllCategory($limit, $offset, $user_id);
            }
            ResponseHelper::JsonReturnSuccess($data);
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }

    public function actionAddPlayerPoints() {
        $request = Yii::app()->request;
        try {
            $player_id = StringHelper::filterString($request->getPost('id'));
            $points = StringHelper::filterString($request->getPost('points'));
            $player = Player::model()->findByPk($player_id);
            $old_point = $player->total_points;
            $player->total_points = $old_point + $points;
            if ($player->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess('');
            } else {
                ResponseHelper::JsonReturnError('Error');
            }
        } catch (Exception $ex) {
            ResponseHelper::JsonReturnError($ex->getMessage());
        }
    }
    
    public function actionGetTotalBestPlayerPoints()
    {
        
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
