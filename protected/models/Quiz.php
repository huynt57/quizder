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
        return $data;
    }

    public function getMostPlayedQuizziesRecently($hour, $limit) {
        //  $seconds = $hour * 3600;
        $criteria = new CDbCriteria;
        $criteria->select = 't.*, g.*';
        $criteria->join = 'JOIN tbl_game g ON t.id = g.quiz_id';
        $range = strtotime("- $hour hours");
        $range_time = date("Y-m-d H:i:s", $range);
        $criteria->condition = "start_date >= $range_time";
        $criteria->limit = $limit;
        $data = Quiz::model()->findAll($criteria);
        return $data;
    }

    public function getNewestQuizziesInCategory($category) {
        $criteria = new CDbCriteria;
        $criteria->condition = "category = $category";
        $criteria->order = 'created_at DESC';
        $data = Quiz::model()->findAll($criteria);
        return $data;
    }

    public function getMostPlayedQuizziesInCategory($category) {
        $criteria = new CDbCriteria;
        $criteria->select = 't.*, count(g.id) AS gameCount';
        $criteria->join = 'JOIN tbl_game g ON g.quiz_id = t.id';
        $criteria->condition = "t.category = $category";
        $criteria->group = 't.id';
        $criteria->order = 'gameCount DESC';
        $data = Quiz::model()->findAll($criteria);
        return $data;
    }

    public function getBestRatedQuizziesInCategory($category) {
        $criteria = new CDbCriteria;
        $criteria->select = 't.*, avg(g.rating) AS averageRating ';
        $criteria->join = 'JOIN tbl_game g ON g.quiz_id = t.id';
        $criteria->condition = "t.category = $category";
        $criteria->group = 't.name';
        $criteria->order = 'averageRating DESC';
        $data = Quiz::model()->findAll($criteria);
        return $data;
    }

   

}
