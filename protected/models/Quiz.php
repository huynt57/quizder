<?php

Yii::import('application.models._base.BaseQuiz');

class Quiz extends BaseQuiz {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCategories() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.category';
        $criteria->distinct = true;
        $data = Quiz::model()->findAll($criteria);
        $returnValue = array();
        foreach ($data as $item) {
            $returnValue[] = $item->category;
        }
        return $returnValue;
    }

    public function getMostPlayedQuizziesRecently($hour, $limit) {
        $range = strtotime("- $hour hours");
        $range_time = date("Y-m-d H:i:s", $range);
        $data = Yii::app()->db->createCommand()
                ->select('t.*, COUNT(g.quiz_id) as play_count')
                ->from('tbl_quiz t')
                ->join('tbl_game g', 't.id = g.quiz_id')
                ->limit($limit)
                ->group('g.quiz_id')
                ->order('play_count DESC')
                ->where("g.started_at >= '" . $range_time . "'")
                ->queryAll();
        return $data;
    }

    public function getNewestQuizziesInCategory($category) {
        $criteria = new CDbCriteria;
        $criteria->condition = "category = '" . $category . "'";
        $criteria->order = 'created_at DESC';
        $data = Quiz::model()->findAll($criteria);
        return $data;
    }

    public function getMostPlayedQuizziesInCategory($category) {
        $data = Yii::app()->db->createCommand()
                ->select('t.*, count(g.id) AS gameCount')
                ->from('tbl_quiz t')
                ->join('tbl_game g', 't.id = g.quiz_id')
                ->group('g.quiz_id')
                ->order('gameCount DESC')
                ->where("category = '" . $category . "'")
                ->queryAll();
        return $data;
    }

    public function getBestRatedQuizziesInCategory($category) {
        $data = Yii::app()->db->createCommand()
                ->select('t.*, avg(g.rating) AS averageRating')
                ->from('tbl_quiz t')
                ->join('tbl_game g', 't.id = g.quiz_id')
                ->group('t.name')
                ->order('averageRating DESC')
                ->where("category = '" . $category . "'")
                ->queryAll();
        return $data;
    }

}
