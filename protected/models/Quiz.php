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

    public function getMostPlayedQuizzesRecently($hour, $limit) {
        $range = strtotime("- $hour hours");
        $range_time = date("Y-m-d H:i:s", $range);
        $data = Yii::app()->db->createCommand()
                ->select('t.*, COUNT(g.quiz_id) as play_count')
                ->from('tbl_quiz t')
                ->leftJoin('tbl_game g', 't.id = g.quiz_id')
                ->limit($limit)
                ->group('g.quiz_id')
                ->order('play_count DESC')
                ->where("g.started_at >= '" . $range_time . "'")
                ->queryAll();
        return $data;
    }

    public function getNewestQuizzesInCategory($category) {
        $criteria = new CDbCriteria;
        $criteria->condition = "category = '" . $category . "'";
        $criteria->order = 'created_at DESC';
        $data = Quiz::model()->findAll($criteria);
        return $data;
    }

    public function getMostPlayedQuizzesInCategory($category) {
        $data = Yii::app()->db->createCommand()
                ->select('t.*, count(g.id) AS play_count')
                ->from('tbl_quiz t')
                ->leftJoin('tbl_game g', 't.id = g.quiz_id')
                ->group('t.id')
                ->order('play_count DESC')
                ->where("category = '" . $category . "'")
                ->queryAll();
        return $data;
    }

    public function getBestRatedQuizzesInCategory($category) {
        $data = Yii::app()->db->createCommand()
                ->select('t.*, avg(r.rating) AS average_rating')
                ->from('tbl_quiz t')
                ->leftJoin('tbl_quiz_rating r', 't.id = r.quiz_id')
                ->group('t.name')
                ->order('average_rating DESC')
                ->where("category = '" . $category . "'")
                ->queryAll();
        return $data;
    }

    public function addRatingQuiz($rating, $comment, $quiz_id, $player_id) {
        $model = new QuizRating();
        $model->rating = $rating;
        $model->quiz_id = $quiz_id;
        $model->created_at = time();
        $model->updated_at = time();
        $model->player_id = $player_id;
        $model->comment = $comment;
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function deleteRatingQuiz($id) {
        if (QuizRating::model()->deleteByPk($id)) {
            return true;
        }
        return false;
    }

    public function editRatingQuiz($id, $comment, $rating) {
        $item = QuizRating::model()->findByPk($id);
        $item->comment = $comment;
        $item->rating = $rating;
        if ($item->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

}
