<?php

Yii::import('application.models._base.BasePlayer');

class Player extends BasePlayer {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function createReturnValue($data) {
        $attrs = $this->attributeLabels();
        if ($data) {
            $returnValue = array();
            foreach ($attrs as $key => $value) {
                $returnValue[$key] = $data->$key;
                $returnValue['level_info'] = $this->getLevel($data);
            }
            return $returnValue;
        }
        return NULL;
    }

    public function getPlayerByFacebook($facebook_id) {
        $data = Player::model()->findByAttributes(array('facebook_id' => $facebook_id));

        $returnValue = $this->createReturnValue($data);
        return $returnValue;
    }

    public function getPlayerByGoogle($google_id) {
        $data = Player::model()->findByAttributes(array('google_id' => $google_id));

        $returnValue = $this->createReturnValue($data);
        return $returnValue;
    }

    public function getPlayerByTwitter($twitter_id) {
        $data = Player::model()->findByAttributes(array('twitter_id' => $twitter_id));

        $returnValue = $this->createReturnValue($data);
        return $returnValue;
    }

    public function getPlayerById($id) {
        $data = Player::model()->findByPk($id);
        $returnValue = $this->createReturnValue($data);
        return $returnValue;
    }

    public function addPlayer($args) {
        $model = new Player;
        $model->setAttributes($args);
        $model->created_at = new CDbExpression('NOW()');
        if ($model->save(FALSE)) {
            return $model->id;
        }
        return FALSE;
    }

    public function editPlayer($args) {
        $model = Player::model()->findByPk($args['id']);
        $model->setAttributes($args);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getLevel($player) {
        $cpoints = $this->getPositionAndPointOfUser($player->id);
        $points = $cpoints['current_points'];
        $criteria_max = new CDbCriteria;
        $criteria_max->select = 't.*';
        $criteria_max->order = 't.level DESC';
        $criteria_max->limit = 1;
        $max = Level::model()->find($criteria_max);
        $max_point = $max->points_needed;
        $max_level = $max->level;
        $criteria_min = new CDbCriteria;
        $criteria_min->select = 't.*';
        $criteria_min->order = 't.level ASC';
        $criteria_min->limit = 1;
        $min = Level::model()->find($criteria_min);
        $min_point = $min->points_needed;
        $min_level = $min->level;
        $next_min = Level::model()->findByPk($min_level + 1);
        if ($points >= $max_point) {
            return array('level' => $max_level, 'begin' => $max_point, 'next' => null);
        } else if ($points == 0) {
            return array('level' => $min_level, 'begin' => $min_point, 'next' => $next_min->points_needed);
        }
        $next = Yii::app()->db->createCommand()
                ->select('t.*, MIN(t.level) AS begin')
                ->from('tbl_level t')
                ->where("points_needed > '" . $points . "'")
                ->queryRow();
        $begin_level = $next['begin'] - 1;
        $begin = Level::model()->findByPk($begin_level);

        return array('level' => $begin_level, 'begin' => $begin->points_needed, 'next' => $next['points_needed'], 'points' => $points);
    }

    public function getLeaderboardInCategory($category, $limit, $offset, $user_id, $friends = NULL) {
//        $quiz = Quiz::model()->findAllByAttributes(array('category' => $category));
//        $quiz_arr = array();
//        foreach ($quiz as $item) {
//            $quiz_arr[] = $item->id;
//        }
//        $criteria = new CDbCriteria;
//        $criteria->select = 't.player_id, SUM(t.player_points) AS player_points';
//        $criteria->limit = $limit;
//        $criteria->offset = $offset;
//        $criteria->addInCondition('t.quiz_id', $quiz_arr);
//        $criteria->order = 'player_points DESC';
//        $criteria->group = 't.player_id';
//        $players = Game::model()->findAll($criteria);
        $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.quiz_id IN (
        SELECT tbl_quiz.id 
        FROM tbl_quiz 
        WHERE tbl_quiz.category = '" . $category . "'
    )
    AND tbl_game.player_id > 0 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC LIMIT $offset, $limit";
        if (!empty($friends)) {
            $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.quiz_id IN (
        SELECT tbl_quiz.id 
        FROM tbl_quiz 
        WHERE tbl_quiz.category = '" . $category . "'
    )
    AND tbl_game.player_id IN $friends 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC LIMIT $offset, $limit";
        }
        $players = Game::model()->findAllBySql($sql);
        $returnArr = array();
        foreach ($players as $player) {
            $itemArr = array();
            $itemArr['player_info'] = Player::model()->findByPk($player->player_id);
            $itemArr['player_points'] = $player->player_points;
            $returnArr[] = $itemArr;
        }
        $current_postion = $this->getPositionAndPointOfUser($user_id, $category, $friends);

        return array('items' => $returnArr, 'current' => $current_postion);
    }

    public function getLeaderboardAllCategory($limit, $offset, $user_id, $friends = NULL) {
        //$criteria = new CDbCriteria;
//        $criteria->select = 't.player_id, SUM(t.player_points) AS player_points';
//        $criteria->limit = $limit;
//        $criteria->offset = $offset;
//        $criteria->order = 'player_points DESC';
//        $criteria->group = 't.player_id';
//        $players = Game::model()->findAll($criteria);
        $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.player_id > 0 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC LIMIT $offset, $limit";

        if (!empty($friends)) {
            $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.player_id IN $friends
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC LIMIT $offset, $limit";
        }
        //echo $sql; die;
        $players = Game::model()->findAllBySql($sql);
        $returnArr = array();
        foreach ($players as $player) {
            $itemArr = array();
            $itemArr['player_info'] = Player::model()->findByPk($player->player_id);
            $itemArr['player_points'] = $player->player_points;
            $returnArr[] = $itemArr;
        }
        $current_postion = $this->getPositionAndPointOfUser($user_id, NULL, $friends);
        //  $current_points = Game::model()->getTotalPlayerPoints($user_id);
        return array('items' => $returnArr, 'current' => $current_postion);
    }

    public function getPositionAndPointOfUser($user_id, $category = NULL, $friends = NULL) {
        $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.player_id > 0 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC";
//        $criteria = new CDbCriteria;
//        $criteria->select = 't.player_id, SUM(t.player_points) AS player_points';
//        $criteria->order = 'player_points DESC';
//        $criteria->group = 't.player_id';
        if (!empty($friends) && empty($category)) {
            $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.player_id IN $friends 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC";
        }
        if (!empty($category)) {
            $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.quiz_id IN (
        SELECT tbl_quiz.id 
        FROM tbl_quiz 
        WHERE tbl_quiz.category = '" . $category . "'
    )
    AND tbl_game.player_id > 0 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC";
        }

        if (!empty($category) && !empty($friends)) {
            $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.quiz_id IN (
        SELECT tbl_quiz.id 
        FROM tbl_quiz 
        WHERE tbl_quiz.category = '" . $category . "'
    )
    AND tbl_game.player_id IN $friends 
    GROUP BY tbl_game.quiz_id, tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC";
        }

        // echo $sql; die;


        $players = Game::model()->findAllBySql($sql);
        $arr = array();
//        $player_id_arr = array();
//        $player_points_arr = array();
        foreach ($players as $item) {
            $arr[$item->player_id] = $item->player_points;
            // $player_points_arr
        }
        $player_point = null;
        $position = array_search($user_id, array_keys($arr));
        if ($position === FALSE) {
            $position = null;
        }
        //echo $position; die;
        if (isset($position)) {
            $player_point = $arr[$user_id];
        }
        //  var_dump($player_point); die;
        return array('current_position' => $position, 'current_points' => $player_point);
        //return $position + 1;
    }

    public function getLeaderBoardFriends($user_id, $friends, $quiz) {
        $sql = "SELECT derived.player_id, sum(derived.best_score) AS player_points 
FROM (
    SELECT tbl_game.quiz_id, tbl_game.player_id, max(tbl_game.player_points) AS best_score 
    FROM `tbl_game` 
    WHERE tbl_game.player_id IN $friends 
    AND tbl_game.quiz_id = $quiz
    GROUP BY tbl_game.player_id
) as derived 
GROUP BY derived.player_id
ORDER BY player_points DESC";

        $players = Game::model()->findAllBySql($sql);
        $arr = array();
//        $player_id_arr = array();
//        $player_points_arr = array();
        foreach ($players as $item) {
            $arr[$item->player_id] = $item->player_points;
            // $player_points_arr
        }
        $player_point = null;
        $position = array_search($user_id, array_keys($arr));
        if ($position === FALSE) {
            $position = null;
        }
        //echo $position; die;
        if (isset($position)) {
            $player_point = $arr[$user_id];
        }
        //  var_dump($player_point); die;
        foreach ($players as $player) {
            $itemArr = array();
            $itemArr['player_info'] = Player::model()->findByPk($player->player_id);
            $itemArr['player_points'] = $player->player_points;
            $returnArr[] = $itemArr;
        }
        return array('items'=>$returnArr, 'current_position' => $position, 'current_points' => $player_point);
    }

}
