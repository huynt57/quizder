<?php

Yii::import('application.models._base.BasePlayer');

class Player extends BasePlayer {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getPlayerByFacebook($facebook_id) {
        $data = Player::model()->findByAttributes(array('facebook_id' => $facebook_id));
        return $data;
    }

    public function getPlayerByGoogle($google_id) {
        $data = Player::model()->findByAttributes(array('google_id' => $google_id));
        return $data;
    }

    public function getPlayerByTwitter($twitter_id) {
        $data = Player::model()->findByAttributes(array('twitter_id' => $twitter_id));
        return $data;
    }

    public function getPlayerById($id) {
        $data = Player::model()->findByPk($id);
        return $data;
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

}
