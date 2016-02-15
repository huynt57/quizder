<?php

Yii::import('application.models._base.BaseGame');

class Game extends BaseGame {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addGame($args) {
        $model = new Game;
        $model->setAttributes($args);
        if ($model->save(FALSE)) {
            return $model->id;
        }
        return FALSE;
    }

    public function editGame($args) {
        $model = Game::model()->findByPk($args['id']);
        $model->setAttributes($args);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function getTotalPlayerPoints($player_id) {
        $data = Yii::app()->db->createCommand()
                ->select('sum(player_points) as player_points')
                ->from('tbl_game g')
                ->where("g.player_id = '" . $player_id . "'")
                ->queryRow();
        return $data;
    }

}
