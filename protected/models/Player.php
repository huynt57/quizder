<?php

Yii::import('application.models._base.BasePlayer');

class Player extends BasePlayer {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function createReturnValue($data) {
        $attrs = $this->attributeLabels();
        $returnValue = array();
        foreach ($attrs as $key => $value) {
            $returnValue[$key] = $data->$key;
            $returnValue['level_info'] = $this->getLevel($data);
        }
        return $returnValue;
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
        $points = $player->total_points;
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
                ->where("points_needed >= '" . $points . "'")
                ->queryRow();
        $begin_level = $next['begin'] - 1;
        $begin = Level::model()->findByPk($begin_level);
        return array('level' => $begin_level, 'begin' => $begin->points_needed, 'next' => $next['points_needed']);
    }

}
